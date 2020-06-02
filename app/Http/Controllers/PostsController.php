<?php

namespace App\Http\Controllers;
use App\posts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function create()
    {
        $id = Auth::id();
        $user = DB::table('users')
              ->find($id);
        return view('posts.posts', ['user' => $user]);
    }
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pcaption' => 'required',
            'posts' => 'required',
            'author' => '',
            'subject' => 'required'
        ]);
        $path = request('posts')->store('upload/posts', 'public');
        $post = new posts();
        $post->pcaption = $data['pcaption'];
        $post->posts = $path;
        if($data['author'])
        $post->author = $data['author'];
        $post->subject = $data['subject'];

         Auth()->user()->posts()->create(
           [
               'pcaption' => $post->pcaption,
               'posts'     => $post->posts,
               'author'   => $post->author,
               'subject'  => $post->subject,
            ]);
         return redirect()->route('home');
    }


    public function showdata($post)
    {
        $file = DB::table('posts')->find($post);
        $header = ['Content-Type', 'application/pdf'];
        $path = storage_path('app/public/'.$file->post);
        //$d = '/app/public/'.$file->posts;
        //dd(response()->file($path)->getFile()->getPath());
        //dd($file);
        //return view('posts.postview', ['posts' => response()->file($path)], ['file' => $file]);
        return view('posts.postview', ['file' => $path]);
    }

    public function post_delete($post)
    {
        DB::table('posts')
            ->where('id', '=', $post)
            ->delete();
        $user = User::find(Auth::id());
        return redirect()->route('profile.show', $user);
    }

    }
