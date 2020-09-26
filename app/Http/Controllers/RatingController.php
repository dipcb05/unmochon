<?php

use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
}
