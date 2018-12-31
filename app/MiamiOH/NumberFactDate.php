<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-30
 * Time: 11:01
 */

namespace App\MiamiOH;


use Carbon\Carbon;

class NumberFactDate implements NumberFact
{
    use ShowsNumberFact;

    public function __construct(int $day, int $month, string $string)
    {
        $this->setNumberString($this->convertToString($day, $month));
        $this->setFactString($string);
    }

    private function convertToString(int $day, int $month): string
    {
        $date = Carbon::createFromDate(date('y'), $month, $day);
        return $date->format('F j');
    }
}