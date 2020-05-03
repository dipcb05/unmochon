<?php

namespace App\Http\Controllers;

use App\post;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index($post)
    {
        //$posts = DB::table('posts')->find($post);
        //dd($posts->reviews);
        $posts = Post::find($post);
        //dd($posts->reviews);
//        if($posts->reviews) {
//            $reviews = new Review();
//            $reviews->posts_id = $posts->id;
//            //dd($reviews->posts_id);
//            $reviews->save();
//        }

        $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'user_id')
            ->where('posts.id', $post)
            ->get();
        return view('posts.reviews.review', ['posts' => $posts], ['user' => $users]);
    }
    public function form($post)
    {
        $post = DB::table('posts')->find($post);
        return view('posts.reviews.ReviewForm', ['post' => $post]);
    }

    public function update($post, Request $request)
    {
        $user = new User();
        //$post = DB::table('posts')->find($post);
        //dd($post);
        $summary = $request->input('summary');
        $algo = $request->input('algorithms');
        $sub  = $request->input('sub');
        $link = $request->input('link');
        $resources = $request->input('resources');



        $data = $request->validate([
            'summary' => '',
            'algorithms' => '',
            'sub' => '',
            'link' => '',
            'resources' => ''
        ]);
        if($request->input('resources'))
        $path = $request->input('resources')->store('upload/review_resources', 'public');
        else $path = null;
        $review = new Review();
        $review->summary = $data['summary'];
        $review->algorithms = $data['algorithms'];
        $review->sub = $data['sub'];
        $review->link = $data['link'];
        //$path = $data['resources'];
        $post = // your reviewed post

            $user->reviews()->create([
                'post_id' => $post->id
                // other fields
            ]);

//            //->create(
//            [
//                'summary' => $review->summary,
//                'algorithms' => $review->algorithms,
//                'sub' => $review -> sub,
//                'link' => $review -> link,
//                'resources' => $path,
//            ]);








        if($resources) $resources = $resources->store('upload/review_resources', 'public');
        if($summary || $algo || $sub || $link || $resources)
        {
            $user->reviews->posts_id = $post;
            //$user->reviews->save();
            if ($summary) {
                $user->reviews->summary = $summary;
                $user->reviews()->save();
            }
            if ($algo) {
                $user->reviews->algo = $algo;
                $user->review->save();
            }
            if ($sub) {
                $user->review->sub = $sub;
                $user->profile->save();
            }
            if ($link) {
                $user->review->link = $link;
                $user->profile->save();
            }
            if ($resources) {
                $user->review->res = $resources;
                $user->review->save();
            }
            echo 'updated';
        }
        else echo 'nothing to update';

        return redirect()->route('reviews.show', $user);
    }

}
