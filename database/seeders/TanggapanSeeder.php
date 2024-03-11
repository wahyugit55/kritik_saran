<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tanggapan;
use Illuminate\Support\Str;

class TanggapanSeeder extends Seeder
{
    public function run()
    {
        Tanggapan::create([
            'id' => Str::uuid(),
            'kritik_id' => 'e9c6df8e-beea-4c97-a34c-f41be0a5a3ad', // Asumsi kritik_id
            'user_id' => 'b4949ace-30cd-402b-9546-895b2602403d', // Asumsi user_id
            'isi_tanggapan' => 'Terima kasih atas masukannya, kami akan segera menindaklanjuti.',
            'level_prioritas' => 1, // Asumsi level prioritas
            'status' => true // Asumsi status adalah true
        ]);
        // Tambahkan lebih banyak Tanggapan::create(...) jika Anda ingin menambahkan lebih banyak data
    }
}
