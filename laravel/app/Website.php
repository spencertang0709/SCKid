<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'host', 'ip', 'type',
    ];
    
	//Relationships
    /**
     * Get the kids that has this website for blocking
     */
    public function kids()
    {
        return $this->belongsToMany(Kid::class)
					->withPivot('isBlocked', 'isMonitored')->withTimestamps();
    }

}
