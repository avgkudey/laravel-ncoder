<?php


namespace Tetracode\Ncoder;


class Ncoder {

    public static function urlPrefix() {
        return config('ncoder.urlPrefix','ncoder');
    }
}