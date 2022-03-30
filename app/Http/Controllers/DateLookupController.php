<?php

namespace App\Http\Controllers;

use App\MiamiOH\NumberFactFinder;
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
        $month = $request->get('month');
        $day = $request->get('day');

        $dateFact = $this->factFinder->findByDayAndMonth($day, $month);

        $this->incrementCountForSource($dateFact->number());
        $dateCount = $this->getCountForSource($dateFact->number());

        return view('date-lookup', compact('dateFact', 'dateCount'));
    }
}
