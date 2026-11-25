<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // El profesor indica que la contraseña para todos es "password"
        
        User::create([
            'name' => 'Administrador', 
            'email' => 'admin@sanjuan.com', 
            'password' => '123456', 
            'dni' => '11111111', 
            'role_id' => 1
        ]);
        
        User::create([
            'name' => 'Rosa Quispe', 
            'email' => 'rquispe@sanjuan.com', 
            'password' => '123456', 
            'dni' => '22222222', 
            'role_id' => 2
        ]);
        
        User::create([
            'name' => 'Carlos Mendoza', 
            'email' => 'cmendoza@sanjuan.com', 
            'password' => '123456', 
            'dni' => '33333333', 
            'role_id' => 3
        ]);
        
        User::create([
            'name' => 'Luis Torres', 
            'email' => 'ltorres@sanjuan.com', 
            'password' => '123456', 
            'dni' => '44444444', 
            'role_id' => 3
        ]);
    }
}