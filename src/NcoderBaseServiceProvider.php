<?php


namespace Tetracode\Ncoder;


use Illuminate\Support\ServiceProvider;

class NcoderBaseServiceProvider extends ServiceProvider {

    protected $commands = [
        'Tetracode\Ncoder\Console\NcoderGenerateSecretCommand',
    ];

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
        $this->commands($this->commands);

    }

}
