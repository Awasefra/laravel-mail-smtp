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

    public $division;
    public $emails;
    public $names;
    public $salaries;
    public $allowances;
    public $messageTemplate;
    public $subject;

    /**
     * Create a new job instance.
     */
    public function __construct(string $division, array $emails, array $names, array $salaries, array $allowances, string $messageTemplate, string $subject)
    {
        $this->division = $division;
        $this->emails = $emails;
        $this->names = $names;
        $this->salaries = $salaries;
        $this->allowances = $allowances;
        $this->messageTemplate = $messageTemplate;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (count($this->emails) !== count($this->names) || count($this->emails) !== count($this->salaries) || count($this->emails) !== count($this->allowances)) {
            return;
        }

        foreach ($this->emails as $index => $toEmail) {
            $name = $this->names[$index];
            $salary = $this->salaries[$index];
            $allowance = $this->allowances[$index];
            $message = "Hi $name, {$this->messageTemplate}";
            // Generate PDF content for each email
            $pdfContent = $this->generatePayrollSlip($this->division, $name, $salary, $allowance);

            // Send the email using queue
            Mail::to($toEmail)->send(new SendEmailPayroll($message, $this->subject, $pdfContent));
        }
    }

    private function generatePayrollSlip($division, $name, $salary, $allowance)
    {
        $data = [
            'employee_name' => $name,
            'position' => $division,
            'basic_salary' => $salary,
            'allowance' => $allowance,
            'deduction' => 0.02 * ($salary + $allowance),
        ];

        $pdf = PDF::loadView('payrolls.slip-gaji', $data);
        return $pdf->output();
    }
}
