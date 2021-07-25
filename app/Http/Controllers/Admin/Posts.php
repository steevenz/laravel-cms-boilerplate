<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class Posts extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function form()
    {
        return view('admin.posts.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        if($post = \App\Models\Posts::create($request->all())) {
            return back()->with('success', 'Success create a new post: ' . $request->offsetGet('title'));
        }

        return back()->with('failed', 'Failed create a new post');
    }
}
