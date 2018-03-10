<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlackPoint extends Model
{
    protected $guard = [];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}