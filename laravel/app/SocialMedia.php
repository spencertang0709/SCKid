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
        			->withPivot('is_blocked', 'is_monitored', 'token', 'account_id', 'nickname', 'name', 'avatar')
        			->withTimestamps();
    }
	
	//Many-One
	public function posts()
	{
		return $this->hasMany(Post::class);
	}
	
	public function likedPages()
	{
		return $this->hasMany(LikedPage::class);
	}
	
	public function albums()
	{
		return $this->hasMany(Album::class);
	}
	
}
