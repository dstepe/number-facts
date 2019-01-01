<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 11:00
 */

namespace App\MiamiOH;

class NumberFactFinder
{
    /**
     * @var Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function findByInteger(int $number): NumberFact
    {
        $fact = $this->repository->lookupNumberMathFact($number);

        return new NumberFactInteger($number, $fact->text());
    }

    public function findByDayAndMonth(int $day, int $month): NumberFact
    {
        $fact = $this->repository->lookupDateFact($day, $month);

        return new NumberFactDate($day, $month, $fact->text());
    }
}
