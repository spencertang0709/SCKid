<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'comments', 'count', 'privacy'
    ];
    
    //Relationships
    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class);
    }
	
	public function photos() 
	{
		return $this->hasMany(Photo::class);	
	}
	
}
