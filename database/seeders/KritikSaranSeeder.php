<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KritikSaran;
use Illuminate\Support\Str;

class KritikSaranSeeder extends Seeder
{
    public function run()
    {
        KritikSaran::create([
            'id' => Str::uuid(),
            'user_id' => '722c05ad-63d2-498d-8fba-c6c3bb96afff', // Asumsi ID user
            'isi' => 'Ini adalah contoh kritik dan saran.',
            'gambar' => null, // Asumsikan tidak ada gambar
            'kategori_id' => 'a07613c5-844b-44b8-b741-4c6fd76aadf8', // Asumsi ID kategori
            'status' => false, // Asumsi status awal adalah false
        ]);
        // Tambahkan lebih banyak KritikSaran::create(...) jika Anda ingin menambahkan lebih banyak data
    }
}
