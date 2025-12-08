<?php

namespace App\Imports;

use App\Models\SlotWaktu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class SlotWaktuImport implements ToModel, WithHeadingRow
{
    /**
     * Normalize Excel time values and upsert slot rows.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $rawId = $row['id_slot'] ?? ($row['id'] ?? null);
        $rawWaktu = $row['waktu'] ?? null;

        $formatExcelTime = function ($val) {
            if ($val instanceof \DateTime) {
                return $val->format('H:i');
            }
            if (is_numeric($val) && $val > 0 && $val < 1) {
                try {
                    $dt = ExcelDate::excelToDateTimeObject($val);
                    return $dt->format('H:i');
                } catch (\Exception $e) {
                    // fallthrough
                }
            }
            return is_null($val) ? null : trim((string) $val);
        };

        $waktu = $formatExcelTime($rawWaktu ?? $rawId);

        // Determine id_slot: prefer provided id, but normalize into H:i format
        // so id_slot uses colon separator like the `waktu` column.
        $idSlot = $rawId;

        // If Excel numeric time (fraction), use formatted waktu (H:i)
        if (is_numeric($rawId) && $rawId > 0 && $rawId < 1) {
            $idSlot = $waktu;
        }

        // If idSlot is numeric like '0730' or '730', insert colon to make '07:30' or '7:30'
        if (!empty($idSlot) && is_string($idSlot)) {
            $clean = preg_replace('/[^0-9]/', '', $idSlot);
            if (preg_match('/^\d{3,4}$/', $clean)) {
                // Pad to 4 digits if needed, then insert colon
                $clean = str_pad($clean, 4, '0', STR_PAD_LEFT);
                $idSlot = substr($clean, 0, -2) . ':' . substr($clean, -2);
            }
        }

        if (empty($idSlot)) {
            // fallback to using waktu as id (safe string with colon)
            $idSlot = $waktu;
        }

        if (empty($idSlot) && empty($waktu)) {
            // nothing to import
            return null;
        }

        // Use updateOrCreate to avoid duplicate key errors and allow reimporting
        return SlotWaktu::updateOrCreate(
            ['id_slot' => $idSlot],
            ['waktu' => $waktu]
        );
    }
}
