<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriKritik;
use App\Models\User;
use Illuminate\Support\Str;

class KategoriKritikSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // Dapatkan user pertama atau sesuai kebutuhan

        if ($user) {
            $kategori = [
                'Fasilitas',
                'Kurikulum',
                'Lingkungan Sekolah',
                'Ekstrakurikuler',
                'Pelayanan Administrasi'
            ];

            foreach ($kategori as $item) {
                KategoriKritik::create([
                    'id' => Str::uuid(),
                    'nama' => $item,
                    'user_id' => $user->id, // Pastikan 'user_id' ini sesuai dengan User yang ada
                    'status' => true
                ]);
            }
        }
    }
}
