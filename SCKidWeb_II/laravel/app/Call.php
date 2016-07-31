<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    //Attributes
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'contact', 'direction', 'start_time', 'end_time'
    ];

    /**
     * The attributes that should be hidden in arrays & Json.
     *
     * @var array
     */
//    protected $hidden = ['_id'];


	//Relationships
    /**
     * Get the kid that owns the Call
     */
    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
	
}
