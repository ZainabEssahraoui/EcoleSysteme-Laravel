@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Absence</h1>
    
    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('absences.update', $absence->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Student Selection -->
        <div class="form-group">
            <label for="student_id">Student:</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">Select Student</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" 
                        {{ $student->id == $absence->student_id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Group Selection -->
        <div class="form-group">
            <label for="group_id">Group:</label>
            <select name="group_id" id="group_id" class="form-control" required>
                <option value="">Select Group</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" 
                        {{ $group->id == $absence->group_id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Heure Debut Scence -->
        <div class="form-group">
            <label for="heure_debut_scence">Heure Début Scence:</label>
            <input type="time" name="heure_debut_scence" id="heure_debut_scence" 
                class="form-control" value="{{ old('heure_debut_scence', $absence->heure_debut_scence) }}" required>
        </div>

        <!-- Heure Fin Scence -->
        <div class="form-group">
            <label for="heure_fin_scence">Heure Fin Scence:</label>
            <input type="time" name="heure_fin_scence" id="heure_fin_scence" 
                class="form-control" value="{{ old('heure_fin_scence', $absence->heure_fin_scence) }}" required>
        </div>

        <!-- Si Present -->
        <div class="form-group">
            <label for="si_present">Present:</label>
            <select name="si_present" id="si_present" class="form-control">
                <option value="1" {{ $absence->si_present ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$absence->si_present ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Reason -->
        <div class="form-group">
            <label for="reason">Reason:</label>
            <textarea name="reason" id="reason" class="form-control">{{ old('reason', $absence->reason) }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Absence</button>
    </form>
</div>
@endsection
