<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    //
    protected $fillable = [
      'name'
    ];

    public function categories()
    {
      return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
