@extends('layouts.index_template')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark"><strong>Academicians</strong></h1>
        @can('isAdmin', App\Models\User::class)   
        <a href="{{ route('academicians.create') }}" class="btn btn-success">Add Academician</a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered border-dark">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Name</th>
                <th class="text-center">Staff Number</th>
                <th class="text-center">Email</th>
                <th class="text-center">College</th>
                <th class="text-center">Department</th>
                <th class="text-center">Position</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($academicians as $academician)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $academician->name }}</td>
                    <td class="text-center">{{ $academician->staff_number }}</td>
                    <td class="text-center">{{ $academician->email }}</td>
                    <td class="text-center">{{ $academician->college }}</td>
                    <td class="text-center">{{ $academician->department }}</td>
                    <td class="text-center">{{ $academician->position }}</td>
                    <td>
                        <a href="{{ route('academicians.show', $academician->id) }}" class="btn btn-info btn-sm">View</a>
                        @can('isAdmin', App\Models\User::class) 
                        <a href="{{ route('academicians.edit', $academician->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('academicians.destroy', $academician->id) }}" method="POST" style="display:inline-block;">
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
