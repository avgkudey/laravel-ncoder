<?php


namespace Tetracode\Ncoder\Http\Controllers;


use Tetracode\Ncoder\Facades\Ncoder;

class NcoderController {
    public function index()
    {
//        return view('ncoder::welcome');
        return Ncoder::encryptionKey().'dsdsd';
    }


}
