<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactRequestApprovedOwner extends Mailable
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
            subject: 'Someone Wants to Contact Your Business 📩',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.contact_request_approved_owner',
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
