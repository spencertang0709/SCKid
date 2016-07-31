<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message', 'comments', 'likes', 'post_time', 'story', 'location', 'latitude', 'longitude'
    ];
    
    //Relationships
    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class);
    }
}
