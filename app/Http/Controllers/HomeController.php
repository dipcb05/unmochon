<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('homeview.home', ['posts' => $posts]);

      }
      public function search(Request $request)
      {
          $post = DB::table('posts')
              ->whereRaw('pcaption or author like ?',
                  ["%{$request->get('search')}%"])
              ->get();

          redirect()->route('home', ['posts' => $post]);

      }
      public function paper_req()
      {
          $user = User::find(Auth::id());
          return view('paper_req', ['user' => $user]);
      }
    public function admin_task($user, Request $request)
    {
           $n = DB::table('users')
               ->select('name')
               ->where('id', '=', $user)
               ->get();
           DB::table('admin_tasks')
               ->insert([
                  'from' => $n[0]->name,
                  'name' => $request->get('name'),
                  'year' => $request->get('year')
               ]);
           echo 'successfully done';
           redirect()->route('home');
    }


}
