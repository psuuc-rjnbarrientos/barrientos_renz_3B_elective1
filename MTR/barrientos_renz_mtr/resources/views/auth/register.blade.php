@extends('layout')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50">
                <h1 class="fs-3">Login</h1>
            </div> --}}
            <h1 class="text-center mb-4 fs-3">Register</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm p-4">
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}" required>
                        @error('password')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password:</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            value="{{ old('password') }}" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>

                <p class="text-center mt-3">
                    Already have an account? <a href="{{ route('login.show') }}">Login here</a>
                </p>
            </div>
        </div>
    </div>
@endsection
