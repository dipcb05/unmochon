<?php

namespace App\Http\Controllers;

use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index($post)
    {
        $posts = DB::table('posts')->find($post);
        $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'user_id')
            ->where('posts.id', $post)
            ->get();
        //dd($users, $posts);
        return view('posts.reviews.review', ['posts' => $posts], ['user' => $users]);

    }
}
