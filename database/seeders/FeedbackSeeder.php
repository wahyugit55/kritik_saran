<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feedback;
use Illuminate\Support\Str;

class FeedbackSeeder extends Seeder
{
    public function run()
    {
        Feedback::create([
            'id' => Str::uuid(),
            'tanggapan_id' => '7dd45c61-f44e-4874-ab4f-77a45db6ab46',
            'user_id' => '722c05ad-63d2-498d-8fba-c6c3bb96afff',
            'isi_feedback' => 'Sangat membantu, terima kasih!',
            'rating' => 5,
            'status' => true
        ]);
        // Tambahkan lebih banyak entri sesuai kebutuhan
    }
}
