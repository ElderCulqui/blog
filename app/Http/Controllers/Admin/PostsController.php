<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Category;
use App\Post;
use App\Tag;

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
        $this->validate($request ,['title' => 'required']);

        $post = Post::create([
            'title' => $request->title,
            'url' => Str::slug($request->title)
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    public function update(Request $request, Post $post)
    {
        //return $request->all();

        $validate = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'iframe' => 'nullable',
            'excerpt' => 'required',
            'published_at' => 'date|nullable',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required'
        ]);
        
        $url = Str::slug($request->title);
        
        $post->update(array_merge($validate, ['url' => $url]));
        
        $post->tags()->sync($request->tags);

        return redirect()->route('admin.posts.edit', $post)->with('flash','Tu publicación ha sido creada');
    }
}
