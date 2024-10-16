<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SendEmailRequest;
use App\Http\Requests\SendEmailAttachRequest;
use App\Mail\SendEmailWithAttach;

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

    public function indexWithAttach()
    {
        return view('mails.form-send-mail-attach');
    }

    public function sendEmailWithAttachment(SendEmailAttachRequest $request)
    {
        try {
            $toEmail = $request->email;
            $name = $request->name;
            $message = "Hi $name, {$request->message}";
            $subject = $request->subject;
            $file = $request->file('file');

            Mail::to($toEmail)->send(new SendEmailWithAttach($message, $subject, $file));

            return response()->json(['message' => 'Mail has been sent!'], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Mail not sent!'], 500);
        }
    }
}
