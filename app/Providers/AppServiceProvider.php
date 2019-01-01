<?php

namespace App\Providers;

use App\MiamiOH\RandomNumber;
use App\MiamiOH\RandomNumberEnv;
use App\MiamiOH\RandomNumberPhp;
use App\MiamiOH\Repository;
use App\MiamiOH\RepositoryRest;
use App\MiamiOH\RepositoryYaml;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

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
    }
}
