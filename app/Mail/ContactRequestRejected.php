<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactRequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $contactRequest;

    public function __construct($contactRequest)
    {
        $this->contactRequest = $contactRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Update on Your Contact Request',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.contact_request_rejected',
            with: [
                'contactRequest' => $this->contactRequest,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}