<?php


namespace Tetracode\Ncoder;


use Illuminate\Support\ServiceProvider;

class NcoderBaseServiceProvider extends ServiceProvider {

    public function boot() {

        if ($this->app->runningInConsole()){
            $this->registerPublishing();
        }

        $this->registerResources();
    }

    public function register() {
    }

    private function registerResources() {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    protected function registerPublishing() {
        $this->publishes([
            __DIR__.'/../config/ncoder.php'=>config_path('ncoder.php'),
            __DIR__.'/../resources/views'=> resource_path('views/vendor/tetracode/ncoder'),
        ],'ncoder-config');
    }

}
