<?php

namespace App\Http\Controllers;

use App\MiamiOH\NumberFactDate;
use App\MiamiOH\NumberFactFinder;
use App\MiamiOH\NumberFactInteger;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $numberFact = $this->factFinder->findRandomIntegerFact();
        $this->recordFact($numberFact);

        $this->incrementCountForSource($numberFact->number());
        $numberCount = $this->getCountForSource($numberFact->number());

        $dateFact = $this->factFinder->findCurrentDateFact();

        $this->recordFact($dateFact);

        $this->incrementCountForSource($dateFact->number());
        $dateCount = $this->getCountForSource($dateFact->number());

        return view('home', compact('numberFact', 'dateFact', 'numberCount', 'dateCount'));
    }
}
