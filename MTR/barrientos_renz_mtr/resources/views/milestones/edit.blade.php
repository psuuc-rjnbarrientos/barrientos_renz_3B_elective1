@extends('layout')

@section('title', 'Edit Milestone')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4 fs-3">Edit Milestone</h1>

            <div class="card shadow-sm p-4">
                <form action="{{ route('milestones.update', $milestone->id) }}" method="POST">
                    @csrf
                    @method('POST') <!-- Since your route is POST -->
                    <div class="mb-3">
                        <label class="form-label">Milestone Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ $milestone->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <textarea name="description" class="form-control">{{ $milestone->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Due Date:</label>
                        <input type="date" name="due_date" class="form-control" value="{{ $milestone->due_date }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ $milestone->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="reached" {{ $milestone->status == 'reached' ? 'selected' : '' }}>Reached</option>
                            <option value="overdue" {{ $milestone->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Update Milestone</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('milestones.index', $milestone->project_id) }}" class="btn btn-secondary">Back to Milestones</a>
                </div>
            </div>
        </div>
    </div>
@endsection