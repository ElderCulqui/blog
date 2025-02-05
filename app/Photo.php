<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model   
{
    protected $fillable = ['post_id', 'url'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($photo) {
            Storage::disk('public')->delete($photo->url);
        });
    }
}
