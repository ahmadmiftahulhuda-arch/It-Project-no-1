@extends('admin.layouts.app')

@section('title', 'Edit Feedback')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Feedback</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.feedback.update', $feedback->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="feedback">Pesan Anda</label>
                                <textarea name="feedback" id="feedback" class="form-control @error('feedback') is-invalid @enderror" rows="5" required>{{ old('feedback', $feedback->feedback) }}</textarea>
                                @error('feedback')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
                            <a href="{{ route('user.feedback.index') }}" class="btn btn-secondary mt-3">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
