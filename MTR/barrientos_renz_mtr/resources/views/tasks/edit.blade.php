@extends('layout')

@section('title', 'Edit Task')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4 fs-3">Edit Task</h1>

            <div class="card shadow-sm p-4">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Laravel requires this for PUT/PATCH requests --}}

                    <div class="mb-3">
                        <label class="form-label">Task Title:</label>
                        <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <textarea name="description" class="form-control">{{ $task->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Due Date:</label>
                        <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="blocked" {{ $task->status == 'blocked' ? 'selected' : '' }}>Blocked</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Update Task</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('tasks.index', $task->project_id) }}" class="btn btn-secondary">Back to Tasks</a>
                </div>
            </div>
        </div>
    </div>
@endsection
