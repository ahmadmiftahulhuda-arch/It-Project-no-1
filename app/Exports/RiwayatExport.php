<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RiwayatExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Peminjaman::with([
            'user',
            'ruangan',
            'projector',
            'pengembalian'
        ]);

        // 🔍 Filter pencarian
        if ($this->request->filled('search')) {
            $search = $this->request->search;

            $query->where(function ($q) use ($search) {
                $q->where('keperluan', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                  })
                  ->orWhereHas('ruangan', function ($r) use ($search) {
                      $r->where('nama_ruangan', 'like', "%{$search}%");
                  });
            });
        }

        // 🔘 Filter status peminjaman
        if ($this->request->filled('status')) {
            $query->where('status', $this->request->status);
        }

        // 📅 Filter tanggal
        if ($this->request->filled('date_from')) {
            $query->whereDate('tanggal', '>=', $this->request->date_from);
        }

        if ($this->request->filled('date_to')) {
            $query->whereDate('tanggal', '<=', $this->request->date_to);
        }

        return $query->orderBy('tanggal', 'desc')->get();
    }

    public function map($item): array
    {
        $pengembalian = $item->pengembalian;

        return [
            $item->id,
            $item->user->name ?? '-',
            $item->tanggal,
            $item->ruangan->nama_ruangan ?? '-',
            $item->projector
                ? $item->projector->kode_proyektor
                : 'Tanpa Proyektor',
            $item->keperluan,
            ucfirst($item->status),

            // Status pengembalian
            $pengembalian
                ? strtoupper($pengembalian->status)
                : 'BELUM DIKEMBALIKAN',

            // Tanggal pengembalian
            $pengembalian && $pengembalian->tanggal_pengembalian
                ? $pengembalian->tanggal_pengembalian
                : '-',
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Peminjam',
            'Tanggal Peminjaman',
            'Ruangan',
            'Proyektor',
            'Keperluan',
            'Status Peminjaman',
            'Status Pengembalian',
            'Tanggal Pengembalian',
        ];
    }
}
