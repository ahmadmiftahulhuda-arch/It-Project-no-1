<?php

namespace App\Exports\Sheets;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCharts;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Illuminate\Support\Collection;

class RingkasanBulananSheet implements FromCollection, WithTitle, WithHeadings, WithCharts
{
    private $year;
    private $data;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        $results = Peminjaman::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereYear('tanggal', $this->year)
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->orderBy(DB::raw('MONTH(tanggal)'))
            ->get();

        // Fill in missing months with 0
        $monthlyData = array_fill(1, 12, 0);
        foreach ($results as $row) {
            $monthlyData[$row->bulan] = $row->jumlah;
        }

        $collection = new Collection();
        for ($i = 1; $i <= 12; $i++) {
            $collection->push([
                'bulan' => \Carbon\Carbon::create()->month($i)->format('F'),
                'jumlah' => $monthlyData[$i],
            ]);
        }
        
        $this->data = $collection;
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Bulan',
            'Jumlah Peminjaman',
        ];
    }

    public function title(): string
    {
        return 'Ringkasan Bulanan';
    }

    public function charts()
    {
        if ($this->data->isEmpty() || $this->data->sum('jumlah') === 0) {
            return []; // Jangan buat grafik jika tidak ada data
        }
        
        $lastRow = $this->data->count() + 1;

        $dataSeriesLabels = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, "'Ringkasan Bulanan'!\$B\$1", null, 1),
        ];

        $xAxisTickValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, "'Ringkasan Bulanan'!\$A\$2:\$A\$".$lastRow, null, $this->data->count()),
        ];

        $dataSeriesValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, "'Ringkasan Bulanan'!\$B\$2:\$B\$".$lastRow, null, $this->data->count()),
        ];

        $series = new DataSeries(
            DataSeries::TYPE_BARCHART,
            DataSeries::GROUPING_CLUSTERED,
            range(0, count($dataSeriesValues) - 1),
            $dataSeriesLabels,
            $xAxisTickValues,
            $dataSeriesValues
        );

        $plotArea = new PlotArea(null, [$series]);
        $legend = new Legend(Legend::POSITION_TOPRIGHT, null, false);
        $title = new Title('Peminjaman Bulanan Tahun ' . $this->year);
        $yAxisLabel = new Title('Jumlah Peminjaman');

        $chart = new Chart(
            'chart1',
            $title,
            $legend,
            $plotArea,
            true,
            0,
            null,
            $yAxisLabel
        );

        $chart->setTopLeftPosition('D2');
        $chart->setBottomRightPosition('O20');

        return $chart;
    }
}