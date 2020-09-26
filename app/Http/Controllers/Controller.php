<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessNumberFact;
use App\MiamiOH\NumberFact;
use App\MiamiOH\StatApiClient;
use Composer\XdebugHandler\Process;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function recordFact(NumberFact $fact): void
    {
        DB::table('facts')->insert([
            'number' => $fact->number(), 'fact' => $fact->string()
        ]);

        ProcessNumberFact::dispatch($fact);

//        Log::info(sprintf('Logged number %s with fact %s', $fact->number(), $fact->string()));
    }

    protected function incrementCountForSource(string $source): void
    {
        /** @var StatApiClient $client */
        $client = resolve(StatApiClient::class);

        $client->incrementCount($source);
    }

    protected function getCountForSource(string $source): int
    {
        /** @var StatApiClient $client */
        $client = resolve(StatApiClient::class);

        return $client->getCount($source);
    }
}
