<?php


namespace Tetracode\Ncoder;


use Illuminate\Support\ServiceProvider;

class NcoderBaseServiceProvider extends ServiceProvider {

    public function boot() {

        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }

    protected function registerPublishing() {
        $this->publishes([
            __DIR__ . '/../config/ncoder.php' => config_path('ncoder.php'),
        ], 'ncoder-config');
    }


    public function register() {
    }

}
