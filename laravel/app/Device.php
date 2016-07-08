<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //Attributes
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'model','unique_id'
    ];

	//Relationships
    /**
     * Get the user that owns the beacon.
     */
    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
