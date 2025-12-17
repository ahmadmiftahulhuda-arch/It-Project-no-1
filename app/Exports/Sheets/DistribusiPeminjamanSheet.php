<?php

namespace App\Exports\Sheets;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCharts;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Carbon\Carbon;

class DistribusiPeminjamanSheet implements FromArray, WithTitle, WithHeadings, WithCharts
{
    private $startDate;
    private $endDate;
    private $chartData;

    public function __construct(Carbon $startDate, Carbon $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function array(): array
    {
        $distribusiData = Peminjaman::whereBetween('tanggal', [$this->startDate, $this->endDate])
            ->select(
                DB::raw('SUM(CASE WHEN projector_id IS NOT NULL THEN 1 ELSE 0 END) as proyektor'),
                DB::raw('SUM(CASE WHEN projector_id IS NULL THEN 1 ELSE 0 END) as ruangan_saja')
            )->first();
        
        $this->chartData = [
            'Dengan Proyektor' => $distribusiData->proyektor ?? 0,
            'Ruangan Saja' => $distribusiData->ruangan_saja ?? 0,
        ];

        return [
            ['Dengan Proyektor', $this->chartData['Dengan Proyektor']],
            ['Ruangan Saja', $this->chartData['Ruangan Saja']],
        ];
    }

    public function headings(): array
    {
        return [
            'Tipe Peminjaman',
            'Jumlah',
        ];
    }

    public function title(): string
    {
        return 'Distribusi Peminjaman';
    }

    public function charts()
    {
        if (empty($this->chartData) || array_sum($this->chartData) === 0) {
            return []; // Jangan buat grafik jika tidak ada data
        }

        $dataSeriesLabels = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, "'Distribusi Peminjaman'!\$A\$2:\$A\$3", null, 2),
        ];

        $dataSeriesValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, "'Distribusi Peminjaman'!\$B\$2:\$B\$3", null, 2),
        ];

        $series = new DataSeries(
            DataSeries::TYPE_PIECHART,
            null, // Pie charts don't have grouping
            range(0, count($dataSeriesValues) - 1),
            [], // Labels are taken from the categories for pie charts
            $dataSeriesLabels,
            $dataSeriesValues
        );

        $plotArea = new PlotArea(null, [$series]);
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        $title = new Title('Distribusi Peminjaman');
        
        $chart = new Chart(
            'chart1',
            $title,
            $legend,
            $plotArea
        );

        $chart->setTopLeftPosition('D2');
        $chart->setBottomRightPosition('K15');

        return $chart;
    }
}