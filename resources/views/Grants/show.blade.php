@extends('layouts.index_template')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark">Grant Details</h1>

    <div class="card">
        <div class="card-header">
            <h3>Project title: {{ $grant->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Project Description:</strong> {{ $grant->project_description }}</p>
            <p><strong>Grant Amount:</strong> ${{ number_format($grant->grant_amount, 2) }}</p>
            <p><strong>Provider:</strong> {{ $grant->grant_provider }}</p>
            <p><strong>Start Date:</strong> {{ $grant->start_date }}</p>
            <p><strong>End Date:</strong> {{ $grant->end_date }}</p>
            <p><strong>Duration:</strong> {{ $grant->duration }} months</p>
            <p><strong>Project Leader:</strong> {{ $grant->leader?->name ?? 'No Leader Assigned' }}</p>

            <h5 class="mt-4">Project Members</h5>
            @if ($members->isNotEmpty())
                <ul>
                    @foreach ($members as $member)
                        <li>{{ $member->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>No members assigned.</p>
            @endif

            <h5 class="mt-4">Milestones</h5>
            @if ($milestones->isNotEmpty())
                <table class="table table-bordered mt-3">
                <thead>                         
                    <tr>
                            <th style="background: rgb(198, 198, 198); color: #000;">No</th>
                            <th style="background: rgb(198, 198, 198); color: #000;">Milestone Name</th>
                            <th style="background: rgb(198, 198, 198); color: #000;">Target Completion Date</th>
                            <th style="background: rgb(198, 198, 198); color: #000;">Deliverable</th>
                            <th style="background: rgb(198, 198, 198); color: #000;">Status</th>
                            <th style="background: rgb(198, 198, 198); color: #000;">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($milestones as $index => $milestone)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $milestone->milestone_title }}</td>
                                <td>{{ $milestone->completion_date }}</td>
                                <td>{{ $milestone->deliverable }}</td>
                                <td>{{ $milestone->status }}</td>
                                <td>{{ $milestone->remark }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No milestones added yet.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('grants.index') }}" class="btn btn-secondary mt-4">Back to List</a>
</div>
@endsection
