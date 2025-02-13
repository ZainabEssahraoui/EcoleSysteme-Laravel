@extends('layouts.app')
@section('content')
@include('layouts.navbar')
    <h1>Professor Dashboard</h1>
    <p>Welcome, Professor {{ Auth::user()->name }}!</p>
@endsection
