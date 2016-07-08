<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContextPolicy extends Model
{
	//Specify table names to avoid plural form
	protected $table = 'context_policys';
	
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time', 'end_time', 'guardianNearby'
    ];

    //Relationships
    public function beacon() {
    	return $this->belongsTo(Beacon::class);
    }
	
	//Queries
	
}
