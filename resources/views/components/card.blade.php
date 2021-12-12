<a style="text-decoration: none" href="/user/{{ $user->name }}">
    <div class="authcard">
        <div class="authcardHeader">
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
