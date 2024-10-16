<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index()
    {
        return view('mails.form-send-mail');
    }

    public function sendEmail(SendEmailRequest $request)
    {
        try {
            $toEmail = $request->email;
            $message = `Hi $request->name, $request->message`;
            $subject = $request->subject;

            Mail::to($toEmail)->send(new SendEmail($message, $subject));

            return response()->json(['message' => 'Mail has been sent!'], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Mail not sent!'], 500);
        }
    }
}
