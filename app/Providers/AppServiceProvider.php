<?php

namespace App\Providers;

use AG\ElasticApmLaravel\AgentBuilder;
use App\MiamiOH\RandomNumber;
use App\MiamiOH\RandomNumberEnv;
use App\MiamiOH\RandomNumberPhp;
use App\MiamiOH\Repository;
use App\MiamiOH\RepositoryRest;
use App\MiamiOH\RepositoryYaml;
use App\MiamiOH\StatApiClient;
use App\MiamiOH\StatApiClientNull;
use App\MiamiOH\StatApiClientRest;
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
        if (!empty($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], '/api') === 0) {
            putenv('ELASTIC_APM_SERVICE_NAME=Number Facts API');
        }

        if (env('REPOSITORY') === 'YAML') {
            $repository = new RepositoryYaml(base_path() . '/' . env('DATA_DIR', 'data'));
        } else {
            $repository = new RepositoryRest(new Client());
        }

        $this->app->instance(Repository::class, $repository);

        if (App::runningUnitTests()) {
            $randomNumber = new RandomNumberEnv();
            $statApiClient = new StatApiClientNull();
        } else {
            $randomNumber = new RandomNumberPhp();
            $statApiClient = new StatApiClientRest(new Client([
                'base_uri' => 'https://nginx',
                'verify' => false,
            ]));
        }

        $this->app->instance(RandomNumber::class, $randomNumber);
        $this->app->instance(StatApiClient::class, $statApiClient);

        $this->app->bind(AgentBuilder::class, function () {
            $builder = new AgentBuilder();

            $builder->withHttpClient(new \Http\Adapter\Guzzle6\Client(new Client()));

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
