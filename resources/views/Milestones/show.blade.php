@extends('layouts.index_template')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark">Milestone Details</h1>

    <div class="card">
        <div class="card-header">
            <b>Milestone title: </b>
            {{ $milestone->milestone_title }}
        </div>
        <div class="card-body">
            <p><strong>Grant:</strong> {{ $milestone->grant->title ?? 'No Grant Assigned' }}</p>
            <p><strong>Completion Date:</strong> {{ $milestone->completion_date }}</p>
            <p><strong>Deliverable:</strong> {{ $milestone->deliverable }}</p>
            <p><strong>Status:</strong> {{ $milestone->status }}</p>
            <p><strong>Remarks:</strong> {{ $milestone->remark ?? 'None' }}</p>
        </div>
    </div>

    <a href="{{ route('milestones.index') }}" class="btn btn-secondary mt-4">Back to List</a>
</div>
@endsection
