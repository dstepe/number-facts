<?php

namespace App\Providers;

use App\MiamiOH\Repository;
use App\MiamiOH\RepositoryYaml;
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
        $repository = new RepositoryYaml(base_path() . '/' . env('DATA_DIR', 'data'));
        $this->app->instance(Repository::class, $repository);
    }
}
