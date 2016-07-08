<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikedPage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url'
    ];
    
    //Relationships
    
    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class);
    }
}
