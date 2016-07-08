<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


//This model is for create ACL for specific users
//Eg. Admin, Parent, Teacher,
class Role extends Model
{

    //
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'permission'
    ];


    /**
     * Get users with a certain role
     */
    public function users(){

        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
