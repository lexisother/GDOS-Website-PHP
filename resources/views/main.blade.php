@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        @if (Auth::user()->role == "No role.")
            <div class="alert alert-danger">
                Your profile is incomplete! Please go to your <a href="/profile">profile settings</a> to resolve.
            </div>
        @endif
    @endauth
    <div class="authcards">
        {{-- TODO Component-ify this!!! IMPORTANT!!! --}}
        @foreach ($users as $user)
            @card(['user' => $user])
            @endcard
        @endforeach
    </div>
</div>
@endsection
