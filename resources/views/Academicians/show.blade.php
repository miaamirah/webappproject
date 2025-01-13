@extends('layouts.index_template')

@section('content')
<div class="container">
    <h1 class="text primary mt-4"><b>Academician Details</b></h1>

    <div class="card">
        <div class="card-header">
            <b>Academician Name :</b> {{ $academician->name }}
        </div>
        <div class="card-body">
            <p><strong>Staff Number:</strong> {{ $academician->staff_number }}</p>
            <p><strong>Email:</strong> {{ $academician->email }}</p>
            <p><strong>College UNITEN:</strong> {{ $academician->college }}</p>
            <p><strong>Department:</strong> {{ $academician->department }}</p>
            <p><strong>Position:</strong> {{ $academician->position }}</p>
        </div>
    </div>

    <a href="{{ route('academicians.index') }}" class="btn btn-primary mt-4">Back to List</a>
</div>
@endsection
