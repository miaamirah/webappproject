@extends('layouts.index_template')

@section('content')
<div class="container">
<div style="background: #f3e8f7; min-height: 200vh; padding: 0px;">
<div class="container" style="background: white; padding: 20px; border-radius: 10px;">
    <h1 class="fw-bold text-dark">List of Milestones</h1>
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
                <th  style="background: rgb(215, 182, 218); color: #000;">No</th>
                <th  style="background: rgb(215, 182, 218); color: #000;">Milestone Title</th>
                <th  style="background: rgb(215, 182, 218); color: #000;">Completion Date</th>
                <th  style="background: rgb(215, 182, 218); color: #000;">Deliverable</th>
                <th  style="background: rgb(215, 182, 218); color: #000;">Status</th>
                <th  style="background: rgb(215, 182, 218); color: #000;">Grant Title</th>
                <th  style="background: rgb(215, 182, 218); color: #000;">Remarks</th>
                <th  style="background: rgb(215, 182, 218); color: #000;">Date Updated</th>
                <th  style="background: rgb(215, 182, 218); color: #000;">Actions</th>
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
