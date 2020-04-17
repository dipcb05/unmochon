<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public function profile()
    {
    return $this->belongsTo(User::class);
    }

}
