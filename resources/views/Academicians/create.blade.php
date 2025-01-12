@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="w-bold text-dark"><strong>Add Academician</strong></h1>

    <form action="{{ route('academicians.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="staff_number">Staff Number</label>
            <input type="text" name="staff_number" class="form-control" id="staff_number" placeholder="Enter staff number" value="{{ old('staff_number') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="college">College</label>
            <input type="text" name="college" class="form-control" id="college" placeholder="Enter college" value="{{ old('college') }}" required>
        </div>

        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" name="department" class="form-control" id="department" placeholder="Enter department" value="{{ old('department') }}" required>
        </div>

        <div class="form-group">
            <label for="position">Position</label>
            <select name="position" id="position" class="form-control">
                <option value="Professor">Professor</option>
                <option value="Assoc. Prof.">Assoc. Prof.</option>
                <option value="Senior Lecturer">Senior Lecturer</option>
                <option value="Lecturer">Lecturer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <a href="{{ route('academicians.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
