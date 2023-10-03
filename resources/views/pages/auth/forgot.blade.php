@extends('layouts.auth')

@section('title', 'Lupa Password')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Lupa Password</h4>
        </div>
        <div class="card-body">
            <p class="text-muted">Kami akan kirimkan link untuk reset password anda</p>
            @if (session('status'))
                <div class="alert alert-success mt-2">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ url('/forgot-password') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" tabindex="1" autofocus value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Kirim Link
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
