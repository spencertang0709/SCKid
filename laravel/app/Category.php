<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'name'
    ];

    //Relationships
    //Many to many relationship
    public function titles()
  	{
  		return $this->belongsToMany(Title::class)->withTimestamps();
  	}
}
