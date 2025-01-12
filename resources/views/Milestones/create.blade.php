@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark">Add Milestone</h1>

    <form action="{{ route('milestones.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="milestone_title">Milestone Title</label>
            <input type="text" name="milestone_title" class="form-control" id="milestone_title" placeholder="Enter milestone title" required>
        </div>

        <div class="form-group mb-3">
            <label for="completion_date">Completion Date</label>
            <input type="date" name="completion_date" class="form-control" id="completion_date" required>
        </div>

        <div class="form-group mb-3">
            <label for="deliverable">Deliverable</label>
            <input type="text" name="deliverable" class="form-control" id="deliverable" placeholder="Enter deliverable" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="grant_id">Grant List</label>
            <select class="form-control" name="grant_id" id="grant_id" required>
                <option value="">Select Grant</option>
                @foreach ($grants as $grant)
                    <option value="{{ $grant->id }}">{{ $grant->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="remark">Remarks</label>
            <textarea name="remark" class="form-control" id="remark" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <a href="{{ route('milestones.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
