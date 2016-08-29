<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensitiveWord extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'keyword'
    ];
}
