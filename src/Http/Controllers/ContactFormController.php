<?php


namespace Tetracode\Ncoder\Http\Controllers;


class ContactFormController {
    public function index()
    {
        return view('ncoder::contact')->with('encryption_key',config('ncoder.encryption_key'));
    }

    public function sendMail(Request $request)
    {
        ContactForm::create($request->all());

        return redirect(route('contact'));
    }
}
