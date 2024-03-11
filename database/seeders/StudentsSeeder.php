<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class StudentsSeeder extends Seeder
{
    public function run()
    {
        // Siswa Pertama
        User::create([
            'id' => Str::uuid()->toString(),
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'), // Ganti dengan password yang lebih aman di produksi
            'role' => 'student',
        ]);

        // Siswa Kedua
        User::create([
            'id' => Str::uuid()->toString(),
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'password' => bcrypt('password'), // Ganti dengan password yang lebih aman di produksi
            'role' => 'student',
        ]);
    }
}
