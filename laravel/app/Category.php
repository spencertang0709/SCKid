<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function titles()
  	{
  		return $this->belongsToMany(Title::class)->withTimestamps();
  	}
}
