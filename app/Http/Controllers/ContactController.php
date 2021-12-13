<?php

namespace App\Http\Controllers;

use App\Models\ContactItem;
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

    public function submissions()
    {
        $submissions = ContactItem::all();
        return view('contact/submissions', ['submissions' => $submissions]);
    }

    public function submission($id) {
        $contactItem = ContactItem::where('id', $id)->first();
        return view('contact/submission', ['submission' => $contactItem]);
    }

    public function submit(Request $request) {
        $author = Auth::user();

        ContactItem::create([
            'title' => $request->title,
            'description' => $request->description,
            'author_name' => $author->name
        ]);

        return view('contact/contact', ['user' => Auth::user(), 'submitted' => true]);
    }
}
