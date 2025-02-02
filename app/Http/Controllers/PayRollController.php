<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;
use App\Mail\SendEmailPayroll;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Http\Requests\SendPayrollEmailRequest;
use App\Http\Requests\SendPayrollBatchEmailRequest;

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

    public function indexBatch()
    {
        return view('payrolls.form-payroll-batch');
    }

    public function sendBatch(SendPayrollBatchEmailRequest $request)
    {
        
        try {
            // Validate array lengths
            if (
                count($request->emails) !== count($request->names) ||
                count($request->emails) !== count($request->salaries) ||
                count($request->emails) !== count($request->allowances)
            ) {
                return response()->json(['message' => 'The number of emails, names, salaries, and allowances must match.'], 400);
            } 
            // Dispatch the job
            dispatch(new SendMailJob(
                $request->division,
                $request->emails,
                $request->names,
                $request->salaries,
                $request->allowances,
                $request->message,
                $request->subject
            ));
            return response()->json(['message' => 'Mail has been sent!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Mail not sent! ' . $e->getMessage()], 500);
        }
    }
}
