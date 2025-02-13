@extends('layouts.app')

@section('content')
    <h1>Your Absences</h1>
    <table>
        <thead>
            <tr>
                <th>Module</th>
                <th>Date</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absences as $absence)
                <tr>
                    <td>{{ $absence->module->name }}</td>
                    <td>{{ $absence->date }}</td>
                    <td>{{ $absence->reason }}</td>
                    <td><a href="{{ route('student.absences.show', $absence->id) }}">View Details</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
