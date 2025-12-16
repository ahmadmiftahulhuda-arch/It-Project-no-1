<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $no = 1;

    public function collection()
    {
        return Peminjaman::with([
            'user',
            'ruangan',
            'projector',
            'dosen'
        ])->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Peminjam',
            'NIM',
            'Email',
            'No. HP',
            'Tanggal',
            'Waktu',
            'Ruangan',
            'Proyektor',
            'Dosen Pengampu',
            'Keperluan',
            'Status',
        ];
    }

    public function map($p): array
    {
        return [
            $this->no++,
            $p->user->name ?? '-',
            $p->user->nim ?? '-',
            $p->user->email ?? '-',
            $p->user->no_hp ?? '-',
            $p->tanggal,
            ($p->waktu_mulai ?? '-') . ' - ' . ($p->waktu_selesai ?? '-'),
            $p->ruangan->nama_ruangan ?? '-',
            $p->projector
                ? $p->projector->kode_proyektor
                : 'Tidak',
            $p->dosen->nama_dosen ?? '-',
            $p->keperluan,
            ucfirst($p->status),
        ];
    }
}
