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

}
