<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2019-01-01
 * Time: 14:11
 */

namespace App\MiamiOH;

interface RandomNumber
{
    public function generate(int $min = null, int $max = null): int;
}
