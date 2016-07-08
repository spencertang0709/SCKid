<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type'
    ];
    
	
    //Relationships
    //Many-Many
    public function kids()
    {
        return $this->belongsToMany(Kid::class) 
        			->withPivot('isBlocked', 'isMonitored', 'token')->withTimestamps();
    }
	
	//Many-One
	public function post()
	{
		return $this->hasMany(Post::class);
	}
	
	public function image()
	{
		return $this->hasMany(Image::class);
	}
	
	public function likedPage()
	{
		return $this->hasMany(LikedPage::class);
	}
	
}
