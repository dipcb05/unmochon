<?php

namespace App\Http\Controllers;
use App\Models\comments;
use App\Models\posts;
use App\Models\Ratings;
use App\Models\Review;
use App\Models\View;
use App\User;
use Doctrine\DBAL\DBALException;
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
            ->where('posts.id', $posts->id)
            ->get();
        $reviews = DB::table('reviews')
            ->rightJoin('users', 'reviews.users_id', '=', 'users.id')
            ->where('reviews.posts_id', '=', $posts->id)
            ->select('users.name', 'reviews.users_id', 'reviews.posts_id', 'reviews.id')
            ->get();
        if($reviews == '[]')$reviews = null;
        $v = DB::table('views')
            ->join('users', 'views.users_id', '=', 'users.id')
            ->where('posts_id', '=', $post)
            ->where('role', '=', '3')
            ->select('reviews_id')
            ->distinct()
            ->get();
        if($v == '[]')$v = null;
        return view('posts.reviews.review',
            ['posts' => $posts, 'user' => $users[0], 'reviews' => $reviews, 'v' => $v]);
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
            ->select(DB::raw('count(users_id) as status, posts_id'))
            ->groupBy('posts_id')
            ->where('reviews.users_id', '=', $user->id)
            ->get();
        if($status->isEmpty())
            $e = 0;
        else
        {
            $e = $status[0];
            if($e->posts_id != $post->id)
                $e = 0;
            else $e = $e->status;
        }
        $use = User::find($user->id);
        $pos = posts::find($post->id);
        $review = new Review();
        if($e < 1) {
            $summary = $request->input('summary');
            $algo = $request->input('algorithms');
            $sub = $request->input('sub');
            $link = $request->input('link');
            $resources = $request->file('res');
            if ($resources)
                $resources = $resources->store('upload/review_resources',
                    'public');
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
                $r = Ratings::find($user->id);
                $r->ratings = $r->ratings+20;
                $r->save();
                return redirect()->route('reviews.show', [$pos, $use,$review]);
            }
            else {
                $msg = 'nothing to update';
                $link = url()->previous();
                return view('single_features.error', ['msg' => $msg, 'link' => $link]);
            }

        }
        else
        {
            $msg = 'you cant give more than one review. you can edit request your previous one to admin';
            $link = url()->previous();
            return view('single_features.error', ['msg' => $msg, 'link' => $link]);
        }

    }
    public function show(posts $posts, User $user, Review $review)
    {
        $p = $posts->id;
        $r = $review->id;
        $e = DB::table('users')
            ->where('id' , '=', Auth::id())
            ->select('role')
            ->get();
        ($e[0]->role == 3) ? $m = "peer reviewed" : $m = " ";
        $view = new View();
        $view->posts_id = $p;
        $view->reviews_id = $r;
        $view->users_id = Auth::id();
        $view->save();
        $total = DB::table('comments')
            ->select(DB::raw('count(*) as count, comments.reviews_id'))
            ->groupBy('comments.reviews_id')
            ->where('reviews_id', '=', $review->id)
            ->get();
        $com = DB::table('comments')
            ->join('reviews', 'comments.reviews_id', '=', 'reviews.id')
            ->leftJoin('users', 'comments.users_id', '=', 'users.id')
            ->where('reviews.id', '=', $review->id)
            ->select('comments.*', 'reviews.id', 'users.name', 'comments.users_id')
            ->get();
        $e = ($total->isEmpty()) ? '0' : $total;
        $q = DB::table('upvotes')
            ->where('users_id', '=', Auth::id())
            ->where('type', '=', 'review')
            ->where('type_id', '=', $r)
            ->get();
        if($q == '[]')$button2 = 'yes';
        else $button2 = null;
        if($review->users_id == Auth::id())
            $button = 'yes';
        else $button = null;

        return view('posts.reviews.reviewshow',
            ['posts' => $posts,
                'user' => $user,
                'review' => $review,
                'total' => $e,
                'comments' => $com,
                'button' => $button,
                'button2' => $button2,
                'm' => $m
            ]);
    }
    public function review_delete($post, $review)
    {
        DB::table('comments')
            ->where('reviews_id', '=', $review)
            ->delete();
        DB::table('reviews')
            ->where('id', '=', $review)
            ->delete();

        return redirect()->route('posts.show', $post);
    }
    public function reviews_edit($review)
    {
        $review = Review::find($review);
        return view('posts.reviews.reviewedit', ['review' => $review]);
    }
    public function reviews_editpost($review, Request $request)
    {
        $review = Review::find($review);
        $s = similar_text($review->summary,$request->input('summary'),$percent);
        $a = similar_text($review->algo,$request->input('algo'),$percent);
        $su = similar_text($review->sub,$request->input('sub'),$percent);
        $li = similar_text($review->link,$request->input('link'),$percent);

        if($review->edit) {
        $review->edit()->create([
                'posts_id' => $review->posts_id,
                'reviews_id' => $review->id,
                'summary' => $request->input('summary'),
                'algo' => $request->input('algo'),
                'sub' => $request->input('sub'),
                'link' => $request->input('link'),
                'res'  => 'null',
                'sum_percent' => $s,
                'algo_percent' => $a,
                'sub_percent' => $su,
                'li_percent' => $li
            ]);
            $resources = $request->file('res');
            if($resources)
                $resources = $resources->store('upload/edit/review_resources', 'public');
             DB::table('reviews_edit')
                 ->where('reviews_id', '=', $review->id)
                 ->update(['res' => $resources]);
             $review->edit = '0';
             $review->save();
        }

    else {
        $msg = 'not possible. limit over';
        $link = url()->previous();
        return view('error', ['msg' => $msg, 'link' => $link]);
    }
    return redirect()->route('reviews.show', [$review->post_id, Auth::id(), $review]);
    }

    public function comment(posts $posts, Review $reviews, Request $request)
    {
        $r = Ratings::find(Auth::id());
        $r->ratings = $r->ratings+2;
        $r->save();
        $comment = new comments();
        $comment->users_id = Auth::id();
        $comment->posts_id = $posts->id;
        $comment->reviews_id = $reviews->id;
        $comment->comment = $request->input('comment');
        $comment->save();
        $user = User::find(Auth::id());
        return redirect()->route('reviews.show', [$posts, $user, $reviews]);
    }

}
