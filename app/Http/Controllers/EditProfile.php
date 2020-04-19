<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditProfile extends Controller
{
    public function index($user)
    {
        $user = User::findorFail($user);
        return view('EditProfile', ['user' => $user]);
    }
}
