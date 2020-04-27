<?php

namespace App\Http\Controllers;

use App\post;
use App\User;
use Illuminate\Support\Facades\DB;

class PostViewController extends Controller
{
    public function index($post)
    {
        //$use = DB::table('users')->find($user);
        //$pos = post::find($post);
        $posts = DB::table('posts')->find($post);
        //dd($posts);
        return view('postview', ['post' => $posts]);
    }
    public function show($post)
    {
            $file = DB::table('posts')->find($post);
            $header = ['Content-Type', 'application/pdf'];
            $path = storage_path('app/public/'.$file->post);
            $d = storage_path($file->post);
           // dd(response()->file($path));
           return view('posts.postview', ['post' => response()->file($path)]);

    }

}
