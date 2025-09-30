@extends('layouts.app')

@section('content')
<div class="container">
    <div class="dashboard-title">
        <h1>Edit Feedback</h1>
        <p>Edit feedback dari pengguna Lab Teknologi Informasi</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('feedback.update', $feedback->id_feedback) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <!-- Kolom Kiri -->
                    <div class="form-column">
                        <div class="form-group">
                            <label for="nama_peminjam" class="form-label">Nama Peminjam *</label>
                            <input type="text" class="form-control" id="nama_peminjam" 
                                   value="{{ $feedback->peminjaman->nama ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="id_pengembalian" class="form-label">ID Pengembalian</label>
                            <input type="text" class="form-control" id="id_pengembalian" 
                                   value="{{ $feedback->peminjaman->id_pengembalian ?? 'RTN001' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="rating" class="form-label">Rating *</label>
                            <select name="rating" id="rating" class="form-control" required>
                                <option value="1" {{ $feedback->rating == 1 ? 'selected' : '' }}>1 ★</option>
                                <option value="2" {{ $feedback->rating == 2 ? 'selected' : '' }}>2 ★★</option>
                                <option value="3" {{ $feedback->rating == 3 ? 'selected' : '' }}>3 ★★★</option>
                                <option value="4" {{ $feedback->rating == 4 ? 'selected' : '' }}>4 ★★★★</option>
                                <option value="5" {{ $feedback->rating == 5 ? 'selected' : '' }}>5 ★★★★★</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="form-column">
                        <div class="form-group">
                            <label class="form-label">ID Feedback</label>
                            <input type="text" class="form-control" 
                                   value="FB{{ str_pad($feedback->id_feedback, 3, '0', STR_PAD_LEFT) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="no_telepon" class="form-label">Nomor Telepon *</label>
                            <input type="text" class="form-control" id="no_telepon" 
                                   value="{{ $feedback->peminjaman->no_telepon ?? '081234567890' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama_barang" class="form-label">Nama Barang *</label>
                            <input type="text" class="form-control" id="nama_barang" 
                                   value="{{ $feedback->peminjaman->barang->nama_barang ?? '-' }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="komentar" class="form-label">Komentar *</label>
                    <textarea name="komentar" id="komentar" class="form-control" rows="5" maxlength="500" 
                              placeholder="Tulis komentar Anda..." required>{{ $feedback->komentar }}</textarea>
                    <div class="char-count">
                        <span id="charCount">{{ strlen($feedback->komentar) }}</span>/500 karakter
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status Publikasi</label>
                    <div class="status-radio-group">
                        <label class="radio-label">
                            <input type="radio" name="status" value="Dipublikasikan" 
                                   {{ $feedback->status == 'Dipublikasikan' ? 'checked' : '' }}>
                            <span class="radio-custom"></span>
                            Dipublikasikan
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="status" value="Draft" 
                                   {{ $feedback->status == 'Draft' ? 'checked' : '' }}>
                            <span class="radio-custom"></span>
                            Draft
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('feedback.index') }}" class="btn btn-cancel">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Feedback</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card {
    background: var(--card);
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 25px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-column {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-group {
    margin-bottom: 15px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text);
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--card);
    color: var(--text);
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.form-control:read-only {
    background: var(--background);
    color: var(--text-light);
}

.status-radio-group {
    display: flex;
    gap: 20px;
    margin-top: 10px;
}

.radio-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: 500;
}

.radio-label input {
    display: none;
}

.radio-custom {
    width: 18px;
    height: 18px;
    border: 2px solid var(--border);
    border-radius: 50%;
    margin-right: 8px;
    position: relative;
    transition: all 0.3s ease;
}

.radio-label input:checked + .radio-custom {
    border-color: var(--primary);
    background: var(--primary);
}

.radio-label input:checked + .radio-custom::after {
    content: '';
    width: 8px;
    height: 8px;
    background: white;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.char-count {
    text-align: right;
    font-size: 12px;
    color: var(--text-light);
    margin-top: 5px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid var(--border);
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-cancel {
    background: var(--border);
    color: var(--text);
}

.btn-cancel:hover {
    background: #bdc3c7;
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-dark);
}

/* Dark Mode Support */
.dark-mode .form-control {
    background: var(--sidebar);
    border-color: var(--border);
}

.dark-mode .form-control:read-only {
    background: rgba(255, 255, 255, 0.05);
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const komentarTextarea = document.getElementById('komentar');
    const charCount = document.getElementById('charCount');
    
    komentarTextarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });
});
</script>
@endsection