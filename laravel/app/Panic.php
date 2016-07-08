<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panic extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude', 'longitude', 'message', 'time','imageURL'
    ];


    /**
     * Get the kid that has this panic message
     */
    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
