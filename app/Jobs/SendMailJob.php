<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\SendEmailPayroll;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $emails;
    public $names;
    public $messageTemplate;
    public $subject;

    /**
     * Create a new job instance.
     */
    public function __construct(array $emails, array $names, string $messageTemplate, string $subject)
    {
        $this->emails = $emails;
        $this->names = $names;
        $this->messageTemplate = $messageTemplate;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (count($this->emails) !== count($this->names)) {
            return;
        }

        foreach ($this->emails as $index => $toEmail) {
            $name = $this->names[$index];
            $message = "Hi $name, {$this->messageTemplate}";

            // Generate PDF content for each email
            $pdfContent = $this->generatePayrollSlip($name);

            // Send the email using queue
            Mail::to($toEmail)->send(new SendEmailPayroll($message, $this->subject, $pdfContent));
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
