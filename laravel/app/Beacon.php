<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beacon extends Model
{
    //Attributes
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location', 'major', 'minor',
    ];

	//Relationships
    /**
     * Get the user that owns the beacon.
     */

	public function contextPolicies()
	{
		return $this->hasMany(ContextPolicy::class);
	}

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
