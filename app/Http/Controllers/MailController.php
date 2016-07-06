<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Mail;

class MailController extends Controller
{
    public function index()
    {
        $check = "i'm here to check something.";
        return view('contact')->with('check',$check);
    }

    public function send()
    {
        $identity = Input::get('identity');
        $email = Input::get('email');
        $company = Input::get('company');
        $purpose = Input::get('purpose');
        $comment = Input::get('message');

        $data = ['identity'=>$identity,'email'=>$email,'company'=>$company,'purpose'=>$purpose,'comment'=>$comment];

        Mail::send('email',$data, function($message) use($identity, $email, $company, $purpose, $comment ) {
            $message->to(['cabinet.pierre.schmidt@orange.fr', 'cabinetschmidt.crolles@gmail.com']);
            $message->subject($purpose);
        });

        if(Mail::failures()){
            return false;    
        }
    }
}
