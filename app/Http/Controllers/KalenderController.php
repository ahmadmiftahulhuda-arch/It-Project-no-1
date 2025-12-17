<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPerkuliahan;
use App\Models\MataKuliah;
use App\Models\Kelas;
use Carbon\Carbon;

class KalenderController extends Controller
{
    public function index(Request $request)
    {
        $kelasMahasiswa = JadwalPerkuliahan::distinct()->pluck('kelas_mahasiswa');
        $selectedKelas = $request->input('kelas_mahasiswa');
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $date = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $date->daysInMonth;
        $startOfMonth = $date->startOfMonth();

        // Get all MataKuliah and assign colors
        $mataKuliahs = MataKuliah::all();
        $colors = ['#FFADAD', '#FFD6A5', '#FDFFB6', '#CAFFBF', '#9BF6FF', '#A0C4FF', '#BDB2FF', '#FFC6FF'];
        $matakuliahColors = [];
        $colorIndex = 0;
        foreach ($mataKuliahs as $matakuliah) {
            $matakuliahColors[$matakuliah->nama] = $colors[$colorIndex % count($colors)];
            $colorIndex++;
        }

        $events = [];
        $dayMapping = ['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat'];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDate = Carbon::createFromDate($year, $month, $day);
            $dayOfWeek = $currentDate->format('l');

            if (in_array($dayOfWeek, array_keys($dayMapping))) {
                $query = JadwalPerkuliahan::with('mataKuliah')->where('hari', $dayMapping[$dayOfWeek]);

                if ($selectedKelas) {
                    $query->where('kelas_mahasiswa', $selectedKelas);
                }

                $jadwal = $query->get();

                foreach ($jadwal as $item) {
                    if ($item->mataKuliah) {
                        $events[] = [
                            'title' => $item->mataKuliah->nama . ' - ' . $item->nama_kelas,
                            'start' => $currentDate->format('Y-m-d') . ' ' . $item->jam_mulai,
                            'end' => $currentDate->format('Y-m-d') . ' ' . $item->jam_selesai,
                            'hari' => $item->hari,
                            'day' => $day,
                            'matakuliah' => $item->mataKuliah->nama,
                            'color' => $matakuliahColors[$item->mataKuliah->nama] ?? '#E0E0E0'
                        ];
                    }
                }
            }
        }

        return view('kalender', compact('kelasMahasiswa', 'events', 'selectedKelas', 'month', 'year', 'matakuliahColors'));
    }

    private function getEventDate($day, $time)
    {
        $dayMapping = [
            'Senin' => 'monday',
            'Selasa' => 'tuesday',
            'Rabu' => 'wednesday',
            'Kamis' => 'thursday',
            'Jumat' => 'friday',
        ];

        if (!isset($dayMapping[$day])) {
            return null;
        }

        $date = new Carbon();
        $date->next($dayMapping[$day]);
        $timeParts = explode(':', $time);
        $date->setTime($timeParts[0], $timeParts[1]);

        return $date->toDateTimeString();
    }
}
