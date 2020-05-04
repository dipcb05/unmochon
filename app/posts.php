<?php

namespace App;

use App\Mail\WelcomeMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class posts extends Model
{
	protected $guarded = [];

    /**
     * @var mixed
     */

    /**
     * @var mixed
     */


    /**
     * @var mixed
     */


    public function postview()
    {
        return $this->hasOne(postview::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'posts_id', 'id');
    }

}
