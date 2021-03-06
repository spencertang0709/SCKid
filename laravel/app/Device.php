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
        'name', 'model', 'unique_id'
    ];

	//Relationships
    /**
     * Get the user that owns the beacon.
     */
    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function gcmkey() {
        return $this->belongsTo(GcmKey::class);
    }

    public function gcmMessages(){
        return $this->hasMany(GcmMessage::class);
    }
}
