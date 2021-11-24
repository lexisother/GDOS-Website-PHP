@extends('layouts.app')

@section('content')
<div class="container">
    <div class="authcards">
        {{-- TODO Component-ify this!!! IMPORTANT!!! --}}
        @foreach ($users as $user)
            <a style="text-decoration: none" href="/user/{{ $user->name }}">
                <div class="authcard">
                    <div class="authcardHeader">
                        {{-- TODO Add a URL to the member image, or perhaps
                        even store the raw image data inside of the DB (no idea
                        how I'll end up displaying this data but as you know I
                        always find a way --}}
                        <img src="/storage/uploads/avatars/{{ $user->avatar }}" height="110px">
                        <p class="name">{{  $user->name }}</p>
                    </div>
                    <div class="authcardContent">
                        <p>
                            Age: {{ $user->age }}
                        </p>
                        <p>
                            Role: {{ $user->role }}
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
