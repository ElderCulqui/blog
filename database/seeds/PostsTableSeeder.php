<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Category::truncate();

        $category = new Category;
        $category->name = 'Categoria 1';
        $category->save();

        $category = new Category;
        $category->name = 'Categoria 2';
        $category->save();

        $post = new Post;
        $post->category_id = 1;
        $post->title = 'Mi primer post';
        $post->excerpt = 'Extracto de mi primer post';
        $post->body = '<p>Contenido de mi primer post</p>';
        $post->published_at = Carbon::now();
        $post->save();

        $post = new Post;
        $post->category_id = 2;
        $post->title = 'Mi segundo post';
        $post->excerpt = 'Extracto de mi segundo post';
        $post->body = '<p>Contenido de mi segundo post</p>';
        $post->published_at = Carbon::now();
        $post->save();
        
        $post = new Post;
        $post->category_id = 1;
        $post->title = 'Mi tercer post';
        $post->excerpt = 'Extracto de mi tercer post';
        $post->body = '<p>Contenido de mi tercer post</p>';
        $post->published_at = Carbon::now();
        $post->save();

        $post = new Post;
        $post->category_id = 1;
        $post->title = 'Mi cuarto post';
        $post->excerpt = 'Extracto de mi cuarto post';
        $post->body = '<p>Contenido de mi cuarto post</p>';
        $post->published_at = Carbon::now();
        $post->save();
    }
}
