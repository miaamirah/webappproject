@extends('layouts.index_template')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark">Edit Grant</h1>

    <form action="{{ route('grants.update', $grant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $grant->title }}" required>
        </div>

        <div class="form-group">
            <label for="project_description">Project Description</label>
            <textarea name="project_description" class="form-control" id="project_description" rows="4" required>{{ $grant->project_description }}</textarea>
        </div>

        <div class="form-group">
            <label for="grant_amount">Grant Amount</label>
            <input type="number" step="0.01" name="grant_amount" class="form-control" id="grant_amount" value="{{ $grant->grant_amount }}" required>
        </div>

        <div class="form-group">
            <label for="grant_provider">Grant Provider</label>
            <input type="text" name="grant_provider" class="form-control" id="grant_provider" value="{{ $grant->grant_provider }}" required>
        </div>

        <div class="form-group">
            <label for="leader_id">Project Leader</label>
            <select name="leader_id" id="leader_id" class="form-control" required>
                <option value="" disabled>Select a project leader</option>
                @foreach ($academicians as $academician)
                    <option value="{{ $academician->id }}" 
                            {{ old('leader_id', $grant->leader_id ?? '') == $academician->id ? 'selected' : '' }}>
                            {{ $academician->name }}
                    </option>
                    <!--option value="{{ $academician->id }}" {{ $grant->leader?->id === $academician->id ? 'selected' : '' }}>
                        {{ $academician->name }}
                    </option-->
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="members">Project Members</label>
            @foreach ($academicians as $academician)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="members[]" id="member{{ $academician->id }}" value="{{ $academician->id }}"
                        {{ $members->contains($academician->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="member{{ $academician->id }}">
                        {{ $academician->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" id="start_date" value="{{ $grant->start_date }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" id="end_date" value="{{ $grant->end_date }}" required>
        </div>

        <div class="form-group">
            <label for="duration">Duration (in months)</label>
            <input type="number" name="duration" class="form-control" id="duration" value="{{ $grant->duration }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('grants.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
