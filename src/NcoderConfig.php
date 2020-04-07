<?php


namespace Tetracode\Ncoder;


class NcoderConfig {



    public static function encryptionKey() {
        return config('ncoder.encryption_key', 'base64:MBp8ntcfFJfdhHWInJ/lUwVtgNl4WNQY+h0Pin6B7WM=');
    }
}