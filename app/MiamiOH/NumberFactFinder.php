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
    /**
     * @var RandomNumber
     */
    private $randomNumber;

    public function __construct(Repository $repository, RandomNumber $randomNumber)
    {
        $this->repository = $repository;
        $this->randomNumber = $randomNumber;
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

    public function findRandomIntegerFact(): NumberFact
    {
        $number = $this->randomNumber->generate();

        $fact = $this->repository->lookupNumberMathFact($number);

        return new NumberFactInteger($number, $fact->text());
    }
}
