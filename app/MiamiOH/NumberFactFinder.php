<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 11:00
 */

namespace App\MiamiOH;

use Carbon\Carbon;
use Nipwaayoni\ElasticApmLaravel\Apm\EventTimer;

class NumberFactFinder
{
    /**
     * @var Repository
     */
    private $repository;
    /**
     * @var RandomNumber
     */
    private $randomNumber;
    /**
     * @var EventTimer
     */
    private $eventTimer;

    public function __construct(Repository $repository, RandomNumber $randomNumber, EventTimer $eventTimer)
    {
        $this->repository = $repository;
        $this->randomNumber = $randomNumber;
        $this->eventTimer = $eventTimer;
    }

    public function findByInteger(int $number): NumberFact
    {
        $event = $this->eventTimer->begin('Look up number math fact');
        $fact = $this->repository->lookupNumberMathFact($number);
        $this->eventTimer->finish($event);

        return new NumberFactInteger($number, $fact->text());
    }

    public function findByDayAndMonth(int $day, int $month): NumberFact
    {
        $event = $this->eventTimer->begin('Look up date fact');
        $fact = $this->repository->lookupDateFact($day, $month);
        $this->eventTimer->finish($event);

        return new NumberFactDate($day, $month, $fact->text());
    }

    public function findRandomIntegerFact(): NumberFact
    {
        $number = $this->randomNumber->generate();

        $event = $this->eventTimer->begin('Look up number math fact');
        $fact = $this->repository->lookupNumberMathFact($number);
        $this->eventTimer->finish($event);

        return new NumberFactInteger($number, $fact->text());
    }

    public function findCurrentDateFact(): NumberFact
    {
        $today = Carbon::now();

        $day = $today->day;
        $month = $today->month;

        $event = $this->eventTimer->begin('Look up date fact');
        $fact = $this->repository->lookupDateFact($day, $month);
        $this->eventTimer->finish($event);

        return new NumberFactDate($day, $month, $fact->text());
    }
}
