<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2019-01-01
 * Time: 13:58
 */

namespace App\MiamiOH;

class RandomNumberPhp implements RandomNumber
{
    public function generate(int $min = null, int $max = null): int
    {
        $min = $min ?? 0;
        $max = $max ?? 4096;

        return random_int($min, $max);
    }
}