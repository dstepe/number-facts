<?php


namespace App\MiamiOH;


class StatApiClientNull implements StatApiClient
{
    public function incrementCount(string $source): void
    {
        // Do nothing
    }

    public function getCount(string $source): int
    {
        return 1;
    }
}