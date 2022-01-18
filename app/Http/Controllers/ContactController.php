<?php

namespace App\Http\Controllers;

use App\Models\ContactItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the contact form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('contact/contact', ['user' => Auth::user(), 'submitted' => false]);
    }

    /**
     * Show a table of all contact form items.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function submissions()
    {
        $submissions = ContactItem::all();
        return view('contact/submissions', ['submissions' => $submissions]);
    }

    /**
     * Show a specific contact form item.
     *
     * @param int $id The ID of the contact form item to show.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function submission($id)
    {
        $contactItem = ContactItem::where('id', $id)->first();
        $author = User::where('name', $contactItem->author_name)->first();
        return view('contact/submission', ['submission' => $contactItem, 'author' => $author]);
    }

    /**
     * Submit a contact form item.
     *
     * @param Request $request The request object.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function submit(Request $request)
    {
        $author = Auth::user();

        ContactItem::create([
            'title' => $request->title,
            'description' => $request->description,
            'author_name' => $author->name
        ]);

        return view('contact/contact', ['user' => Auth::user(), 'submitted' => true]);
    }
}
