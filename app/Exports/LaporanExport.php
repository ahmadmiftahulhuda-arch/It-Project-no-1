<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        // Define column headers for the export
        return [
            'ID Peminjaman',
            'Nama Peminjam',
            'NIM',
            'Prodi',
            'Email',
            'Tanggal',
            'Waktu Mulai',
            'Waktu Selesai',
            'Ruang',
            'Proyektor',
            'Keperluan',
            'Status',
        ];
    }

    public function map($peminjaman): array
    {
        // Map data for each row
        return [
            $peminjaman->id,
            $peminjaman->user->name ?? '-',
            $peminjaman->user->nim ?? '-',
            $peminjaman->user->prodi ?? '-',
            $peminjaman->user->email ?? '-',
            $peminjaman->tanggal,
            $peminjaman->waktu_mulai,
            $peminjaman->waktu_selesai,
            $peminjaman->ruangan->nama_ruangan ?? ($peminjaman->ruang ?? '-'),
            $peminjaman->projector->kode_proyektor ?? 'Tidak',
            $peminjaman->keperluan,
            ucfirst($peminjaman->status),
        ];
    }
}
