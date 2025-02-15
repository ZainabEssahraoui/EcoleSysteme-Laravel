@extends('layouts.app')

@section('content')
    <h1>Add Absence</h1>
    <form action="{{ route('absences.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Student:</label>
            <select name="student_id" class="form-control">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="group_id">Group:</label>
            <select name="group_id" class="form-control">
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="heure_debut_scence">Start Time:</label>
            <input type="time" name="heure_debut_scence" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="heure_fin_scence">End Time:</label>
            <input type="time" name="heure_fin_scence" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="si_present">Presence:</label>
            <input type="checkbox" name="si_present" value="1">
        </div>

        <div class="form-group">
            <label for="reason">Reason (Optional):</label>
            <textarea name="reason" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Absence</button>
    </form>
@endsection
