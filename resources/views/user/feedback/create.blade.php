<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .feedback-form { max-width: 800px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .form-header { background: linear-gradient(90deg, #4a00e0, #8e2de2); color: white; padding: 20px; border-radius: 10px 10px 0 0; margin: -30px -30px 30px -30px; text-align: center; }
        .btn-submit { background: linear-gradient(90deg, #4a00e0, #8e2de2); border: none; }
        .rating-stars .star { font-size: 2rem; color: #ddd; cursor: pointer; transition: color 0.2s; }
        .rating-stars .star:hover, .rating-stars .star.selected { color: #ffc107; }
        .peminjaman-info { border-left: 4px solid #8e2de2; padding-left: 15px; margin-bottom: 20px; background-color: #f9f9f9; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="feedback-form">
            <div class="form-header">
                <h2>Form Feedback Sarana Prasarana</h2>
                <p>Berikan masukan Anda untuk meningkatkan kualitas fasilitas kami</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('user.feedback.store') }}" method="POST" id="feedbackForm">
                @csrf

                @if(isset($peminjaman))
                    <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">
                    <div class="peminjaman-info">
                        <p class="mb-0">Anda memberikan feedback untuk peminjaman:</p>
                        <h5 class="mb-0"><strong>{{ $peminjaman->keperluan ?? 'Peminjaman ID: ' . $peminjaman->id }}</strong></h5>
                    </div>
                @else
                    <div class="mb-3">
                        <label for="peminjaman_id" class="form-label">Pilih Peminjaman yang akan diberi Feedback *</label>
                        <select class="form-select @error('peminjaman_id') is-invalid @enderror" id="peminjaman_id" name="peminjaman_id" required>
                            <option value="" selected disabled>-- Pilih Peminjaman --</option>
                            @foreach($peminjamans as $item)
                                <option value="{{ $item->id }}" {{ old('peminjaman_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->keperluan ?? 'Peminjaman ID: ' . $item->id }} ({{ $item->tanggal }})
                                </option>
                            @endforeach
                        </select>
                        @error('peminjaman_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori Feedback *</label>
                        <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="Fasilitas Ruangan" {{ old('kategori') == 'Fasilitas Ruangan' ? 'selected' : '' }}>Fasilitas Ruangan</option>
                            <option value="Kebersihan" {{ old('kategori') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                            <option value="Layanan Staff" {{ old('kategori') == 'Layanan Staff' ? 'selected' : '' }}>Layanan Staff</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rating Kepuasan *</label>
                        <div class="rating-stars" id="rating-container">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                        </div>
                        <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}" required>
                         @error('rating') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Feedback *</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Ringkasan singkat feedback Anda" value="{{ old('judul') }}" required>
                     @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="detail_feedback" class="form-label">Detail Feedback *</label>
                    <textarea class="form-control @error('detail_feedback') is-invalid @enderror" id="detail_feedback" name="detail_feedback" rows="4" placeholder="Jelaskan detail masalah atau feedback yang ingin Anda sampaikan..." required>{{ old('detail_feedback') }}</textarea>
                     @error('detail_feedback') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="saran_perbaikan" class="form-label">Saran Perbaikan (opsional)</label>
                    <textarea class="form-control" id="saran_perbaikan" name="saran_perbaikan" rows="3" placeholder="Berikan saran untuk perbaikan...">{{ old('saran_perbaikan') }}</textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary btn-submit px-4">Kirim Feedback</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.rating-stars .star');
            const ratingInput = document.getElementById('rating');

            function setRating(value) {
                ratingInput.value = value;
                stars.forEach(star => {
                    star.classList.toggle('selected', star.dataset.value <= value);
                });
            }
            
            if(ratingInput.value) {
                setRating(ratingInput.value);
            }

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    setRating(star.dataset.value);
                });
            });
        });
    </script>
</body>
</html>