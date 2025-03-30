@extends('layout')

@section('title', 'Milestones for ' . $project->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4 fs-3">Milestones for <br> <span class="text-primary">{{ $project->name }}</span></h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between mb-3">
                <h3 class="mb-0">Milestone List</h3>
                <a href="{{ route('milestones.create', $project->id) }}" class="btn btn-primary">+ Create New Milestone</a>
            </div>

            @if (count($milestones) > 0)
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($milestones as $milestone)
                            <tr>
                                <td><strong>{{ $milestone->name }}</strong></td>
                                <td>{{ $milestone->description ?? 'N/A' }}</td>
                                <td>{{ $milestone->due_date ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $milestone->status == 'pending' ? 'bg-warning' : ($milestone->status == 'reached' ? 'bg-success' : 'bg-danger') }}">
                                        {{ ucfirst($milestone->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('milestones.edit', $milestone->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('milestones.destroy', $milestone->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this milestone?');">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted text-center">No milestones found. Create one now!</p>
            @endif

            <div class="text-center mt-3">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
            </div>
        </div>
    </div>
@endsection