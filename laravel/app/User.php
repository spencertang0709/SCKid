<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	//Relationships
	//Many to many relationship
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
	
	public function kids()
	{
		return $this->belongsToMany(Kid::class)->withTimestamps();
	}

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
	public function devices() 
	{
		return $this->belongsToMany(Device::class)->withTimestamps();
	}
	
	public function beacons()
	{
		return $this->belongsToMany(Beacon::class)->withTimestamps();
	}

//    public function beacons(){
//        return $this->hasManyThrough(Kid, )
//    }
	
	/*
	//Many-One relationship
   	public function jobs()
	{
		return $this->hasMany(Job::class);
	}
	*/
}