<?php


namespace Tetracode\Ncoder;


class Ncoder {
    protected $cipher = 'AES-256-CBC';

    public static function makeEncrypter() {
        $encipher = new self;
        return new \Illuminate\Encryption\Encrypter($encipher->getKey(), $encipher->cipher);
    }

    protected function getKey() {
        $key = \Tetracode\Ncoder\NcoderConfig::encryptionKey();
        if (\Illuminate\Support\Str::contains($key, 'base64:')) {
            $key = substr($key, 7);
        }
        return base64_decode($key);
    }


}