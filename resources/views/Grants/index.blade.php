@extends('layouts.index_template')

@section('content')
<div class="container">
<div style="background: #f3e8f7; min-height: 200vh; padding: 0px;">
    <div class="container" style="background: white; padding: 20px; border-radius: 10px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-center text-dark"><b>List of Grants</b></h1>
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
                <th style="background: rgb(215, 182, 218); color: #000;">No</th>
                <th style="background: rgb(215, 182, 218); color: #000;">Title</th>
                <th style="background: rgb(215, 182, 218); color: #000;">Project Description</th>
                <th style="background: rgb(215, 182, 218); color: #000;">Grant Amount</th>
                <th style="background: rgb(215, 182, 218); color: #000;">Provider</th>
                <th style="background: rgb(215, 182, 218); color: #000;">Start Date</th>
                <th style="background: rgb(215, 182, 218); color: #000;">End Date</th>
                <th style="background: rgb(215, 182, 218); color: #000;">Duration</th>
                <th style="background: rgb(215, 182, 218); color: #000;">Project Leader</th>
                <th style="background: rgb(215, 182, 218); color: #000;">Actions</th>
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

                        <a href="{{ route('grants.show', $grant->id) }}" class="btn btn-info btn-sm" style="margin-right: 5px;">View</a> 
        
                        @can('staffAdmin', App\Models\User::class)

                                    <!-- Edit Button -->
                                    <a href="{{ route('grants.edit', $grant->id) }}" class="btn btn-primary btn-sm" style="margin-right: 5px;">Edit</a>

                                    <!-- Delete Button with confirmation -->
                                    <form action="{{ route('grants.destroy', $grant->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="display: inline-block;">Delete</button>
                                    </form>
            @endcan
                                    <!-- View Milestones Link -->
                                    <!--a href="{{ route('milestones.index', $grant->id) }}" class="btn btn-info btn-sm me-2">ViewMilestones</a-->
                                 
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
