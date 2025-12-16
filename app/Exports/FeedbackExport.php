<?php

namespace App\Exports;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FeedbackExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Feedback::with('peminjaman.user');

        // Apply filters
        if ($this->request->filled('search')) {
            $search = $this->request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('kategori', 'like', '%' . $search . '%')
                  ->orWhere('detail_feedback', 'like', '%' . $search . '%')
                  ->orWhereHas('peminjaman.user', function ($q2) use ($search) {
                      $q2->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($this->request->input('status') === 'published') {
            $query->where('status', 'Dipublikasikan');
        } elseif ($this->request->input('status') === 'draft') {
            $query->where('status', 'Draft');
        }

        if ($this->request->filled('rating')) {
            $query->where('rating', $this->request->input('rating'));
        }

        if ($this->request->filled('date')) {
            $query->whereDate('created_at', $this->request->input('date'));
        }

        if ($this->request->filled('kategori')) {
            $query->where('kategori', $this->request->input('kategori'));
        }

        return $query->get();
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
