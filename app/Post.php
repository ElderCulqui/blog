<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = [
        'title',
        'url',
        'body',
        'iframe',
        'excerpt',
        'published_at',
        'category_id',
    ];

    protected $dates = ['published_at'];

    // public function setTitleAttribute($title)
    // {
    //     $this->attributes['title'] = $title;

    //     $url = Str::slug($title);
    //     $duplicateUrlCount = Post::where('url', 'like', "{$url}%")->count();

    //     if ($duplicateUrlCount) {
    //         $url .= "-" . ++$duplicateUrlCount;
    //     }

    //     $this->attributes['url'] = $url;
    // }
    
    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category) ? $category : Category::create(['name' => $category])->id;
    }

    public function getRouteKeyName()
    {
        return 'url';
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function scopePublished($query)
    {
        $query->whereNotNull('published_at')
              ->where('published_at','<=',Carbon::now())
              ->latest('published_at')
        ;
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function ($tag) {
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });

        return $this->tags()->sync($tagIds);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting( function($post){
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }

    protected static function booted()
    {
        static::created(function ($post) {
            $url = Str::slug($post['title']);

            if (Post::whereUrl($url)->exists()) {
                $url =  "{$url}-{$post->id}";
            }

            $post->update(['url' => $url]);

            return $post;
        });
    }
}
