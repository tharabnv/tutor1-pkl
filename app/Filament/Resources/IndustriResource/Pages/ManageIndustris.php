<?php

namespace App\Filament\Resources\IndustriResource\Pages;

use App\Filament\Resources\IndustriResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageIndustris extends ManageRecords
{
    protected static string $resource = IndustriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Industri'), // Ganti teks tombol di sini
        ];
    }

    public function getTitle(): string
    {
        return 'Data Industri'; // Opsional: ganti judul halaman
    }
    
}
