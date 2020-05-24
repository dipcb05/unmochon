<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

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
        $posts = DB::table('posts')
               ->select('*')
               ->orderBy('id', 'DESC')
               ->get();
        $users = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.users_id')
            ->select('users.name')
            ->get();

        return view('homeview.home', ['posts' => $posts], ['user' => $users]);

      }


}
