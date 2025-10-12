@extends('admin.layouts.app')

@section('title', 'Feedback Saya')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kirim Feedback Baru</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('user.feedback.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="feedback">Pesan Anda</label>
                                <textarea name="feedback" id="feedback" class="form-control @error('feedback') is-invalid @enderror" rows="5" required>{{ old('feedback') }}</textarea>
                                @error('feedback')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Riwayat Feedback Anda</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Feedback</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($feedbacks as $key => $item)
                                    <tr>
                                        <td>{{ $feedbacks->firstItem() + $key }}</td>
                                        <td>{{ Str::limit($item->feedback, 100) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->status == 'pending' ? 'warning' : 'success' }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $item->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <a href="{{ route('user.feedback.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <form action="{{ route('user.feedback.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus feedback ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Anda belum pernah mengirim feedback.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $feedbacks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection