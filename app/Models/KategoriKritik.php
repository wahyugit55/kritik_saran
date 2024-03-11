<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import Str facade untuk penggunaan UUID

class KategoriKritik extends Model
{
    use HasFactory;

    protected $table = 'kategori_kritik'; // Pastikan ini sesuai dengan nama tabel Anda

    protected $fillable = ['name', 'status', 'user_id']; // Sesuaikan dengan kolom tabel

    protected $casts = [
        'id' => 'string',
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

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kritikSaran()
    {
        return $this->hasMany(KritikSaran::class, 'kategori_id', 'id');
    }
}
