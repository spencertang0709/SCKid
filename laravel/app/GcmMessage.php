<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GcmMessage extends Model
{
    protected $fillable = [
        'title', 'content', 'device_id'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
