<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSiswas extends ManageRecords
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Siswa'), // Ganti teks tombol di sini
        ];
    }

    public function getTitle(): string
    {
        return 'Data Siswa'; // Opsional: ganti judul halaman
    }
}
