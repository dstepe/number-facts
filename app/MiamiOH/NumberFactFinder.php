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
    public function findByInteger(int $number): NumberFact
    {
        switch ($number) {
            case 5:
                $fact = '5 is the number of platonic solids.';
                break;

            case 10:
                $fact = '10 is the number of n-Queens Problem solutions for n = 5.';
                break;
        }

        return new NumberFactInteger($number, $fact);
    }

    public function findByDayAndMonth(int $day, int $month): NumberFact
    {
        switch ($month) {
            case 10:
                $fact = 'October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.';
                break;

            case 4:
                $fact = 'April 3rd is the day in 1981 that the Osborne 1, the first successful portable computer, is unveiled at the West Coast Computer Faire in San Francisco.';
                break;
        }

        return new NumberFactDate($day, $month, $fact);
    }
}
