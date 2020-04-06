<?php


namespace Tetracode\Ncoder\Http\Controllers;


class ContactFormController {
    public function index()
    {
        return view('ncoder::contact')->with('encription_key',config('ncoder.encription_key'));
    }

    public function sendMail(Request $request)
    {
        ContactForm::create($request->all());

        return redirect(route('contact'));
    }
}
