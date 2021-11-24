<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function profile() {
        return view('profile', array('user' => Auth::user()));
    }

    public function update_avatar(Request $request) {
        // Handle the user upload of avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300, 300)->save( storage_path('app/public/uploads/avatars/' . $filename ) );

            $user = \App\Models\User::find(Auth::user()->id);
            $user->avatar = $filename;
            $user->save();
        }

        return view('profile', array('user' => Auth::user()) );
    }
}
