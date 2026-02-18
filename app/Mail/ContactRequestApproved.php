<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactRequestApproved extends Mailable
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
            subject: 'Your Contact Request Has Been Approved',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.contact_request_approved',
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

