<?php

namespace App\Exports;

use App\Models\MataKuliah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MataKuliahExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MataKuliah::all();
    }

    /**
    * @param mixed $row
    * @return array
    */
    public function map($row): array
    {
        return [
            $row->id,
            $row->nama,
            $row->kode,
            $row->semester,
            $row->created_at->format('d M Y H:i'),
        ];
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Mata Kuliah',
            'Kode',
            'Semester',
            'Tanggal Dibuat',
        ];
    }
}
