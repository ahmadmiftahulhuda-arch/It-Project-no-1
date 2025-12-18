<?php

namespace App\Exports\Sheets;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Carbon\Carbon;

class PeminjamanDataTableSheet implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    private $startDate;
    private $endDate;

    public function __construct(Carbon $startDate, Carbon $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Peminjaman::with('user', 'dosen', 'ruangan')
            ->whereBetween('tanggal', [$this->startDate, $this->endDate])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Peminjam',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Dosen',
            'Keperluan/Mata Kuliah',
            'Ruangan',
            'Status',
        ];
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->id,
            $peminjaman->user->name ?? 'N/A',
            $peminjaman->tanggal,
            $peminjaman->tanggal_kembali,
            $peminjaman->dosen->nama_dosen ?? 'N/A',
            $peminjaman->keperluan,
            $peminjaman->ruangan->nama_ruangan ?? 'N/A',
            $peminjaman->status,
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Data Peminjaman';
    }
}
