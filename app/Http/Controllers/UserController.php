<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

/**
 * Manages everything related to user management.
 */
class UserController extends Controller
{
    /**
     * Find a user with a specific name and return the corresponding view.
     *
     * @param string $name Name of the user profile to visit.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user($name)
    {
        // Find a user in the database with the given name
        $user = \App\Models\User::where('name', $name)->first();
        return view('user', ['user' => $user]);
    }

    /**
     * Shows the currently authenticated user's configuration panel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('profile', ['user' => Auth::user(), 'updated' => false]);
    }

    /**
     * Updates the currently authenticated user's configuration.
     *
     * @param Request $request The request object.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update_user(Request $request)
    {
        // Retrieve the model of the currently authenticated user.
        $user = \App\Models\User::find(Auth::user()->id);

        // Handle the user upload of avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            /**
             * If the avatar exceeds 10MB, throw an exception.
             * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/413
             */
            if ($avatar->getSize() > 10000000) {
                return abort('413');
            }

            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            // We use the \Intervention\Image library to create an image
            // in-memory and save it to the uploads folder.
            Image::make($avatar)->resize(300, 300)->save(storage_path('app/public/uploads/avatars/' . $filename));

            // For some reason, we need an extra invocation of `save` here
            // because Laravel doesn't want to keep our changes
            $user->avatar = $filename;
            $user->save();
        } else {
            // Get every item in the request and set it.
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, '_')) {
                    continue;
                }
                $user->$key = $value;
            }
        }


        // Finally, save the new data to the user model.
        $user->save();

        return view('profile', ['user' => Auth::user(), 'updated' => true]);
    }
}
