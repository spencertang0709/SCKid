<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    //Attributes
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'package', 'is_installed'
    ];

	//Relationships
    /**
     * Get the kid that owns the App
     */
    public function kids()
    {
        return $this->belongsToMany(Kid::class)
					->withPivot('isBlocked', 'isMonitored')->withTimestamps();
    }

	//Queries
    /**
     * Scope a query to only include apps installed
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    //Use this:
    //$users = App\App::installed()->get();
    
    public function scopeInstalled($query)
    {
        return $query->where('isInstalled', '==', 1);
    }
}
