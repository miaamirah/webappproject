@extends('layouts.index_template')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark">Edit Milestone</h1>

    <form action="{{ route('milestones.update', $milestone->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="milestone_title">Milestone Title</label>
            <input type="text" name="milestone_title" class="form-control" id="milestone_title" value="{{ $milestone->milestone_title }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="completion_date">Completion Date</label>
            <input type="date" name="completion_date" class="form-control" id="completion_date" value="{{ $milestone->completion_date }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="deliverable">Deliverable</label>
            <input type="text" name="deliverable" class="form-control" id="deliverable" value="{{ $milestone->deliverable }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Pending" {{ $milestone->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ $milestone->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="grant_id">Grant List</label>
            <select class="form-control" name="grant_id" id="grant_id" required>
                <option value="">Select Grant</option>
                @foreach ($grants as $grant)
                    <option value="{{ $grant->id }}" {{ $milestone->grant_id == $grant->id ? 'selected' : '' }}>{{ $grant->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="remark">Remarks</label>
            <textarea name="remark" class="form-control" id="remark" rows="3">{{ $milestone->remark }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('milestones.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
