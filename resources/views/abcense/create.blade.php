@extends('layouts.app')



@section('content')
    <h2>Record a New Absence</h2>

    <form action="{{ route('absences.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="group_id" class="form-label">Group</label>
            <select name="group_id" id="group_id" class="form-control">
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="prof_id" value="{{ $prof_id }}">

        <div class="mb-3">
            <label for="heure_debut_scence" class="form-label">Start Time</label>
            <input type="time" name="heure_debut_scence" id="heure_debut_scence" class="form-control">
        </div>

        <div class="mb-3">
            <label for="heure_fin_scence" class="form-label">End Time</label>
            <input type="time" name="heure_fin_scence" id="heure_fin_scence" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Is Present?</label>
            <select name="si_present" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason (if absent)</label>
            <textarea name="reason" id="reason" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Absence</button>
    </form>
@endsection
