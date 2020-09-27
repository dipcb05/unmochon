<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\posts;
use App\Models\Review;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\HTTP\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    public function update($type, $id)
    {
        switch ($type)
        {
            case 'post':
                $p = posts::find($id);
                $q = DB::table('upvotes')
                    ->where('users_id', '=', Auth::id())
                    ->where('type', '=', $type)
                    ->where('type_id', '=', $id)
                    ->get();
                if($q == '[]') {
                    if ($p->users_id == Auth::id()) {
                        $msg = 'self rating not allowed';
                        $link = route('home');
                        return view('single_features.error', ['msg' => $msg, 'link' => $link]);
                    } else {

                        Auth()->user()->upvote()->create(
                            [
                                'type' => 'post',
                                'type_id' => $id,
                            ]);
                        $p->rating = $p->rating + 2;
                        $p->save();
                        return redirect()->route('home');
                    }
                }
                else
                {
                        $msg = 'already voted';
                        $link = route('home');
                        return view('single_features.error', ['msg' => $msg, 'link' => $link]);
                }

                break;

            case 'review':
                $r = Review::find($id);
                $q = DB::table('upvotes')
                    ->where('users_id', '=', Auth::id())
                    ->where('type', '=', $type)
                    ->where('type_id', '=', $id)
                    ->get();
                if($q == '[]') {
                    if ($r->users_id == Auth::id()) {
                        $msg = 'self rating not allowed';
                        $link =  url()->previous();
                        return view('single_features.error', ['msg' => $msg, 'link' => $link]);
                    } else {

                        Auth()->user()->upvote()->create(
                            [
                                'type' => 'review',
                                'type_id' => $id,
                            ]);
                        $r->rating = $r->rating + 4;
                        $r->save();
                        return redirect()->route('reviews.show', [$r->posts_id, $r->users_id, $r->id]);
                    }
                }
                else
                {
                    $msg = 'already voted';
                    $link = url()->previous();
                    return view('single_features.error', ['msg' => $msg, 'link' => $link]);
                }
                break;
        }

    return redirect()->home();
    }
}
