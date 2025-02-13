@extends('layouts.app')

@section('content')
    <h1>Grade Details</h1>
    <p>Module: {{ $grade->module->name }}</p>
    <p>Grade: {{ $grade->grade }}</p>
@endsection
