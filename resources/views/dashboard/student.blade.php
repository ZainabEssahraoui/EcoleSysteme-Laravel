@extends('layouts.app')
@section('content')
@include('layouts.navbar')
    <h1>Student Dashboard</h1>
    <p>Welcome, Student {{ Auth::user()->name }}!</p>
@endsection
