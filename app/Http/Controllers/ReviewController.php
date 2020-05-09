<?php

namespace App\Http\Controllers;

use App\comments;
use App\posts;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($post)
    {
        $posts = posts::find($post);
        $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'users_id')
            ->where('posts.id', $post)
            ->get();
        return view('posts.reviews.review', ['posts' => $posts, 'user' => $users]);
    }

    public function form($post)
    {
        $post = posts::find($post);

        return view('posts.reviews.ReviewForm', ['post' => $post]);
    }

    public function update($post, Request $request)
    {
          $user = DB::table('users')
                ->find(Auth::id());
          $post = DB::table('posts')
                ->find($post);
          $status = DB::table('reviews')
                ->select(DB::raw('count(users_id) as status'))
                ->where('users_id', '=', $user->id)
                ->get();
        $use = User::find($user->id);
        $pos = posts::find($post->id);
        $review = new Review();
        if($status[0]->status < 1) {
            $summary = $request->input('summary');
            $algo = $request->input('algorithms');
            $sub = $request->input('sub');
            $link = $request->input('link');
            $resources = $request->file('res');
            if ($resources)
                $resources = $resources->store('upload/review_resources', 'public');
            if ($summary || $algo || $sub || $link || $resources) {
                $review->posts_id = $post->id;
                $review->users_id = $user->id;
                $review->save();
                if ($summary) {
                    $review->summary = $summary;
                    $review->save();
                }
                if ($algo) {
                    $review->algo = $algo;
                    $review->save();
                }
                if ($sub) {
                    $review->sub = $sub;
                    $review->save();
                }
                if ($link) {
                    $review->link = $link;
                    $review->save();
                }
                if ($resources) {
                    $review->res = $resources;
                    $review->save();
                }

                return redirect()->route('reviews.show', [$pos, $use,$review]);
            }
            else {
                echo 'nothing to update';
                return redirect()->route('reviews.edit', ['posts' => $pos]);
            }

        }
        else echo 'you cant give more than one review. you can edit request your previous one to admin';
        return redirect()->route('posts.reviews', ['posts' => $pos]);

    }
    public function show(posts $posts, User $user, Review $review)
    {

        return view('posts.reviews.reviewshow',
            ['posts' => $posts, 'user' => $user, 'review' => $review]);
    }
    public function showreviews(posts $posts)
    {
        $reviews = DB::table('reviews')
                 ->rightJoin('users', 'reviews.users_id', '=', 'users.id')
                 ->where('posts_id', '=', $posts->id)
                 ->select('users.name', 'reviews.users_id', 'reviews.posts_id', 'reviews.id')
                 ->get();
        $total = DB::table('comments')
            ->select(DB::raw('count(*) as count, comments.reviews_id'))
            ->groupBy('comments.reviews_id')
            ->get();
        $e = ($total->isEmpty()) ? '0' : $total;
        return view('posts.reviews.showreviews',
            ['posts' => $posts, 'reviews' => $reviews, 'total' => $e]);
    }
    public function postcomment(posts $posts, User $user, Review $review)
    {

        return view('posts.reviews.comments.reviewcomment',
            ['posts' => $posts, 'user' => $user,'reviews' => $review]);
    }
    public function comment(posts $posts, Review $reviews, Request $request)
    {
        $comment = new comments();
        $comment->users_id = Auth::id();
        $comment->posts_id = $posts->id;
        $comment->reviews_id = $reviews->id;
        $comment->comment = $request->input('comment');
        $comment->save();
        $user = User::find(Auth::id());
        return redirect()->route('comment.show', [$posts, $user, $reviews]);
    }
    public function commentshow(posts $posts, User $user, Review $review)
    {
        $com = DB::table('comments')
            ->join('reviews', 'comments.reviews_id', '=', 'reviews.id')
            ->leftJoin('users', 'comments.users_id', '=', 'users.id')
            ->where('reviews.id', '=', $review->id)
            ->select('comments.*', 'reviews.id', 'users.name', 'comments.users_id')
            ->get();
        return view('posts.reviews.comments.showcomment', ['com' => $com]);
    }
}
