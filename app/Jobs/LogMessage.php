<?php

namespace App\Jobs;

use AG\ElasticApmLaravel\Facades\ApmCollector;
use AG\ElasticApmLaravel\Jobs\Middleware\RecordTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LogMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        ApmCollector::startMeasure('log-message', 'job', 'log');
        sleep(1);
        Log::info($this->message);
//        ApmCollector::stopMeasure('log-message');
    }

    public function middleware()
    {
        Log::debug('Setting job middleware for ' . self::class);
        return [
            new RecordTransaction()
        ];
    }
}
