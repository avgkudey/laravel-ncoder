<?php


namespace Tetracode\Ncoder;


class Ncoder {

    public  function urlPrefix() {
        return "config('ncoder.urlPrefix', 'ncoder')";
//        return config('ncoder.urlPrefix', 'ncoder');
    }

    public  function encryptionKey() {
        return config('ncoder.encryption_key', 'base64:egGf2oTpKV5EYrRFv8gm6wJAf8mQP4gZ0tAdtDoGWJ4=');
    }
}