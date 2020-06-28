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

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['url'] = Str::slug($title, '-');
    }
    
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
}
