<?php


namespace Tetracode\Ncoder\Http\Controllers;



use Tetracode\Ncoder\Ncoder;

class NcoderController {
    public function index()
    {
        return view('ncoder::welcome');
    }


}
