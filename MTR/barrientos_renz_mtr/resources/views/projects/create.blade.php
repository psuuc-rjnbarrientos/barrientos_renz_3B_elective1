@extends('layout')

@section('title', 'Create Project')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4 fs-3">Create New Project</h1>
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
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Project Name: <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description: <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Start Date: <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">End Date: <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Priority: <span class="text-danger">*</span></label>
                        <select name="priority" class="form-select" required>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="critical">Critical</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success d-block mx-auto px-5">Create Project</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
                </div>
            </div>
        </div>
    </div>
@endsection
