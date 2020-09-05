<?php

namespace App;

use App\Mail\WelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

/**
 * @method static find(int|string|null $id)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'phone', 'gender', 'password', 'isVerified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
                  $user->profile()->create([
                    'users_id' => $user->id,
                ]);
                Mail::to($user->email)->send(new WelcomeMail());
            });


    }


    public function profile()
    {
        return $this->hasOne(Profile::class, 'users_id', 'id');
    }
    public function posts()
    {
    return $this->hasMany(posts::class, 'users_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'users_id', 'id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}
