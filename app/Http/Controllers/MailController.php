<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\MailRequest;

use Mail;

use App\Mail\Mailito;

class MailController extends Controller
{
    public function send(MailRequest $request){
        $mailRequest = $request->validated();
        
        Mail::to('hichamghoutani52@gmail.com')->send(new Mailito($mailRequest));
    }
}
