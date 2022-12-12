<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class landingpagecontroller extends Controller
{
    public function index()
    {
        return view('landingpage');
    }
}

