<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{


    //This overrides our table name
    //protected $table;

    //This overrides primary key
    //protected $primaryKey

    //If we wish to use non-incrementing primary key
//    protected $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'age','address','private'
    ];

    //Relationships
    //Many-Many relationship
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
	
	public function apps() 
	{
		return $this->belongsToMany(App::class)->withPivot('is_blocked', 'is_monitored')->withTimestamps();
	}
	
	public function websites()
	{
		return $this->belongsToMany(Website::class)->withTimestamps();
	}
	
	public function socialMedias()
	{
		return $this->belongsToMany(SocialMedia::class)->withPivot('is_blocked', 'is_monitored','token')->withTimestamps();
	}
	
	public function beacons()
	{
		return $this->belongsToMany(Beacon::class)->withTimestamps();
	}
	
	public function timeSlots()
	{
		return $this->belongsToMany(TimeSlot::class)->withTimestamps();
	}
	
	//Many-One relationship
	public function devices()
	{
		return $this->hasMany(Device::class);
	}
	
	public function calls()
	{
		return $this->hasMany(Call::class);
	}
	
	public function smss()
	{
		return $this->hasMany(Sms::class);
	}
	
	public function locations()
	{
		return $this->hasMany(Location::class);
	}
	
	public function panics()
	{
		return $this->hasMany(Panic::class);
	}

	public function messages()
	{
		return $this->hasMany(Panic::class);
	}
	
	
	//Queries
	/**
     * Iterate through all kids
     *
     * @return Response
     */
    public function iterate()
    {
        $kids = Kid::all();

        foreach ($kids as $kid) {
            echo $kid->name;
        }
    }

}
