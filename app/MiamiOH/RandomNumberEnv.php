<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2019-01-01
 * Time: 13:58
 */

namespace App\MiamiOH;

class RandomNumberEnv implements RandomNumber
{
    public function generate(int $min = null, int $max = null): int
    {
        return env('RANDOM_NUMBER', 5);
    }
}
