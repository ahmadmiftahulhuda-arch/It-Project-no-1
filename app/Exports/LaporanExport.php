<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\PeminjamanDataTableSheet;
use App\Exports\Sheets\RingkasanBulananSheet;
use App\Exports\Sheets\DistribusiPeminjamanSheet;
use App\Exports\Sheets\PengembalianDataTableSheet;
use Carbon\Carbon;

class LaporanExport implements WithMultipleSheets
{
    use Exportable;

    protected $year;
    protected $startDate;
    protected $endDate;
    protected $reportType;

    public function __construct(string $reportType, int $year, Carbon $startDate, Carbon $endDate)
    {
        $this->reportType = $reportType;
        $this->year = $year;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        switch ($this->reportType) {
            case 'peminjaman':
            case 'penggunaan':
            case 'keseluruhan':
                $sheets[] = new PeminjamanDataTableSheet($this->startDate, $this->endDate);
                $sheets[] = new RingkasanBulananSheet($this->year);
                $sheets[] = new DistribusiPeminjamanSheet($this->startDate, $this->endDate);
                break;
            case 'pengembalian':
                $sheets[] = new PengembalianDataTableSheet($this->startDate, $this->endDate);
                // Tambahkan sheet ringkasan jika diperlukan
                break;
            case 'inventaris':
            case 'pengguna':
            default:
                // Fallback
                $sheets[] = new PeminjamanDataTableSheet($this->startDate, $this->endDate);
                break;
        }

        return $sheets;
    }
}