@extends('layouts.index_template')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark">Milestones</h1>
    @can('isLeader', $grant)
        <div class="d-flex justify-content-end">
            <a href="{{ route('milestones.create') }}" class="btn btn-success mb-4">Add Milestone</a>
        </div>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered border-dark">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Milestone Title</th>
                <th>Completion Date</th>
                <th>Deliverable</th>
                <th>Status</th>
                <th>Grant Title</th>
                <th>Remarks</th>
                <th>Date Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($milestones as $milestone)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $milestone->milestone_title }}</td>
                    <td class="text-center">{{ $milestone->completion_date }}</td>
                    <td class="text-center">{{ $milestone->deliverable }}</td>
                    <td class="text-center">{{ $milestone->status }}</td>
                    <td class="text-center">{{ $milestone->grant->title ?? 'No Grant' }}</td>
                    <td class="text-center">{{ $milestone->remark }}</td>
                    <td class="text-center">{{$milestone->updated_at->format('d M Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('milestones.show', $milestone->id) }}" class="btn btn-info btn-sm">View</a>
                        @can('isLeader', $grant)
                       <a href="{{ route('milestones.edit', $milestone->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('milestones.destroy', $milestone->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
