@extends('layouts.student')

@section('title', 'Student List')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-white rounded-top">
            <h3 class="mb-0">Student List</h3>
        </div>
        <div class="card-body">
            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('students.index') }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search by Name or Email</label>
                        <input type="text" name="search" id="search" class="form-control"
                            value="{{ request('search') }}" placeholder="Enter keyword...">
                    </div>
                    <div class="col-md-3">
                        <label for="degree" class="form-label">Degree Program</label>
                        <input type="text" name="degree" id="degree" class="form-control"
                            value="{{ request('degree') }}" placeholder="e.g., BSIT, BSMATH">
                    </div>
                    <div class="col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">All</option>
                            <option value="graduate" {{ request('status') == 'graduate' ? 'selected' : '' }}>Graduate
                            </option>
                            <option value="undergraduate" {{ request('status') == 'undergraduate' ? 'selected' : '' }}>
                                Undergraduate</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="min_date_of_birth" class="form-label">Born On/After</label>
                        <input type="date" name="min_date_of_birth" id="min_date_of_birth" class="form-control"
                            value="{{ request('min_date_of_birth') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Search</button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Student Count -->
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
                <span class="text-muted">Found {{ $students->total() }}
                    {{ Str::plural('Student', $students->total()) }}</span>
            </div>

            <!-- Student Table -->
            @if ($students->isEmpty())
                <div class="alert alert-info">No students found. <a href="{{ route('students.create') }}">Add one now!</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Degree Program</th>
                                <th>Status</th>
                                <th>QR Code</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->student_id }}</td>
                                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                    <td>{{ $student->email ?? 'N/A' }}</td>
                                    <td>{{ $student->degree }}</td>
                                    <td>{{ ucfirst($student->status) }}</td>
                                    <td>{!! $student->qr !!}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('students.show', $student) }}"
                                                class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('students.edit', $student) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('students.destroy', $student) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete {{ $student->first_name }} {{ $student->last_name }}?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $students->links() }}
            @endif
        </div>
    </div>
@endsection
