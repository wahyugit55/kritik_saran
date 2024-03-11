<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str; // Import Str facade untuk penggunaan UUID

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Override incrementing property untuk menunjukkan bahwa ID bukan auto-incrementing
    public $incrementing = false;

    // Menentukan tipe kunci utama sebagai string
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan 'role' di sini untuk membuatnya mass assignable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if the user is a Super Admin.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if the user is part of School Staff.
     *
     * @return bool
     */
    public function isSchoolStaff()
    {
        return $this->role === 'school_staff';
    }

    /**
     * Check if the user is a Student.
     *
     * @return bool
     */
    public function isStudent()
    {
        return $this->role === 'student';
    }

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

    public function kategoriKritiks()
    {
        return $this->hasMany(KategoriKritik::class, 'user_id', 'id');
    }

    public function kritikSaran()
    {
        return $this->hasMany(KritikSaran::class, 'user_id', 'id');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'user_id', 'id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'user_id', 'id');
    }
}
