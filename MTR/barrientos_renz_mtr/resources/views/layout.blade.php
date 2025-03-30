<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            padding-bottom: 60px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('projects.index') }}">Project Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @if (session('user'))
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('tasks.index') }}">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('milestons.index') }}">Projects</a>
                        </li> --}}
                    </ul>
                @endif
                <div class="ms-auto d-flex align-items-center">
                    @php
                        $user = session('user')
                            ? \Illuminate\Support\Facades\DB::table('users')->where('id', session('user')->id)->first()
                            : null;
                    @endphp
                    @if ($user)
                        <div class="dropdown">
                            <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $user->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login.show') }}" class="btn btn-light btn-sm me-2">Login</a>
                        <a href="{{ route('register.show') }}" class="btn btn-success btn-sm">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5 pt-5">
        @yield('content')
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>© {{ date('Y') }} Project Manager | <a href="#" class="text-white">About</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
