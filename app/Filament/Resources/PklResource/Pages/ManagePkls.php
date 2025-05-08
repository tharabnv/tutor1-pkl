<?php

namespace App\Filament\Resources\PklResource\Pages;

use App\Filament\Resources\PklResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePkls extends ManageRecords
{
    protected static string $resource = PklResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Data PKL'), // Ganti teks tombol di sini
        ];
    }

    public function getTitle(): string
    {
        return 'Data Praktik Kerja Lapangan'; // Opsional: ganti judul halaman
    }

    protected function getFooterActions(): array
    {
        return [
            Actions\Action::make('export')
                ->label('Unduh Semua Data')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    return Excel::download(new PklExport, 'data-pkl.xlsx');
                }),
        ];
    }
}
