<?php


namespace Tetracode\Ncoder;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Tetracode\Ncoder\Facades\Ncoder;
class NcoderBaseServiceProvider extends ServiceProvider {

    public function boot() {

        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
        $this->registerResources();
    }

    protected function registerPublishing() {
        $this->publishes([
            __DIR__ . '/../config/ncoder.php' => config_path('ncoder.php'),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/tetracode/ncoder'),
        ], 'ncoder-config');
    }

    private function registerResources() {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ncoder');
        $this->registerFacades();
        $this->registerRoutes();
    }

    protected function registerFacades() {
        $this->app->singleton('Ncoder', function ($app) {
            return new \Tetracode\Ncoder\Ncoder();
        });
    }

    protected function registerRoutes() {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    private function routeConfiguration() {
        return [
            'prefix' => Ncoder::urlPrefix(),
            'namespace' => 'Tetracode\Ncoder\Http\Controllers'

        ];
    }

    public function register() {
    }

}
