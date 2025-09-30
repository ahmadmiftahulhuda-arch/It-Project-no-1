@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Feedback</h1>

    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf
        <div>
            <label>Komentar</label>
            <textarea name="komentar" required></textarea>
        </div>
        <div>
            <label>Tanggal Feedback</label>
            <input type="date" name="tgl_feedback" required>
        </div>
        <div>
            <label>Rating</label>
            <input type="number" name="rating" min="1" max="5" required>
        </div>
        <div>
            <label>Status</label>
            <select name="status" required>
                <option value="Dipublikasikan">Dipublikasikan</option>
                <option value="Draft">Draft</option>
            </select>
        </div>
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
