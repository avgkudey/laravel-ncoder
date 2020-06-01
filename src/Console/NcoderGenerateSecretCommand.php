<?php

namespace Tetracode\Ncoder\Console;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

class NcoderGenerateSecretCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'ncoder:secret
        {--s|show : Display the key instead of modifying files.}
        {--always-no : Skip generating key if it already exists.}
        {--f|force : Skip confirmation when overwriting an existing key.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the Ncoder secret key used to Encrypt and Decrypt API payload';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
//        $key = Str::random(64);
//        $this->ncoder = \Tetracode\Ncoder\Ncoder::makeEncrypter();
//        $this->ncoder->

        $key= 'base64:'.base64_encode(
                Encrypter::generateKey( 'AES-256-CBC')
            );

        if ($this->option('show')) {
            $this->comment($key);

            return;
        }

        if (file_exists($path = $this->envPath()) === false) {
            return $this->displayKey($key);
        }

        if (Str::contains(file_get_contents($path), 'NCODER_KEY') === false) {
            // create new entry
            file_put_contents($path, PHP_EOL . "NCODER_KEY=$key" . PHP_EOL, FILE_APPEND);
        } else {
            if ($this->option('always-no')) {
                $this->comment('Secret key already exists. Skipping...');

                return;
            }

            if ($this->isConfirmed() === false) {
                $this->comment('Phew... No changes were made to your secret key.');

                return;
            }

            // update existing entry
            file_put_contents($path, str_replace(
                'NCODER_KEY=' . $this->laravel['config']['ncoder.encryption_key'],
                'NCODER_KEY=' . $key, file_get_contents($path)
            ));
        }

        $this->displayKey($key);
    }

    /**
     * Display the key.
     *
     * @param string $key
     *
     * @return void
     */
    protected function displayKey($key)
    {
        $this->laravel['config']['ncoder.encryption_key'] = $key;

        $this->info("ncoder secret [$key] set successfully.");
    }

    /**
     * Check if the modification is confirmed.
     *
     * @return bool
     */
    protected function isConfirmed()
    {
        return $this->option('force') ? true : $this->confirm(
            'This will invalidate all existing tokens. Are you sure you want to override the secret key?'
        );
    }

    /**
     * Get the .env file path.
     *
     * @return string
     */
    protected function envPath()
    {
        if (method_exists($this->laravel, 'environmentFilePath')) {
            return $this->laravel->environmentFilePath();
        }

        // check if laravel version Less than 5.4.17
        if (version_compare($this->laravel->version(), '5.4.17', '<')) {
            return $this->laravel->basePath() . DIRECTORY_SEPARATOR . '.env';
        }

        return $this->laravel->basePath('.env');
    }
}
