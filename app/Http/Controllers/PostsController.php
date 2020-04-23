<?php

namespace App\Http\Controllers;
use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function create()
    {
        $id = Auth::id();
        $user = DB::table('users')->find($id);
        return view('posts', ['user' => $user]);
    }
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['pcaption' => 'required', 'post' => 'required']);
        //$path = $request->file('post')->store('upload');
        $path = request('post')->store('upload', 'public');
        $post = new post();
        $post->pcaption = $data['pcaption'];
        $post->post = $path;
         Auth()->user()->posts()->create(
           [
               'pcaption' => $post->pcaption,
               'post' => $post->post,
            ]);
        return redirect()->route('home');
    }

    public function show(\App\post $post)
    {
        return view('postview', compact('post'));
    }


    }
