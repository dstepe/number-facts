<?php

namespace App\Jobs;

use App\MiamiOH\NumberFact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessNumberFact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var NumberFact
     */
    private $fact;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(NumberFact $fact)
    {
        $this->fact = $fact;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug(sprintf('Processed fact for %s: %s', $this->fact->number(), $this->fact->string()));
    }

    public function middleware()
    {
        return [
            app(\AG\ElasticApmLaravel\Jobs\Middleware\RecordTransaction::class),
        ];
    }
}
