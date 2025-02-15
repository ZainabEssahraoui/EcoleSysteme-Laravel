@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Grades</h1>

    @if ($grades->isEmpty())
        <p>No grades found.</p>
        @if (auth()->user()->role === 'prof')
        <a href="{{ route('grades.create') }}" class="btn btn-primary">Add New Grade</a>
        @endif
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Module</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    <tr>
                        <td>{{ $grade->student->name }}</td>
                        <td>{{ $grade->module->name }}</td>
                        <td>{{ $grade->grade }}</td>
                        <td>
                            @if (auth()->user()->role === 'prof')
                                <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endif
                            <a href="{{ route('grades.show', $grade->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        @if (auth()->user()->role === 'prof')
        <a href="{{ route('grades.create') }}" class="btn btn-primary">Add New Grade</a>
        @endif
        
    @endif
</div>
@endsection
