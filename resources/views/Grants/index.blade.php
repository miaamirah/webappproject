@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark"><b>Grants</b></h1>
        @can('isAdmin',App\Models\User::class)
            <a href="{{ route('grants.create') }}" class="btn btn-success">Add Grant</a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered border-dark">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Title</th>
                <th>Project Description</th>
                <th>Grant Amount</th>
                <th>Provider</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Duration</th>
                <th>Project Leader</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grants as $grant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $grant->title }}</td>
                    <td>{{ $grant->project_description }}</td>
                    <td>${{ number_format($grant->grant_amount, 2) }}</td>
                    <td>{{ $grant->grant_provider }}</td>
                    <td>{{ $grant->start_date }}</td>
                    <td>{{ $grant->end_date }}</td>
                    <td>{{ $grant->duration }} months</td>
                    <td>{{ $grant->leader?->name ?? 'No Leader Assigned' }}</td> <!-- Access leader relationship -->
                    <td>
                    <div class="d-inline-flex align-items-center">
                        <a href="{{ route('grants.show', $grant->id) }}" class="btn btn-info btn-sm">View</a> 
                        @can('staffAdmin', App\Models\User::class)
                                    <!-- Edit Button -->
                                    <a href="{{ route('grants.edit', $grant->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                    <!-- Delete Button with confirmation -->
                                    <form action="{{ route('grants.destroy', $grant->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="display: inline-block;">Delete</button>
                                    </form>

                                    <!-- View Milestones Link -->
                                    <!--a href="{{ route('milestones.index', $grant->id) }}" class="btn btn-info btn-sm me-2">ViewMilestones</a-->
                                    @endcan
                    </div>
                        <!--@can('isAdmin')
                        <a href="{{ route('grants.edit', $grant->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('grants.destroy', $grant->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        @endcan-->
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
