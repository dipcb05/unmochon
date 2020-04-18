<?php

namespace App\Http\Controllers;
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


    public function store()
    {

    	$data = request()->validate(['pcaption' => 'required']);
         //dd(request('post')->store('uploads', 'public'));
         $path = request('post')->store('uploads', 'public');
         Auth()->user()->posts()->create(
           [
              'pcaption' => $data['pcaption'],
             'post' => $path,
            ]);
//        dd(request()->all());
        return redirect()->route('home');
    }
    }

