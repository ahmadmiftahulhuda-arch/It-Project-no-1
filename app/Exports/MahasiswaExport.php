<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MahasiswaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $kelasId;

    public function __construct($kelasId)
    {
        $this->kelasId = $kelasId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mahasiswa::where('kelas_id', $this->kelasId)->get();
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama',
            'Kordinator Kelas',
        ];
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->nim,
            $mahasiswa->nama,
            $mahasiswa->kordinator,
        ];
    }
}
