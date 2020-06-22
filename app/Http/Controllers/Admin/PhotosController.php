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

        $photo = $request->file('photo')->store('public');

        Photo::create([
            'post_id' => $post->id,
            'url' => Storage::url($photo)
        ]);
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        
        $photoUrl = Str::of($photo->url)->replace('storage', 'public');
        Storage::delete($photoUrl);
        
        return redirect()->back()->with('flash','Foto eliminada');
    }
}
