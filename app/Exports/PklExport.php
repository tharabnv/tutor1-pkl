<?php

namespace App\Exports;

use App\Models\Pkl;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class PklExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        return Pkl::with(['siswa', 'guru', 'industri'])
            ->get()
            ->map(function ($pkl) {
                return [
                    'Nama Siswa'   => $pkl->siswa->nama,
                    'Nama Guru'    => $pkl->guru->nama,
                    'Nama Industri'=> $pkl->industri->nama,
                    'Mulai'        => $pkl->mulai,
                    'Selesai'      => $pkl->selesai,
                    'Created At'   => $pkl->created_at,
                    'Updated At'   => $pkl->updated_at,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Nama Guru',
            'Nama Industri',
            'Mulai',
            'Selesai',
            'Created At',
            'Updated At',
        ];
    }
}
