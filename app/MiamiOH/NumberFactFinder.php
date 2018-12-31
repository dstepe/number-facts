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
}
