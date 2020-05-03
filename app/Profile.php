<?php

namespace App;

use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Profile extends Model
{
    protected $guarded = [];
    protected $fillable = ['user_id','country', 'bdate', 'job', 'wdate', 'des', 'web', 'pic'];
    protected $table = "profiles";
    //protected $redirectTo = RouteServiceProvider::HOME;
	public function user()
	{
    return $this->belongsTo(User::class);
    }


}
