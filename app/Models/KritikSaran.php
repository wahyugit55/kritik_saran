<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import Str facade untuk penggunaan UUID

class KritikSaran extends Model
{
    use HasFactory;

    protected $table = 'kritik_saran'; // Pastikan ini sesuai dengan nama tabel Anda

    protected $fillable = [
        'user_id', 'isi', 'gambar', 'kategori_id', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kategoriKritik()
    {
        return $this->belongsTo(KategoriKritik::class, 'kategori_id', 'id');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'kritik_id', 'id');
    }
    
}
