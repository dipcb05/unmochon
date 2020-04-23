<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
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

public $post;
    public function user()
    {
    return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function postview()
    {
        return $this->hasOne(postview::class);
    }

}
