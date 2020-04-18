<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    	$data = request()->validate(['pcaption' => 'required']);
         dd($data);
//        $path = request('post')->store('uploads', 'public');
//        Auth()->user()->posts()->create(
//            [
//                'pcaption' => $data['pcaption'],
//                'post' => $data['post'],
//            ]);
//        dd(request()->all());
    }
    }

