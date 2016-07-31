<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
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
    public function socialMedias()
    {
        return $this->belongsTo(SocialMedia::class);
    }
}
