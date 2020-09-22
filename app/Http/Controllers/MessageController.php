<?php

namespace App\Http\Controllers;
use App\Models\message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index($other)
    {
       // , ['others_id', '=', $other]
        if($other != Auth::id()) {
            $fetch_msg = DB::table('messages')
                ->join('users', 'messages.users_id', '=', 'users.id')
                ->select('messages.*', 'users.name')
                ->where('users_id', '=', Auth::id())
                ->where('others_id', '=', $other)
                ->orWhere('users_id', '=', $other)
                ->where('others_id', '=', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
            if ($fetch_msg == '[]')
                $fetch_msg = null;
            return view('chat.chat', ['msg' => $fetch_msg, 'other' => $other]);
        }
        else echo 'can not self message';
    }
    public function update($others, Request $request)
    {
        $message = new message();
        $message->users_id = Auth::id();
        $message->others_id = $others;
        $message->message = $request->input('msg');
        $message->save();
        $user = User::find(Auth::id());
        return redirect()->route('message.person', [$others]);
    }
}
