@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50">
                <h1 class="fs-3">Login</h1>
            </div> --}}
            <h1 class="text-center mb-4 fs-3">Login</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card shadow-sm p-4">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <p class="text-center mt-3">
                    Don't have an account? <a href="{{ route('register.show') }}" class="btn-link">Register here</a>
                </p>
            </div>
        </div>
    </div>
@endsection
