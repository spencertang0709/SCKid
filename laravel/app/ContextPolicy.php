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
        'app_list', 'start_time', 'end_time', 'screen_time'
    ];

    //Relationships
    public function beacon() {
    	return $this->belongsTo(Beacon::class);
    }

	public function kid() {
		return $this->belongsTo(Kid::class);
	}

	//Queries

}
