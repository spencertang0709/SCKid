<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GcmKey extends Model
{
    protected $fillable = [
        'api_key', 'registration_token', 'device_id'
    ];

    public function device() {
        return $this->belongsTo(Device::class);
    }
}
