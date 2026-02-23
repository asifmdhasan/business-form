<?php

namespace App\Mail;

use App\Models\GmeBusinessForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BusinessCreatedMailforDirectory extends Mailable
{
    use Queueable, SerializesModels;

    public $business;

    /**
     * Create a new message instance.
     */
    public function __construct(GmeBusinessForm $business)
    {
        $this->business = $business;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: 'Your business has been submitted successfully ' . $this->business->business_name,
            subject: 'A new business has been submitted successfully ' ,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.directory_notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
