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
            'dosen',
            'pengembalian'
        ]);

        // 🔍 Filter pencarian
        if ($this->request->filled('search')) {
            $search = $this->request->search;

            $query->where(function ($q) use ($search) {
                $q->where('keperluan', 'like', "%{$search}%")
                  ->orWhereHas('user', fn ($u) =>
                        $u->where('name', 'like', "%{$search}%")
                          ->orWhere('nim', 'like', "%{$search}%")
                  )
                  ->orWhereHas('ruangan', fn ($r) =>
                        $r->where('nama_ruangan', 'like', "%{$search}%")
                  );
            });
        }

        // Filter status peminjaman
        if ($this->request->filled('status')) {
            $query->where('status', $this->request->status);
        }

        // Filter tanggal
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

        // ⏰ Status pengembalian (sesuai UI)
        if ($pengembalian) {
            if ($pengembalian->status === 'overdue') {
                $statusPengembalian = 'TERLAMBAT (' .
                    optional($pengembalian->tanggal_pengembalian)->format('H:i') . ')';
            } else {
                $statusPengembalian = strtoupper($pengembalian->status);
            }
        } else {
            $statusPengembalian = 'BELUM DIKEMBALIKAN';
        }

        return [
            // ID
            $item->id,

            // Peminjam
            $item->user->name ?? '-',

            // Dosen Pengampu
            $item->dosen->nama_dosen ?? '-',

            // Tanggal
            $item->tanggal,

            // Waktu
            ($item->waktu_mulai ?? '-') . ' - ' . ($item->waktu_selesai ?? '-'),

            // Ruang
            $item->ruangan->nama_ruangan ?? '-',

            // Proyektor
            $item->projector
                ? $item->projector->kode_proyektor
                : 'Tidak ada',

            // Keperluan
            $item->keperluan,

            // Status peminjaman
            ucfirst($item->status),

            // Status pengembalian
            $statusPengembalian,

            // Catatan
            $pengembalian->catatan ?? '-',

            // Dibuat pada
            optional($item->created_at)->format('d-m-Y'),

            // Terakhir diubah
            optional($item->updated_at)->format('d-m-Y'),

            // Tanggal pengembalian
            $pengembalian && $pengembalian->tanggal_pengembalian
                ? $pengembalian->tanggal_pengembalian->format('d-m-Y H:i')
                : '-',
        ];
    }

    public function headings(): array
    {
        return [
            'ID Peminjaman',
            'Peminjam',
            'Dosen Pengampu',
            'Tanggal Peminjaman',
            'Waktu',
            'Ruangan',
            'Proyektor',
            'Keperluan',
            'Status Peminjaman',
            'Status Pengembalian',
            'Catatan / Keterangan',
            'Dibuat Pada',
            'Terakhir Diubah',
            'Tanggal Pengembalian',
        ];
    }
}
