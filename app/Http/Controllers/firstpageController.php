<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class firstpageController extends Controller
{
   public function index ()
    {
    return view('homeview.firstpage');
    }

    public function see_paper($element)
    {
        if($element == 'author') {
            $find = DB::table('posts')
                ->select(DB::raw('count(post) as number_of_post, user_id'))
                ->groupBy('user_id')
                ->orderByRaw('count(post) DESC')
                ->get();
            $users = DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.user_id')
                ->select('users.name', 'users.job')
                ->get();
            //dd($find);
           return view('query.author', ['find' => $find], ['user' => $users]);
        }
    }

}
