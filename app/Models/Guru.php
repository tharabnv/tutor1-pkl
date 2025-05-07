<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Guru extends Model
{
    use HasFactory;
    use HasRoles;

    protected $fillable = [
        'nama',
        'nip',
        'gender',
        'alamat',
        'kontak',
        'email',
    ];

    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($guru) {
            if (!preg_match('/^[\d()+]+$/', $guru->kontak) || strlen(preg_replace('/\D/', '', $guru->kontak)) > 15) {
                throw new \Exception('Format kontak tidak valid atau melebihi 15 digit angka.');
            }

            if (!str_ends_with($guru->email, '@gurusija.com')) {
                throw new \Exception('Email harus menggunakan domain @gurusija.com');
    }
    });
}

}
