<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'day', 'start_time', 'end_time'
    ];

	//Relationships
    /**
     * Get the kids that owns the time.
     */
    public function kids()
    {
        return $this->belongsToMany(Kid::class)->withTimestamps();
    }
}
