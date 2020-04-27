<?php

namespace App\Http\Controllers;

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
        $id = Auth::id();
       // $user = DB::table('users')->find($id);
        $posts = DB::table('posts')->get();
        $user = User::find($id);
        //$post = $user->posts;
        //dd($post);
        return view('homeview.home', ['user' => $user], ['posts' => $posts]);

      }

}
