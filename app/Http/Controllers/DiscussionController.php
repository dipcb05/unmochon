<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    public function index()
    {
        $posts = DB::table('discussions')
            ->leftJoin('users', 'discussions.users_id', '=', 'users.id')
            ->select('discussions.*', 'users.name')
            ->orderBy('id', 'DESC')
            ->get();
        if($posts == '[]')
            $posts = null;
        return view('discussion', ['posts' => $posts]);

    }
    public function update(Request $request)
    {
        $d = new discussion();
        $d->users_id = Auth::id();
        $d->keyword = $request->input('keyword');
        $d->question = $request->input('question');
        $d->save();
        return redirect()->route('discussion');
    }
    public function show($dis)
    {
        $d = discussion::find($dis);
        $users = DB::table('users')
            ->leftJoin('discussion', 'users.id', '=', 'users_id')
            ->where('discussion.id', $d->id)
            ->get();
        $c = DB::table('discussions')
            ->where('discussions.id', '=', $d->id)
            ->select('*')
            ->get();
        return view('posts.reviews.review',
            ['d' => $d, 'u' => $users[0], 'c' => $c]);
    }
    public function comment($dis, Request $request)
    {
        $dis = Discussion::find($dis);
        $dis->commentor = Auth::id();
//        $comment->save();
//        $user = User::find(Auth::id());
//        return redirect()->route('reviews.show', [$posts, $user, $reviews]);
    }
}
