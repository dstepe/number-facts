<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-30
 * Time: 11:01
 */

namespace App\MiamiOH;


class NumberFact
{
    /**
     * @var int
     */
    private $number;
    /**
     * @var string
     */
    private $string;

    public function __construct(int $number, string $string)
    {
        $this->number = $number;
        $this->string = $string;
    }

    public function number(): int
    {
        return $this->number;
    }

    public function string(): string
    {
        return $this->string;
    }
}