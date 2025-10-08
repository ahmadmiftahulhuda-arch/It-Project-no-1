@extends('layouts.app') {{-- Sesuaikan dengan layout utama Anda --}}

@section('title', 'Beri Feedback')

@push('styles')
<style>
    .rating {
        display: inline-block;
        font-size: 2rem;
        color: #d3d3d3;
        cursor: pointer;
    }
    .rating > span:hover,
    .rating > span:hover ~ span,
    .rating > input:checked ~ span {
        color: #ffc107;
    }
    .rating > input {
        display: none;
    }
    .rating > label {
        float: right;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Beri Feedback Peminjaman</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($peminjamans->isEmpty())
                        <div class="alert alert-info">
                            <p class="mb-0">Tidak ada peminjaman yang perlu diberi feedback saat ini. Terima kasih!</p>
                        </div>
                    @else
                        <form action="{{ route('user.feedback.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="id_peminjaman" class="form-label">Pilih Peminjaman</label>
                                <select name="id_peminjaman" id="id_peminjaman" class="form-select @error('id_peminjaman') is-invalid @enderror" required>
                                    <option value="">-- Pilih Peminjaman yang Selesai --</option>
                                    @foreach($peminjamans as $peminjaman)
                                        <option value="{{ $peminjaman->id }}">
                                            Peminjaman Ruang {{ $peminjaman->ruangan->nama_ruangan ?? 'N/A' }} pada {{ $peminjaman->tanggal->format('d M Y') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_peminjaman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rating Anda</label>
                                <div class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars"><span>&#9733;</span></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars"><span>&#9733;</span></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"><span>&#9733;</span></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars"><span>&#9733;</span></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"><span>&#9733;</span></label>
                                </div>
                                @error('rating')
                                    <div class="text-danger d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="komentar" class="form-label">Komentar (Opsional)</label>
                                <textarea name="komentar" id="komentar" class="form-control @error('komentar') is-invalid @enderror" rows="4" placeholder="Bagaimana pengalaman Anda?"></textarea>
                                @error('komentar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Kirim Feedback</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
