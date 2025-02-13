@extends('layouts.app')



@section('content')
    <h1>Edit Course</h1>

    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Title:</label>
        <input type="text" name="title" value="{{ $course->title }}" required>
        
        <label>Description:</label>
        <textarea name="description" required>{{ $course->description }}</textarea>

        <label>Module:</label>
        <select name="module_id" required>
            @foreach($modules as $module)
                <option value="{{ $module->id }}" {{ $module->id == $course->module_id ? 'selected' : '' }}>{{ $module->name }}</option>
            @endforeach
        </select>

        <label>Student:</label>
        <select name="student_id" required>
            @foreach($students as $student)
                <option value="{{ $student->id }}" {{ $student->id == $course->student_id ? 'selected' : '' }}>{{ $student->name }}</option>
            @endforeach
        </select>

        <label>Upload File (Leave blank to keep existing file):</label>
        <input type="file" name="file">

        @if($course->file_path)
            <p>Current file: <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank">View File</a></p>
        @endif

        <button type="submit">Update Course</button>
    </form>
@endsection
