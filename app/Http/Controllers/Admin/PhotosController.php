<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Post;
use App\Photo;

class PhotosController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validate = $request->validate([
            'photo' => 'required|image|max:2048'
        ]);

        $post->photos()->create([
            'url' => $request->file('photo')->store('posts', 'public')
        ]);
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        
        return redirect()->back()->with('flash','Foto eliminada');
    }
}
