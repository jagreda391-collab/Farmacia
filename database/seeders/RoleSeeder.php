<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'Administrador', 'description' => 'Acceso total al sistema']);
        Role::create(['name' => 'Químico farmacéutico', 'description' => 'Gestión de inventario']);
        Role::create(['name' => 'Cajero', 'description' => 'Ventas y atención al cliente']);
    }
}