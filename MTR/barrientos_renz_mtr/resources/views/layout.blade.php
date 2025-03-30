<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-light">

    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="ms-auto">
            <!-- Existing user/logout logic -->
        </div>
    </div> --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('projects.index') }}">Project Manager</a>
            <div class="ms-auto">
                @php
                    $user = session('user')
                        ? \Illuminate\Support\Facades\DB::table('users')->where('id', session('user')->id)->first()
                        : null;
                @endphp

                @if ($user)
                    <span class="text-white me-3">Welcome, {{ $user->name }}</span>
                    <a href="{{ route('logout') }}" class="btn btn-warning btn-sm">Logout</a>
                @else
                    <a href="{{ route('login.show') }}" class="btn btn-light btn-sm">Login</a>
                    <a href="{{ route('register.show') }}" class="btn btn-success btn-sm">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="text-center py-3 mt-5 bg-dark text-white">
        <p>&copy; {{ date('Y') }} Project Manager</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
