<?php

use Illuminate\Support\Facades\Route;
// use App\Models\siswa;
// use App\Models\guru;
use App\Models\pkl;
// use App\Models\industri;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // route untuk mengakses component product/Index
    Route::get('/product', App\Livewire\Product\Index::class)->name('product.index');
});

// Route::view('/siswa', 'siswa', ['siswa' => Siswa::all()])->name('siswa');
// Route::view('/guru', 'guru', ['guru' => Guru::all()])->name('guru');
Route::view('/pkl', 'pkl', ['pkl' => Pkl::all()])->name('pkl');
// Route::view('/industri', 'industri', ['industri' => Industri::all()])->name('industri');
