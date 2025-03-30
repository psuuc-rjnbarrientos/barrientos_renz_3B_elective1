@extends('layout')

@section('title', 'Projects')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4 fs-3">Projects</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <h3 class="mb-0">Project List</h3>
            <a href="{{ route('projects.create') }}" class="btn btn-primary">+ Create New Project</a>
        </div>

        @if ($paginatedProjects->count() > 0)
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Search projects...">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paginatedProjects as $project)
                            <tr>
                                <td><strong>{{ $project->name }}</strong></td>
                                <td>{{ $project->description ?? 'No description' }}</td>
                                <td>{{ $project->start_date ?? 'N/A' }}</td>
                                <td>{{ $project->end_date ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $priorityColors = [
                                            'low' => 'bg-success',
                                            'medium' => 'bg-primary',
                                            'high' => 'bg-warning',
                                            'critical' => 'bg-danger',
                                        ];
                                        $priority = $project->priority ?? 'medium';
                                    @endphp
                                    <span class="badge {{ $priorityColors[$priority] ?? 'bg-secondary' }}">
                                        {{ ucfirst($priority) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('tasks.index', $project->id) }}" class="btn btn-info btn-sm">Tasks</a>
                                    <a href="{{ route('milestones.index', $project->id) }}"
                                        class="btn btn-secondary btn-sm">Milestones</a>
                                    <a href="{{ route('projects.edit', $project->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this project?');">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <div class="pagination">
                    {{ $paginatedProjects->links() }}
                </div>
            </div>
        @else
            <p class="text-muted text-center">No projects found. Create one now!</p>
        @endif
    </div>
@endsection
