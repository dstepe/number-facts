<?php


namespace App\MiamiOH;


interface StatApiClient
{
    public function incrementCount(string $source): void;

    public function getCount(string $source): int;
}