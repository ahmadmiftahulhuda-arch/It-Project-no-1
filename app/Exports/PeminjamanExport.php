<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Peminjaman::with('user','ruangan','projector')->get();
    }

    public function headings(): array
    {
        return [
            'No',
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

    public function map($p): array
    {
        return [
            $p->id,
            $p->user->name ?? '-',
            $p->user->nim ?? '-',
            $p->user->prodi ?? '-',
            $p->user->email ?? '-',
            $p->tanggal,
            $p->waktu_mulai,
            $p->waktu_selesai,
            $p->ruangan->nama_ruangan ?? $p->ruang,
            $p->projector->kode_proyektor ?? 'Tidak',
            $p->keperluan,
            ucfirst($p->status),
        ];
    }
}
