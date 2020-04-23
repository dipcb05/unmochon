<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postview extends Model
{
    public function posts()
    {
        return $this->belongsTo(post::class);
    }
}
