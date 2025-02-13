@extends('layouts.app')



@section('content')
    <h2>Edit Absence</h2>

    <form action="{{ route('absences.update', $absence->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $absence->student_id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="group_id" class="form-label">Group</label>
            <select name="group_id" class="form-control">
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $group->id == $absence->group_id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="heure_debut_scence" class="form-label">Start Time</label>
            <input type="time" name="heure_debut_scence" value="{{ $absence->heure_debut_scence }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="heure_fin_scence" class="form-label">End Time</label>
            <input type="time" name="heure_fin_scence" value="{{ $absence->heure_fin_scence }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Is Present?</label>
            <select name="si_present" class="form-control">
                <option value="1" {{ $absence->si_present ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$absence->si_present ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update Absence</button>
    </form>
@endsection
