<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class home extends Model
{
    public function home()
	{
    return $this->belongsTo(User::class);
    }
}
