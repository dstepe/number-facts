<?php

namespace App\Http\Controllers;

use App\MiamiOH\NumberFact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $fact = new NumberFact(5, '5 is the number of platonic solids.');

        return view('home', compact('fact'));
    }
}
