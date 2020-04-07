<?php


namespace Tetracode\Ncoder;


use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

class Ncoder {
    protected $cipher = 'AES-256-CBC';

    public static function urlPrefix() {
        return "config('ncoder.urlPrefix', 'ncoder')";
    }

    public static function encryptionKey() {
        return config('ncoder.encryption_key', 'base64:egGf2oTpKV5EYrRFv8gm6wJAf8mQP4gZ0tAdtDoGWJ4=');
    }

    public static function makeEncrypter()
    {
        $encipher = new self;
        return new Encrypter($encipher->key(), $encipher->cipher);
    }
    protected function key()
    {
        $key = $this->encryptionKey();
        if (Str::contains($key, 'base64:')) {
            $key = substr($key, 7);
        }
        return base64_decode($key);
    }
}