@extends('layout')

@section('title', 'Edit Project')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4 fs-3">Edit Project</h1>

            <div class="card shadow-sm p-4">
                <form action="{{ route('projects.update', $project->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Laravel requires PUT for updating --}}

                    {{-- Project Name --}}
                    <div class="mb-3">
                        <label class="form-label">Project Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <textarea name="description" class="form-control">{{ $project->description ?? '' }}</textarea>
                    </div>

                    {{-- Start Date --}}
                    <div class="mb-3">
                        <label class="form-label">Start Date:</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $project->start_date }}">
                    </div>

                    {{-- End Date --}}
                    <div class="mb-3">
                        <label class="form-label">End Date:</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $project->end_date }}">
                    </div>

                    {{-- Priority --}}
                    <div class="mb-3">
                        <label class="form-label">Priority:</label>
                        <select name="priority" class="form-select" required>
                            @php
                                $priority = $project->priority ?? 'medium';
                            @endphp
                            <option value="low" {{ $priority == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ $priority == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ $priority == 'high' ? 'selected' : '' }}>High</option>
                            <option value="critical" {{ $priority == 'critical' ? 'selected' : '' }}>Critical</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Update Project</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
                </div>
            </div>
        </div>
    </div>
@endsection
