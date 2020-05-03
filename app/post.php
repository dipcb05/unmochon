<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
	protected $guarded = [];
    protected $table = 'posts';
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
        return $this->belongsTo(User::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
