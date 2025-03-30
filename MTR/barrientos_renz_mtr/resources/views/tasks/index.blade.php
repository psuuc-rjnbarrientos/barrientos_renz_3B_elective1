@extends('layout')

@section('title', 'Tasks for ' . $project->name)

@section('content')
    <div class="container">
        <h1 class="text-center mb-4 fs-3">Tasks for {{ $project->name }}</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <h3 class="mb-0">Task List</h3>
            <a href="{{ route('tasks.create', $project->id) }}" class="btn btn-primary">+ Create New Task</a>
        </div>

        @if (count($tasks) > 0)
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
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description ?? 'No description' }}</td>
                            <td>{{ $task->due_date ?? 'N/A' }}</td>
                            <td>{{ $task->status }}</td>
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
        @else
            <p class="text-muted text-center">No tasks found. Create one now!</p>
        @endif

        <div class="text-center mt-3">
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
        </div>
    </div>
@endsection
