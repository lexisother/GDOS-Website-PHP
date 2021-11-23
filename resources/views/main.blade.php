@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($users as $user)
        <h1>{{ $user->name }}</h1>
    @endforeach
</div>
@endsection
