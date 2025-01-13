@extends('layouts.index_template')

@section('content')
<div class="container">
    <h1 class="text-primary mb-4">Edit Academician</h1>

    <form action="{{ route('academicians.update', $academician->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $academician->name }}" required>
        </div>

        <div class="form-group">
            <label for="staff_number">Staff Number</label>
            <input type="text" name="staff_number" class="form-control" id="staff_number" value="{{ $academician->staff_number }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $academician->email }}" required>
        </div>

        <div class="form-group">
            <label for="college">College</label>
            <input type="text" name="college" class="form-control" id="college" value="{{ $academician->college }}" required>
        </div>

        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" name="department" class="form-control" id="department" value="{{ $academician->department }}" required>
        </div>

        <div class="form-group">
            <label for="position">Position</label>
            <select name="position" id="position" class="form-control">
                <option value="Professor" {{ $academician->position == 'Professor' ? 'selected' : '' }}>Professor</option>
                <option value="Assoc. Prof." {{ $academician->position == 'Assoc. Prof.' ? 'selected' : '' }}>Assoc. Prof.</option>
                <option value="Senior Lecturer" {{ $academician->position == 'Senior Lecturer' ? 'selected' : '' }}>Senior Lecturer</option>
                <option value="Lecturer" {{ $academician->position == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('academicians.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
