<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class firstpageController extends Controller
{
   public function index () 
    {
    return view('firstpage');
    }
}
