<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Document;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CREAR EL ADMINISTRADOR PRIMERO
        $admin = User::create([
            'name' => 'MARVIN Admin',
            'email' => 'admin@tech.com',
            'password' => Hash::make('admin123'), // Contraseña para entrar
            'role' => 'admin',
            'status' => 1 // Activo
        ]);

        // 2. CREAR DOCUMENTOS USANDO EL ID DEL ADMIN RECIÉN CREADO
        Document::create([
            'titulo' => 'ISO 9001:2015 - Gestión de Calidad',
            'propietario_nombre' => 'TechSolutions Admin',
            'precio' => 150.00,
            'version' => '2015',
            'user_id' => $admin->id, // Usamos la variable $admin
            'bcosto' => 0
        ]);

        Document::create([
            'titulo' => 'ISO 27001 - Seguridad de Información',
            'propietario_nombre' => 'TechSolutions Admin',
            'precio' => 250.00,
            'version' => '2022',
            'user_id' => $admin->id,
            'bcosto' => 0
        ]);

        Document::create([
            'titulo' => 'ISO 45001 - Seguridad y Salud Laboral',
            'propietario_nombre' => 'TechSolutions Admin',
            'precio' => 190.00,
            'version' => '2018',
            'user_id' => $admin->id,
            'bcosto' => 0
        ]);
    }
}