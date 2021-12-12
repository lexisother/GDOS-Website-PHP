@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            @if ($updated)
                <div class="alert alert-info">
                    Updated! Go back to the home page to see the changes.
                </div>
            @endif

            <div class="d-flex flex-column">
                <div class="mb-3">
                    <img class="userAvatar" src="/storage/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px;">
                    <h2>{{ $user->name }}'s Profile</h2>
                </div>

                <div>
                    <form class="d-inline-flex flex-column gap-1" enctype="multipart/form-data" action="/profile" method="POST">
                        @csrf
                        <div class="d-flex flex-column">
                            <label class="h4">Update Profile Image</label>
                            <input type="file" name="avatar">
                        </div>

                        <div class="d-flex flex-column">
                            <label class="h4">Select your role</label>
                            <select name="role">
                                <option selected hidden>{{ $user->role }}</option>
                                <option value="Software Developer">Software Developer</option>
                                <option value="Systems and Devices">Systems and Devices</option>
                            </select>
                        </div>

                        <input type="submit" class="pull-right btn btn-sm btn-primary"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
