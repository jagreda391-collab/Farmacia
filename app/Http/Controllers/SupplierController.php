<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('business_name')->get();
        return view('settings.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('settings.suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|max:150',
            'ruc' => 'required|max:11|unique:suppliers',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|email|max:150', // <-- Agregado
            'address' => 'nullable|max:255',     // <-- Agregado
        ]);

        Supplier::create($validated);
        return to_route('suppliers.index')->with('ok', 'Proveedor registrado correctamente.');
    }

    public function edit(Supplier $supplier)
    {
        return view('settings.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'business_name' => 'required|max:150',
            'ruc' => ['required', 'max:11', Rule::unique('suppliers')->ignore($supplier)],
            'phone' => 'nullable|max:20',
            'email' => 'nullable|email|max:150', // <-- Agregado
            'address' => 'nullable|max:255',     // <-- Agregado
        ]);

        $supplier->update($validated);
        return to_route('suppliers.index')->with('ok', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return to_route('suppliers.index')->with('ok', 'Proveedor eliminado correctamente.');
    }
}