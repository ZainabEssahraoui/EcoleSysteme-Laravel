@extends('layouts.app')

@section('content')
    <h1>Courses List</h1>
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Title</th>
                <th>Module</th>
                <th>Student</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->module->name }}</td>
                    <td>{{ $course->student->name }}</td>
                    <td>
                        @if($course->file_path)
                            <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank">View File</a>
                        @else
                            No File
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('courses.show', $course->id) }}">View</a>
                        <a href="{{ route('courses.edit', $course->id) }}">Edit</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
