<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Siswa extends Model
{
    use HasFactory;
    use HasRoles;

    protected $fillable = [
        'nama',
        'nis',
        'gender',
        'alamat',
        'kontak',
        'email',
        'status_pkl',
        'foto',
    ];

    // Relasi ke PKL (satu siswa satu PKL)
    public function pkl()
    {
        return $this->hasOne(Pkl::class);
    }
}