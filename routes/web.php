<?php

use Illuminate\Support\Facades\Route;
// use App\Models\siswa;
// use App\Models\guru;
use App\Models\Pkl;
use App\Models\Industri;
use App\Livewire\Pkl\Index as PklIndex;
use App\Livewire\Industri\Index as IndustriIndex;
use App\Livewire\Industri\Create as IndustriCreate;
use App\Livewire\Pkl\Create as PklCreate;
use App\Models\Siswa;

Route::get('/', function () {
    return view('welcome-custom');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'check_user_role',
    'role:Siswa',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'jumlahSiswa' => Siswa::count(),
            'jumlahIndustri' => Industri::count(),
            'jumlahSudahLapor' => Pkl::count(),
        ]);
    })->name('dashboard');

    // route untuk mengakses component product/Index
    Route::get('/pkl', App\Livewire\Pkl\Index::class)->name('pkl.index');
    Route::get('/industri', IndustriIndex::class)->name('industri.index');
    Route::get('/pkl/create', PklCreate::class)->name('pkl.create');
    Route::get('/industri/create', IndustriCreate::class)->name('industri.create');
});

// Route::view('/siswa', 'siswa', ['siswa' => Siswa::all()])->name('siswa');
// Route::view('/guru', 'guru', ['guru' => Guru::all()])->name('guru');
// Route::view('/pkl', 'pkl', ['pkl' => Pkl::all()])->name('pkl');
// Route::view('/industri', 'industri', ['industri' => Industri::all()])->name('industri');
