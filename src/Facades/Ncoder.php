<?php


namespace Tetracode\Ncoder\Facades;


use Illuminate\Support\Facades\Facade;

class Ncoder extends Facade {

    protected static function getFacadeAccessor() {
        return 'Ncoder';
    }
}