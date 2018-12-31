<?php

namespace App\Http\Controllers;

use App\MiamiOH\NumberFactDate;
use App\MiamiOH\NumberFactInteger;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $numberFact = new NumberFactInteger(5, '5 is the number of platonic solids.');
        $dateFact = new NumberFactDate(15, 10, 'October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.');

        return view('home', compact('numberFact', 'dateFact'));
    }
}
