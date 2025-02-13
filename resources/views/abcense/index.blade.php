@extends('layouts.app')



@section('content')
    <h2>Absences List</h2>
    <a href="{{ route('absences.create') }}" class="btn btn-primary mb-3">Record New Absence</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Group</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Present</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absences as $absence)
                <tr>
                    <td>{{ $absence->student->name }}</td>
                    <td>{{ $absence->group->name }}</td>
                    <td>{{ $absence->heure_debut_scence }}</td>
                    <td>{{ $absence->heure_fin_scence }}</td>
                    <td>{{ $absence->si_present ? 'Yes' : 'No' }}</td>
                    <td>{{ $absence->reason ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('absences.show', $absence->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('absences.edit', $absence->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('absences.destroy', $absence->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
