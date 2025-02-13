@extends('layouts.app')

@section('content')
    <h1>Absence Details</h1>
    <p>Module: {{ $absence->module->name }}</p>
    <p>Date: {{ $absence->date }}</p>
    <p>Reason: {{ $absence->reason }}</p>
@endsection
