<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-30
 * Time: 11:01
 */

namespace App\MiamiOH;


class NumberFactInteger implements NumberFact
{
    use ShowsNumberFact;

    public function __construct(int $number, string $string)
    {
        $this->setNumberString((string) $number);
        $this->setFactString($string);
    }
}