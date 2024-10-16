<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailPayroll extends Mailable
{
    use Queueable, SerializesModels;

    public $mailMessage;
    public $subject;
    protected $pdfContent;

    /**
     * Create a new message instance.
     */
    public function __construct($message, $subject, $pdfContent = null)
    {
        $this->mailMessage = $message;
        $this->subject = $subject;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('mails.mail-template.mail')
                    ->attachData($this->pdfContent, 'slip-gaji.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
