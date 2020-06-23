<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Category;
use App\Post;
use App\Tag;

use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    // public function create()
    // {
    //     $categories = Category::all();
    //     $tags = Tag::all();

    //     return view('admin.posts.create', compact('categories','tags'));
    // }

    public function store(Request $request)
    {   
        $validate = $request->validate(['title' => 'required']);

        $post = Post::create($validate);

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $post->update($request->all());
        
        $post->syncTags($request->tags);

        return redirect()->route('admin.posts.edit', $post)->with('flash','Tu publicación ha sido guardada');
    }
}
