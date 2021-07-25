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
            \App\Models\Posts::create($request->all());

            return redirect()->route('posts.index')
                ->with('success', 'Success create a new post: ' . $request->offsetGet('title'));
        } else {
            \App\Models\Posts::find($request->id)->update($request->all());

            return redirect()->route('posts.index')
                ->with('success', 'Success update post: ' . $request->offsetGet('title'));
        }
    }

    public function delete($id)
    {
        $post = \App\Models\Posts::find($id);

        if($post->delete()) {
            return redirect()->route('posts.index')
                ->with('success', 'Success delete post: ' . $post->title);
        }

        return redirect()->route('posts.index')
            ->with('failed', 'Failed delete post: ' . $post->title);
    }
}
