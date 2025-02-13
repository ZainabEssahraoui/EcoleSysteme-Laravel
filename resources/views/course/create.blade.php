@extends('layouts.app')



@section('content')
    <h1>Create a New Course</h1>

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" required>
        
        <label>Description:</label>
        <textarea name="description" required></textarea>

        <label>Module:</label>
        <select name="module_id" required>
            @foreach($modules as $module)
                <option value="{{ $module->id }}">{{ $module->name }}</option>
            @endforeach
        </select>

        <label>Student:</label>
        <select name="student_id" required>
            @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>

        <label>Upload File:</label>
        <input type="file" name="file" required>

        <button type="submit">Create Course</button>
    </form>
@endsection
