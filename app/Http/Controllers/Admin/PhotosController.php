<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Photo;

class PhotosController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validate = $request->validate([
            'photo' => 'required|image|max:2048'
        ]);

        $photo = $request->file('photo')->store('public');

        Photo::create([
            'post_id' => $post->id,
            'url' => Storage::url($photo)
        ]);
    }
}
