@extends('layouts.app')

@section('content')
    <div class="container">
        @if($user)
            <h1>{{ $user->name }}</h1>
        @else
            <h1>User not found</h1>
        @endif
    </div>
@endsection
