<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;

class RiwayatExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Peminjaman::with(['user','ruangan','projector']);

        // Filter search
        if ($this->request->search) {
            $search = $this->request->search;
            $query->where(function($q) use ($search) {
                $q->where('keperluan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter status
        if ($this->request->status) {
            $query->where('status', $this->request->status);
        }

        // Filter tanggal
        if ($this->request->date_from) {
            $query->whereDate('tanggal', '>=', $this->request->date_from);
        }

        if ($this->request->date_to) {
            $query->whereDate('tanggal', '<=', $this->request->date_to);
        }

        return $query->latest()->get();
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->user->name ?? '-',
            $item->tanggal,
            $item->ruangan->nama_ruangan ?? '-',
            $item->projector->kode_proyektor ?? 'Tidak',
            $item->keperluan,
            ucfirst($item->status),
            $item->status_pengembalian ?? 'Belum dikembalikan',
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Peminjam',
            'Tanggal',
            'Ruangan',
            'Proyektor',
            'Keperluan',
            'Status Peminjaman',
            'Status Pengembalian',
        ];
    }
}
