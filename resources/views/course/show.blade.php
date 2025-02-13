@extends('layouts.app')



@section('content')
    <h1>{{ $course->title }}</h1>
    <p><strong>Description:</strong> {{ $course->description }}</p>
    <p><strong>Module:</strong> {{ $course->module->name }}</p>
    <p><strong>Student:</strong> {{ $course->student->name }}</p>

    @if($course->file_path)
        <p><strong>File:</strong> <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank">View File</a></p>
    @else
        <p>No file uploaded.</p>
    @endif

    <a href="{{ route('courses.edit', $course->id) }}">Edit Course</a>
    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
    <a href="{{ route('courses.index') }}">Back to List</a>
@endsection
