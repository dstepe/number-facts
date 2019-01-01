<?php

namespace App\Http\Controllers;

use App\MiamiOH\NumberFactDate;
use App\MiamiOH\NumberFactFinder;
use App\MiamiOH\NumberFactInteger;
use Illuminate\Http\Request;

class DateLookupController extends Controller
{
    /**
     * @var NumberFactFinder
     */
    private $factFinder;

    public function __construct(NumberFactFinder $factFinder)
    {
        $this->factFinder = $factFinder;
    }

    public function index()
    {
        return view('date-lookup');
    }

    public function lookup(Request $request)
    {
        $number = $request->get('number');

        $numberFact = $this->factFinder->findByInteger($number);

        return view('date-lookup', compact('numberFact'));
    }
}
