<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
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
    public function categories()
    {
      return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function articles()
    {
      return $this->belongsToMany(Article::class)->withTimestamps();
    }
}
