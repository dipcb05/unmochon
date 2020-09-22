<?php
namespace App\Http\Controllers;
use App\Models\Review;
use App\User;
use Illuminate\Http\Request;
use App\Models\posts;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(posts $posts, Review $review)
    {
        return response()->json($review->comments()->with('user')->latest()->get());
    }

    public function store($review, Request $request)
    {
        $comment = $review->comments()->create([
            'comment' => $request->body,
            'users_id' => Auth::id(),
            'reviews_id' => $review->id,
            'posts_id' => $review->posts_id
        ]);

        $comment = comments::where('id', $comment->id)->with('user')->first();
        return $comment->toJson();

    }


}
