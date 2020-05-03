<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories','tags'));
    }

    public function store(Request $request)
    {
        //return $request->all();

        $validate = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'excerpt' => 'required',
            'published_at' => 'date|nullable',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required'
        ]);

        $post = Post::create($validate);
        $post->tags()->attach($request->tags);

        return redirect()->route('admin.posts.index')->with('flash','Tu publicación ha sido creada');
    }
}
