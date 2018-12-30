<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $number = 5;
        $fact = '5 is the number of platonic solids.';

        return view('home', compact('number', 'fact'));
    }
}
