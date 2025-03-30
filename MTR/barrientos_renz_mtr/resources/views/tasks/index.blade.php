@extends('layout')

@section('title', 'Tasks for ' . $project->name)

@section('content')
    <div class="container">
        <h1 class="text-center mb-4 fs-3">Tasks for {{ $project->name }}</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($paginatedTasks->count() > 0)
            <div class="d-flex justify-content-between align-items-center mt-3 mb-3 gap-3">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary py-2">Back to Projects</a>
                <input type="text" class="form-control w-50" placeholder="Search tasks...">
                <a href="{{ route('tasks.create', $project->id) }}" class="btn btn-primary py-2">+ Create New
                    Tasks</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paginatedTasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description ?? 'No description' }}</td>
                                <td>{{ $task->due_date ?? 'N/A' }}</td>
                                <td>
                                    <span
                                        class="badge {{ $task->status == 'pending' ? 'bg-warning' : ($task->status == 'completed' ? 'bg-success' : 'bg-info') }}">
                                        {{ ucfirst(str_replace('-', ' ', $task->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this task?');">
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
                    {{ $paginatedTasks->links() }}
                </div>
            </div>
        @else
            <p class="text-muted text-center">No tasks found. Create one now!</p>
        @endif
    </div>
@endsection
