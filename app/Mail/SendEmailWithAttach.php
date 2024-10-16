<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Http\UploadedFile;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailWithAttach extends Mailable
{
    use Queueable, SerializesModels;

    public $mailMessage;
    public $subject;
    protected $file;
    /**
     * Create a new message instance.
     */
    public function __construct($message, $subject, UploadedFile $file = null)
    {
        $this->mailMessage = $message;
        $this->subject = $subject;
        $this->file = $file;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.mail-template.mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->file) {
            $attachments[] = Attachment::fromPath($this->file->getRealPath())
                ->as($this->file->getClientOriginalName())
                ->withMime($this->file->getMimeType());
        }

        return $attachments;
    }
}
