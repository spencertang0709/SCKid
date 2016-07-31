<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subheading',
        'content'
    ];

    //Relationships
    //Many to many relationship
    public function titles()
    {
        return $this->belongsToMany(Title::class)->withTimestamps();
    }
}
