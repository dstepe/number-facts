<?php

namespace App\Http\Controllers;

use App\Jobs\LogMessage;
use App\MiamiOH\NumberFactFinder;
use Carbon\Carbon;

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
        LogMessage::dispatchNow(sprintf('DispatchNow presented facts on %s', Carbon::now()->toDateTimeString()));

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
