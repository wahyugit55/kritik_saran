<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class SchoolStaffSeeder extends Seeder
{
    public function run()
    {
        // Staff Sekolah Pertama
        User::create([
            'id' => Str::uuid()->toString(),
            'name' => 'Alice Smith',
            'email' => 'alicesmith@example.com',
            'password' => bcrypt('securepassword'), // Pastikan menggunakan password yang aman
            'role' => 'school_staff',
        ]);

        // Staff Sekolah Kedua
        User::create([
            'id' => Str::uuid()->toString(),
            'name' => 'Bob Johnson',
            'email' => 'bobjohnson@example.com',
            'password' => bcrypt('securepassword'), // Pastikan menggunakan password yang aman
            'role' => 'school_staff',
        ]);
    }
}
