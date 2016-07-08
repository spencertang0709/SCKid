<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    //
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'contact', 'content', 'direction', 'time'
    ];


    /**
     * Get the kid that owns the SMS
     */
    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
