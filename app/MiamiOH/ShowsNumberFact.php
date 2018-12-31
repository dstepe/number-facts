<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-30
 * Time: 11:01
 */

namespace App\MiamiOH;


trait ShowsNumberFact
{
    /**
     * @var string
     */
    private $number;
    /**
     * @var string
     */
    private $string;

    private function setNumberString(string $numberString): void
    {
        $this->number = $numberString;
    }

    public function number(): string
    {
        return $this->number;
    }

    private function setFactString(string $factString): void
    {
        $this->string = $factString;
    }

    public function string(): string
    {
        return $this->string;
    }
}