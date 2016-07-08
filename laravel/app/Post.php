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
        'messages', 'comments', 'likes', 'createdTime'
    ];
    
    //Relationships
    public function socialMedia()
    {
        return $this -> belongsTo(SocialMedia::class);
    }
}
