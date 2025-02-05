<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['name'];
    
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = Str::slug($name, '-');
    }

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
