<?php

namespace App\Http\Controllers;

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
                ->select(DB::raw('count(posts) as number_of_post, users_id'))
                ->groupBy('users_id')
                ->orderByRaw('count(posts) DESC')
                ->get();

        }
        else if ($element == 'subject')
        {

            $find = DB::table('posts')
                ->select(DB::raw('count(posts) as number_of_post, subject'))
                ->groupBy('subject')
                ->orderByRaw('count(posts) DESC')
                ->get();
//            $users = DB::table('users')
//                ->join('posts', 'users.id', '=', 'posts.user_id')
//                ->select('users.name', 'users.job')
//                ->get();
        }
        dd($find);
       // return view('query.author', ['find' => $find]);
    }

}
