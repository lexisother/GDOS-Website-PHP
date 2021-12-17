<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function user($name) {
        // Find a user in the database with the given name
        $user = \App\Models\User::where('name', $name)->first();
        return view('user', ['user' => $user]);
    }

    public function profile() {
        return view('profile', ['user' => Auth::user(), 'updated' => false]);
    }

    public function update_user(Request $request) {
        // Retrieve the model of the currently authenticated user.
        $user = \App\Models\User::find(Auth::user()->id);

        // Handle the user upload of avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            if ($avatar->getSize() > 10000000) {
                return abort('413');
            }

            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300, 300)->save(storage_path('app/public/uploads/avatars/' . $filename ));

            $user->avatar = $filename;
        }

        // Get every item in the request and set it.
        foreach($request->all() as $key => $value) {
            if (str_starts_with($key, '_')) {
                continue;
            }
            $user->$key = $value;
        }

        // Finally, save the new data to the user model.
        $user->save();

        return view('profile', ['user' => Auth::user(), 'updated' => true]);
    }
}
