<?php

namespace App\Http\Controllers;
use App\Models\message;
use App\User;
use Illuminate\Http\Client\Response;
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
            return view('chat', ['msg' => $fetch_msg, 'other' => $other]);
    }
    public function update($others, Request $request)
    {
        $message = new message();
        $message->users_id = Auth::id();
        $message->others_id = $others;
        $message->message = $request->input('msg');
        $message->save();
        return redirect()->route('message.person', [$others]);
    }


    /**
     * Fetch all messages
     *
     * @return message|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return string[]
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        return ['status' => 'Message Sent!'];
    }

}
