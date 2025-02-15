@extends('layouts.app')

@section('content')
    <h1>Courses List</h1>
    
    @if ($courses->isEmpty())
        <p>No courses found.</p>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New courses</a>

    @else
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
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->module->name ?? 'No Module' }}</td>
                        <td>{{ $course->student->name ?? 'No Student' }}</td>
                        <td>
                            @if ($course->file_path)
                                <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank">View File</a>
                            @else
                                No File
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('courses.show', $course->id) }}">View</a> |
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
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New courses</a>

    @endif
@endsection
