<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class home extends Model
{
    public function home()
	{
    return $this->belongsTo(User::class);
    }
}
