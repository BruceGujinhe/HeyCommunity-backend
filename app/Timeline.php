<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeline extends Model
{
    use SoftDeletes;

    /**
     * Related User
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Related TimelineLike
     */
    public function author_like()
    {
        return $this->hasMany('App\TimelineLike')->orderBy('created_at', 'desc')->with('author');
    }

    /**
     * Related Comments
     */
    public function comments()
    {
        return $this->hasMany('App\TimelineComment', 'timeline_id')->orderBy('created_at', 'desc')->with('author', 'parent');
    }

    /**
     * Related Notice
     */
    public function notices()
    {
        return $this->morphMany('App\Notice', 'noticeable');
    }
}
