@extends('layout')

@section('title', 'Create Milestone for ' . $project->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4 fs-3">Create Milestone for <br> <span class="text-primary">{{ $project->name }}</span>
            </h1>
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
                <form action="{{ route('milestones.store', $project->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Milestone Name: <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description: <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Due Date: <span class="text-danger">*</span></label>
                        <input type="date" name="due_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status: <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="reached">Reached</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success d-block mx-auto">Create Milestone</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('milestones.index', $project->id) }}" class="btn btn-secondary">Back to Milestones</a>
                </div>
            </div>
        </div>
    </div>
@endsection
