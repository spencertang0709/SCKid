<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude', 'longitude', 'time',
    ];


    /**
     * Get the kid that has this location
     */
    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
