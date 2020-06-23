<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->paginate();

        return view('welcome', [
            'title' => "Publicaciones de la etiqueta {$tag->name}", 
            'posts' => $posts
        ]);
    }
}
