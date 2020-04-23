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
            //$file = post::find($post);
           $file = DB::table('posts')->find($post);
            $header = ['Content-Type', 'application/pdf'];
          $a = "/storage/";
          $b = $file->post;
          $c = $a . $b;

      //  dd($b);
        dd(response()->file($c, $header));

    }

}
