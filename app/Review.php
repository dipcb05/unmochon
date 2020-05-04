<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];
    protected $fillable = ['users_id', 'posts_id', 'summary', 'algo', 'sub', 'link', 'res'];
    protected $table = "reviews";


    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function posts()
    {
        return $this->belongsTo(posts::class, 'posts_id', 'id');
    }
}
