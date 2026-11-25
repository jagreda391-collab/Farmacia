<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::create(['name' => 'Juan Pérez', 'dni' => '87654321', 'phone' => '999888777', 'age' => 30]);
        Customer::create(['name' => 'María Gómez', 'dni' => '12345678', 'phone' => '987654321', 'age' => 25]);
    }
}