<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 11:41
 */

namespace App\MiamiOH;

interface Repository
{
    public function lookupNumberMathFact(int $number): NumberFactDataTransferObject;
    public function lookupDateFact(int $day, int $month): NumberFactDataTransferObject;
}
