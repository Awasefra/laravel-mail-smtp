<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SendEmailRequest;
use App\Http\Requests\SendEmailAttachRequest;

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
            $name = $request->name;
            $message = "Hi $name, {$request->message}";
            $subject = $request->subject;

            Mail::to($toEmail)->send(new SendEmail($message, $subject));

            return response()->json(['message' => 'Mail has been sent!'], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Mail not sent!'], 500);
        }
    }
}
