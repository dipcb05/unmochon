<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('verified');
    }


    public function index($user)
    {
        //$use = DB::table('users')->find($user);
        $use = User::find($user);
        $posts = DB::table('posts')->where('user_id', $user)->get();
        //dd($posts);

        return view('profile.profile', ['user' => $use], ['posts' => $posts]);
    }
}
