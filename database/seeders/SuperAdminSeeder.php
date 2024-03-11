<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
            // Tambahkan kolom lain yang diperlukan sesuai skema database Anda
            'role' => 'super_admin', // Pastikan Anda memiliki kolom 'role' atau yang serupa di tabel 'users'
        ]);
    }
}
