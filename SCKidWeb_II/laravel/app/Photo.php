<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'source'
    ];
    
    //Relationships
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
