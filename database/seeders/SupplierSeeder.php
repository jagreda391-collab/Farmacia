<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'business_name' => 'Distribuidora Farma Perú S.A.C.',
            'ruc' => '20123456789',
            'phone' => '987654321',
            'email' => 'ventas@farma-peru.test',
            'address' => 'Av. Los Incas 1250, Lima'
        ]);
        Supplier::create([
            'business_name' => 'Medisalud Distribuciones E.I.R.L.',
            'ruc' => '20234567891',
            'phone' => '912345678',
            'email' => 'contacto@medisalud.test',
            'address' => 'Jr. Comercio 480, Arequipa'
        ]);
        Supplier::create([
            'business_name' => 'Laboratorios Andinos del Sur S.A.',
            'ruc' => '20345678912',
            'phone' => '956123478',
            'email' => 'comercial@laboratorios-andinos.test',
            'address' => 'Av. Industrial 310, Cusco'
        ]);
        Supplier::create([
            'business_name' => 'Botica Mayorista San José S.R.L.',
            'ruc' => '20456789123',
            'phone' => '945612378',
            'email' => 'pedidos@boticasanjose.test',
            'address' => 'Calle Salud 225, Trujillo'
        ]);
    }
}