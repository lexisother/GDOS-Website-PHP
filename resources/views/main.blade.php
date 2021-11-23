@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($users as $user)
        <a href="/user/{{ $user->name }}"><h1>{{ $user->name }}</h1></a>
    @endforeach
</div>
@endsection
