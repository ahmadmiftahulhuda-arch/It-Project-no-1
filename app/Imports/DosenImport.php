<?php

namespace App\Imports;

use App\Models\Dosen;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Throwable;

class DosenImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use Importable;

    public function model(array $row)
    {
        // Normalize keys
        $nip = isset($row['nip']) ? trim((string) $row['nip']) : null;
        $nama = $row['nama_dosen'] ?? ($row['nama'] ?? null);

        if (empty($nip) || empty($nama)) {
            return null;
        }

        // Upsert by nip
        try {
            return Dosen::updateOrCreate(
                ['nip' => $nip],
                ['nama_dosen' => $nama]
            );
        } catch (Throwable $e) {
            Log::error('DosenImport error for NIP ' . $nip . ': ' . $e->getMessage());
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'nip' => 'required',
            'nama_dosen' => 'required',
        ];
    }

    public function onError(Throwable $e)
    {
        // Log and continue on row errors
        Log::error('DosenImport onError: ' . $e->getMessage());
    }
}
