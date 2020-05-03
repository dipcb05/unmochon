<?php

namespace App\Http\Controllers;

use App\post;
use App\Profile;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = DB::table('posts')->get();
        $users = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.name')
            ->get();

        return view('homeview.home', ['posts' => $posts], ['user' => $users]);

      }


}
