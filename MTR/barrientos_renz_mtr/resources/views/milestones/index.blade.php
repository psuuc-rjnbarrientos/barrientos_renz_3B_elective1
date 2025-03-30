@extends('layout')

@section('title', 'Milestones for ' . $project->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4 fs-3">Milestones for <br> <span class="text-primary">{{ $project->name }}</span></h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($paginatedMilestones->count() > 0)
                <div class="d-flex justify-content-between align-items-center mt-3 mb-3 gap-3">
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary py-2">Back to Projects</a>
                    <input type="text" class="form-control w-50" placeholder="Search milestones...">
                    <a href="{{ route('milestones.create', $project->id) }}" class="btn btn-primary py-2">+ Create New
                        Milestone</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
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
                            @foreach ($paginatedMilestones as $milestone)
                                <tr>
                                    <td><strong>{{ $milestone->name }}</strong></td>
                                    <td>{{ $milestone->description ?? 'N/A' }}</td>
                                    <td>{{ $milestone->due_date ?? 'N/A' }}</td>
                                    <td>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar {{ $milestone->status == 'reached' ? 'bg-success' : 'bg-warning' }}"
                                                style="width: {{ $milestone->status == 'reached' ? '100' : '50' }}%;"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('milestones.edit', $milestone->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('milestones.destroy', $milestone->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this milestone?');">
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
                        {{ $paginatedMilestones->links() }}
                    </div>
                </div>
            @else
                <p class="text-muted text-center">No milestones found. Create one now!</p>
            @endif


        </div>
    </div>
@endsection
