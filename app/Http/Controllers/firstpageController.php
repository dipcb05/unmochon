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
                ->select(DB::raw('count(posts) as number_of_post, user_id'))
                ->groupBy('user_id')
                ->orderByRaw('count(posts) DESC')
                ->get();
            $users = DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.user_id')
                ->select('users.name', 'users.job')
                ->get();
        }
        elseif ($element == 'subject')
        {

        }
        return view('query.author', ['find' => $find], ['user' => $users]);
    }

}
