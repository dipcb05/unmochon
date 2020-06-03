<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    public function index($user)
    {

        $use = User::find($user);
        $posts = DB::table('posts')
                 ->where('users_id', $user)
                 ->get();
        $count_review = DB::table('reviews')
                        ->select(DB::raw('count(id) as review_count'))
                        ->where('users_id', '=', $user)
                        ->get();
        $count_post = DB::table('posts')
                      ->select(DB::raw('count(id) as post_count'))
                      ->where('users_id', '=', $user)
                      ->get();
        $count_comment = DB::table('comments')
                         ->select(DB::raw('count(id) as comment_count'))
                         ->where('users_id', '=', $user)
                         ->get();

        return view('profile.profile',
                           ['user' => $use,
                            'posts' => $posts,
                            'count_review' => $count_review[0]->review_count,
                            'count_post' => $count_post[0]->post_count,
                            'count_comment' => $count_comment[0]->comment_count]);
    }
    public function edit(User $user)
    {
        try {
            $this->authorize('update', $user->profile);
        } catch (AuthorizationException $e) {
            echo "not possible";
        }
        return view('profile.EditProfile', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $name = $request->input('name');
        $country = $request->input('country');
        $bdate = $request->input('bdate');
        $job  = $request->input('job');
        $wdate = $request->input('wdate');
        $des = $request->input('description');
        $web = $request->input('website');
        $pic = request('pic');
        if($pic) $pic = $pic->store('upload/pro_pic', 'public');
           if ($name || $country || $bdate || $job || $wdate || $pic || $web || $des) {
               if ($name) {

                   DB::table('users')
                       ->where('id', '=', $user->id)
                       ->update(['name' => $name]);
                   //$user->name = $name;
                   //$user->save();
               }
               if ($country) {
                   //$user->profile->country = $country;
                   //$user->profile->save();
                   DB::table('profiles')
                       ->where('users_id', '=', $user->id)
                       ->update(['country' => $country]);
               }
               if ($bdate) {
//                   $user->profile->bdate = $bdate;
//                   $user->profile->save();
                   DB::table('profiles')
                       ->where('users_id', '=', $user->id)
                       ->update(['bdate' => $bdate]);
               }
               if ($job) {

                   DB::table('profiles')
                       ->where('users_id', '=', $user->id)
                       ->update(['bdate' => $bdate]);

//                   $user->profile->job = $job;
//                   $user->profile->save();
               }
               if ($wdate) {
                   DB::table('profiles')
                       ->where('users_id', '=', $user->id)
                       ->update(['wdate' => $wdate]);
//                   $user->profile->wdate = $wdate;
//                   $user->profile->save();
               }
               if ($pic) {
                   DB::table('profiles')
                       ->where('users_id', '=', $user->id)
                       ->update(['pic' => $pic]);
//                   $user->profile->pic = $pic;
//                   $user->profile->save();
               }
               if ($des) {
                   DB::table('profiles')
                       ->where('users_id', '=', $user->id)
                       ->update(['description' => $des]);
//                   $user->profile->description = $des;
//                   $user->profile->save();
               }
               if ($web) {
                   DB::table('profiles')
                       ->where('users_id', '=', $user->id)
                       ->update(['website' => $web]);
//                   $user->profile->website = $web;
//                   $user->profile->save();
               }
               echo 'updated';
           } else echo 'nothing to update';

        return redirect()->route('profile.show', $user);
    }


}
