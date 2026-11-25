<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Medicine;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $cajeros = User::where('role_id', 3)->get();
        $clientes = Customer::all();
        $medicamentos = Medicine::all();

        // Crear 50 ventas aleatorias
        for ($i = 0; $i < 50; $i++) {
            $medicamento = $medicamentos->random();
            $cantidad = rand(1, 5);
            $subtotal = $medicamento->price * $cantidad;
            $fecha = Carbon::now()->subDays(rand(0, 30));

            $venta = Sale::create([
                'customer_id' => $clientes->random()->id,
                'user_id' => $cajeros->random()->id,
                'date' => $fecha,
                'total' => 0,
                'igv' => 0
            ]);

            $venta->details()->create([
                'medicine_id' => $medicamento->id,
                'amount' => $cantidad,
                'price_unit' => $medicamento->price,
                'subtotal' => $subtotal
            ]);

            $venta->calculateTotal();
            $venta->save();
        }
    }
}