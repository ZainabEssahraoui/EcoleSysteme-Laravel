@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Grade Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Student: {{ $grade->student->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Module: {{ $grade->module->name }}</h6>
            <p class="card-text">Grade: <strong>{{ $grade->grade }}</strong></p>
        </div>
    </div>

    <a href="{{ route('grades.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
