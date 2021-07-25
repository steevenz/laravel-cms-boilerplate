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
        return view('posts.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        if(empty($request->id)) {
            $response = \App\Models\Posts::create($request->all());
        } else {
            $response = \App\Models\Posts::find($request->id)->update($request->all());
        }
        if($response) {
            return back()->with('success', 'Success create a new post: ' . $request->offsetGet('title'));
        }

        return back()->with('failed', 'Failed create a new post');
    }

    public function delete($id)
    {
        $post = \App\Models\Posts::find($id);

        if($post->delete()) {
            return back()->with('success', 'Success delete post: ' . $post->title);
        }

        return back()->with('failed', 'Failed delete post: ' . $post->title);
    }
}
