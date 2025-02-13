@extends('layouts.app')

@section('content')
    <h1>Your Grades</h1>
    <table>
        <thead>
            <tr>
                <th>Module</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $grade->module->name }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td><a href="{{ route('student.grades.show', $grade->id) }}">View Details</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
