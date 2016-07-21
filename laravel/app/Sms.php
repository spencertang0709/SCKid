<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'contact', 'direction', 'read', 'message', 'time'
    ];
	
	//direction: 0-->to, 1-->from


    /**
     * Get the kid that has this panic message
     */
    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
