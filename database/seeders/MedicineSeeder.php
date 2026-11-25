<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        Medicine::create(['category_id' => 1, 'name' => 'Paracetamol 500mg', 'price' => 0.80, 'stock' => 200]);
        Medicine::create(['category_id' => 1, 'name' => 'Ibuprofeno 400mg', 'price' => 1.20, 'stock' => 150]);
        Medicine::create(['category_id' => 2, 'name' => 'Amoxicilina 500mg', 'price' => 2.50, 'stock' => 80]);
        Medicine::create(['category_id' => 3, 'name' => 'Vitamina C 1g', 'price' => 1.50, 'stock' => 120]);
    }
}