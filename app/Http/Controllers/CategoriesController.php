<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate();

        return view('welcome', [
            'title' => "Publicaciones de la categoría {$category->name}",
            'posts' => $posts,
        ]);
    }
}
