<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PostsController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $user = DB::table('users')->find($id);
        return view('posts', ['user' => $user]);
    }
    public function __construct()
    {
    	$this->middleware('auth');
    }


    public function store()
    {
    	//dd(request()->all());
    	$data = request()->validate(['pcaption' => 'required']);
         Auth()->user()->posts()->create($data);
         dd(request()->all());

}
}


//     $uniqueFileName = uniqid() . $request->get('upload_file')->getClientOriginalName() . '.' . $request->get('upload_file')->getClientOriginalExtension());

//     $request->get('upload_file')->move(public_path('files') . $uniqueFileName);

//     return redirect()->back()->with('success', 'File uploaded successfully.');
// }
