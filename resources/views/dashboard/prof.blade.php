@extends('layouts.app')
@include('layouts.navbar')
@section('content')
    <div class="container">
        <h1>Welcome, {{ $user->name }}</h1>

        <div class="card">
            <div class="card-header">Profile</div>
            <div class="card-body">
            @if($user->image)
                    <img src="{{ asset('storage/'.$user->image) }}" alt="Profile Picture" width="100">
                @else
                    <p>No profile picture uploaded.</p>
                @endif
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                
            </div>
        </div>

    
    </div>
@endsection
