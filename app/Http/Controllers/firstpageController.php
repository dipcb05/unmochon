<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class firstpageController extends Controller
{
   public function index ()
    {
        $posts = DB::table('posts')
            ->select('*')
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();
    return view('homeview.firstpage', ['post' => $posts]);
    }
    public function search(Request $request)
    {
        $post = DB::table('posts')
            ->whereRaw('pcaption or author like ?',
            ["%{$request->get('search')}%"])
            ->get();
        $user = DB::table('users')
            ->whereRaw('name like ?',
                ["%{$request->get('search')}%"])
            ->get();
        return view('query.search', ['query_name' => $request->get('search'),
        'posts' => $post, 'user' => $user]);
    }

    public function see_paper($element)
    {

        if($element == 'author') {

            $find = DB::table('posts')
                ->join('users', 'posts.users_id', '=', 'users.id')
                ->select(DB::raw('count(posts) as number_of_post, users_id, name'))
                ->groupBy('users_id')
                ->orderByRaw('count(posts) DESC')
                ->take(3)
                ->get();
        }
        else if ($element == 'subject')
        {

            $find = DB::table('posts')
                ->select(DB::raw('count(posts) as number_of_post, subject'))
                ->groupBy('subject')
                ->orderByRaw('count(posts) DESC')
                ->take(3)
                ->get();
        }
       return view('query.author', ['query_name' => $element, 'find' => $find]);
    }

}
