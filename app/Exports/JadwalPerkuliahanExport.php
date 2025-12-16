<?php

namespace App\Exports;

use App\Models\JadwalPerkuliahan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JadwalPerkuliahanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection(): Collection
    {
        $query = JadwalPerkuliahan::query();

        // Filter sama persis dengan index
        if (!empty($this->filters['search'])) {
            $query->where(function ($q) {
                $q->where('kode_matkul', 'like', "%{$this->filters['search']}%")
                  ->orWhere('nama_kelas', 'like', "%{$this->filters['search']}%")
                  ->orWhere('ruangan', 'like', "%{$this->filters['search']}%");
            });
        }

        if (!empty($this->filters['hari'])) {
            $query->where('hari', $this->filters['hari']);
        }

        if (!empty($this->filters['ruangan'])) {
            $query->where('ruangan', $this->filters['ruangan']);
        }

        if (!empty($this->filters['sistem_kuliah'])) {
            $query->where('sistem_kuliah', $this->filters['sistem_kuliah']);
        }

        return $query
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat')")
            ->orderBy('jam_mulai')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Kode Matkul',
            'Sistem Kuliah',
            'Nama Kelas',
            'Kelas Mahasiswa',
            'Sebaran Mahasiswa',
            'Hari',
            'Jam Mulai',
            'Jam Selesai',
            'Ruangan',
            'Daya Tampung',
        ];
    }

    public function map($row): array
    {
        return [
            $row->kode_matkul,
            $row->sistem_kuliah,
            $row->nama_kelas,
            $row->kelas_mahasiswa,
            $row->sebaran_mahasiswa,
            $row->hari,
            $row->jam_mulai,
            $row->jam_selesai,
            $row->ruangan,
            $row->daya_tampung,
        ];
    }
}
