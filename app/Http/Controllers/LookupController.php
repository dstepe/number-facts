<?php

namespace App\Http\Controllers;

use App\MiamiOH\NumberFactDate;
use App\MiamiOH\NumberFactInteger;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    public function index()
    {
        return view('lookup');
    }

    public function lookup(Request $request)
    {
        $numberFact = new NumberFactInteger(10, '10 is the number of n-Queens Problem solutions for n = 5.');

        return view('lookup', compact('numberFact'));
    }
}
