<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import Str facade untuk penggunaan UUID

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback'; // Pastikan ini sesuai dengan nama tabel Anda

    protected $fillable = [
        'tanggapan_id', 'user_id', 'isi_feedback', 'rating', 'status'
    ];

    public $incrementing = false; // Karena kita menggunakan UUID

    // Menentukan bahwa model harus di-boot dengan UUID
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function tanggapan()
    {
        return $this->belongsTo(Tanggapan::class, 'tanggapan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
