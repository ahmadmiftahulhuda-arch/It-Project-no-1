<?php

namespace App\Exports;

use App\Models\Feedback;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping; // Added WithMapping interface

class FeedbackExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Feedback::with('peminjaman.user')->get();
    }

    public function map($feedback): array
    {
        return [
            $feedback->id,
            $feedback->peminjaman->user->name ?? '-',
            $feedback->peminjaman->user->email ?? '-',
            $feedback->peminjaman->keperluan ?? '-',
            $feedback->kategori,
            $feedback->rating,
            $feedback->detail_feedback,
            $feedback->status,
            $feedback->created_at->format('d M Y H:i'),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Peminjam',
            'Email Peminjam',
            'Keperluan Peminjaman',
            'Kategori',
            'Rating',
            'Detail Feedback',
            'Status',
            'Tanggal',
        ];
    }
}
