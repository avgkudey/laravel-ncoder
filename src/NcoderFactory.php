<?php


namespace Tetracode\Ncoder;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;
use \Tetracode\Ncoder\Facades\Ncoder;

class NcoderFactory {
    protected $cipher = 'AES-256-CBC';


    public static function make()
    {
        $factory = new self;

        return new Encrypter($factory->key(), $factory->cipher);
    }
    protected function key()
    {
        $key = Ncoder::encryptionKey();
        if (Str::contains($key, 'base64:')) {
            $key = substr($key, 7);
        }

        return base64_decode($key);
    }
}