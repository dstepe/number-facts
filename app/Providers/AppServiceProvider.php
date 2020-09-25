<?php

namespace App\Providers;

use AG\ElasticApmLaravel\AgentBuilder;
use App\MiamiOH\RandomNumber;
use App\MiamiOH\RandomNumberEnv;
use App\MiamiOH\RandomNumberPhp;
use App\MiamiOH\Repository;
use App\MiamiOH\RepositoryRest;
use App\MiamiOH\RepositoryYaml;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Nipwaayoni\Config;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('REPOSITORY') === 'YAML') {
            $repository = new RepositoryYaml(base_path() . '/' . env('DATA_DIR', 'data'));
        } else {
            $repository = new RepositoryRest(new Client());
        }

        $this->app->instance(Repository::class, $repository);

        if (App::runningUnitTests()) {
            $randomNumber = new RandomNumberEnv();
        } else {
            $randomNumber = new RandomNumberPhp();
        }

        $this->app->instance(RandomNumber::class, $randomNumber);

        $this->app->bind(AgentBuilder::class, function () {
            $builder = new AgentBuilder();

            $builder->withPreCommitCallback(function (RequestInterface $request) {
                Log::info(sprintf('Pre commit url is: %s', $request->getUri()), ['request' => $request->getBody()->getContents()]);
            });

            $builder->withPostCommitCallback(function (?ResponseInterface $response, \Throwable $e = null) {
                if (null === $response) {
                    Log::error('Failed sending to apm: ', ['exception' => $e->getMessage()]);
                    return;
                }

                Log::info(sprintf('Post commit response status: %s', $response->getStatusCode()));
                Log::debug('APM response', ['content' => $response->getBody()->getContents()]);

                if ($response->getStatusCode() === 202) {
                    return;
                }

                Log::debug($response->getBody()->getContents());
            });

            return $builder;
        });
    }
}
