<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Analgésicos', 'description' => 'Alivian el dolor']);
        Category::create(['name' => 'Antibióticos', 'description' => 'Combaten infecciones']);
        Category::create(['name' => 'Vitaminas', 'description' => 'Suplementos alimenticios']);
    }
}