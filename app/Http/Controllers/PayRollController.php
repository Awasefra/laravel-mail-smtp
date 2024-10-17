<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use App\Mail\SendEmailPayroll;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SendPayrollEmailRequest;

class PayRollController extends Controller
{
    public function index()
    {
        return view('payrolls.form-payroll');
    }

    public function send(SendPayrollEmailRequest $request)
    {
        try {
            $toEmail = $request->email;
            $name = $request->name;
            $message = "Hi $name, {$request->message}";
            $subject = $request->subject;

            $pdfContent = $this->generatePayrollSlip($name);

            Mail::to($toEmail)->send(new SendEmailPayroll($message, $subject, $pdfContent));

            return response()->json(['message' => 'Mail has been sent!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Mail not sent! ' . $e->getMessage()], 500);
        }
    }

    private function generatePayrollSlip($name)
    {
        $data = [
            'employee_name' => $name,
            'position' => 'Staff IT',
            'basic_salary' => 8000000,
            'allowance' => 500000,
            'deduction' => 200000,
        ];

        $pdf = PDF::loadView('payrolls.slip-gaji', $data);
        return $pdf->output();
    }
}
