<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'content',
    ];

    // Relation with categories

    // posts - categories
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    // posts - tags
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag');
    }
}
