<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- IMPORTANTE: Para las transacciones

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'user'])->orderBy('id', 'desc')->get();
        return view('settings.sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $medicines = Medicine::where('stock', '>', 0)->orderBy('name')->get();
        return view('settings.sales.create', compact('customers', 'medicines'));
    }

    public function store(Request $request)
    {
        // 1. Validamos los datos (Ahora recibimos un arreglo de items)
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array|min:1',
            'items.*.medicine_id' => 'required|exists:medicines,id',
            'items.*.amount' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // 2. Creamos la Venta (Cabecera) usando el usuario logueado
            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'user_id' => auth()->id(), 
                'date' => now(),
                'total' => 0,
                'igv' => 0,
            ]);

            $total = 0;

            // 3. Recorremos los medicamentos agregados
            foreach ($request->items as $item) {
                // Bloqueamos el medicamento para evitar ventas simultáneas
                $medicine = Medicine::lockForUpdate()->findOrFail($item['medicine_id']);
                
                if ($item['amount'] > $medicine->stock) {
                    throw new \Exception("No hay suficiente stock para: {$medicine->name}");
                }

                $subtotal = $medicine->price * $item['amount'];
                $total += $subtotal;

                // 4. Creamos el detalle
                $sale->details()->create([
                    'medicine_id' => $medicine->id,
                    'amount' => $item['amount'],
                    'price_unit' => $medicine->price,
                    'subtotal' => $subtotal
                ]);

                // 5. Descontamos el stock
                $medicine->updateStock($item['amount']);
            }

            // 6. Calculamos total e IGV (18%)
            $sale->total = $total;
            $sale->igv = round($total - ($total / 1.18), 2);
            $sale->save();

            DB::commit();
            return to_route('sales.index')->with('ok', 'Venta registrada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return to_route('sales.index')->with('ok', 'Venta anulada correctamente.');
    }
    
    public function edit(Sale $sale)
    {
        $customers = Customer::orderBy('name')->get();
        $medicines = Medicine::orderBy('name')->get();
        $detail = $sale->details()->first(); 
        
        return view('settings.sales.edit', compact('sale', 'customers', 'medicines', 'detail'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'medicine_id' => 'required|exists:medicines,id',
            'amount' => 'required|integer|min:1',
        ]);

        $medicine = Medicine::findOrFail($request->medicine_id);
        $oldDetail = $sale->details()->first();

        // 1. Devolvemos el stock del medicamento anterior
        if ($oldDetail) {
            $oldMedicine = Medicine::find($oldDetail->medicine_id);
            if ($oldMedicine) {
                $oldMedicine->increment('stock', $oldDetail->amount);
            }
        }

        // 2. Validamos el nuevo stock
        if ($request->amount > $medicine->stock) {
            return back()->withErrors(['amount' => 'No hay suficiente stock de este medicamento.'])->withInput();
        }

        // 3. Actualizamos la cabecera (solo el cliente)
        $sale->update(['customer_id' => $request->customer_id]);

        // 4. Borramos el detalle viejo y creamos el nuevo
        $sale->details()->delete();
        
        $subtotal = $medicine->price * $request->amount;
        $sale->details()->create([
            'medicine_id' => $medicine->id,
            'amount' => $request->amount,
            'price_unit' => $medicine->price,
            'subtotal' => $subtotal
        ]);

        // 5. Recalculamos el total
        $sale->total = $subtotal;
        $sale->igv = round($subtotal - ($subtotal / 1.18), 2);
        $sale->save();

        // 6. Descontamos el nuevo stock
        $medicine->updateStock($request->amount);

        return to_route('sales.index')->with('ok', 'Venta actualizada correctamente.');
    }
}