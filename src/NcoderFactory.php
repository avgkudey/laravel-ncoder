<?php


namespace Tetracode\Ncoder;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

class NcoderFactory {
    protected $cipher = 'AES-256-CBC';


    public static function make()
    {
        $factory = new self;

        return new Encrypter($factory->key(), $factory->cipher);
    }
    protected function key()
    {
        $key = \Tetracode\Ncoder\Facades\Ncoder::encryptionKey();
        if (Str::contains($key, 'base64:')) {
            $key = substr($key, 7);
        }

        return base64_decode($key);
    }
}