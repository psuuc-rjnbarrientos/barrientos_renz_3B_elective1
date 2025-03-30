@extends('layout')

@section('title', 'Create Task for ' . $project->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4 fs-3">Create Task for <br> <span class="text-primary">{{ $project->name }}</span></h1>

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
                <form action="{{ route('tasks.store', $project->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Task Title:</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Due Date:</label>
                        <input type="date" name="due_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select name="status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="blocked">Blocked</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success d-block mx-auto">Create Task</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('tasks.index', $project->id) }}" class="btn btn-secondary">Back to Tasks</a>
                </div>
            </div>
        </div>
    </div>
@endsection
