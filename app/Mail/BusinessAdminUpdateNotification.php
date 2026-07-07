<?php

namespace App\Mail;

use App\Models\GmeBusinessForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

/**
 * Sent whenever an admin edits a business profile's details.
 * Lists every changed field with its old value and new value.
 *
 * This is COMPLETELY INDEPENDENT of the status-approval email
 * (BusinessStatusUpdated). It fires purely based on whether any
 * editable field (other than status) changed - it does not know
 * or care whether the status also changed in the same request.
 *
 * NOT queued on purpose: sent synchronously from the controller so the
 * admin's loading overlay stays up until the e-mail attempt finishes.
 */
class BusinessAdminUpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    public GmeBusinessForm $business;
    public array $changes;
    public array $imageChanges;

    /**
     * @param GmeBusinessForm $business
     * @param array $changes       Array of ['field' => ..., 'old' => ..., 'new' => ...]
     * @param array $imageChanges  Array of ['field' => ..., 'old_url' => ..., 'new_url' => ...]
     */
    public function __construct(GmeBusinessForm $business, array $changes, array $imageChanges = [])
    {
        $this->business     = $business;
        $this->changes      = $changes;
        $this->imageChanges = $imageChanges;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Business Profile Was Updated - ' . $this->business->business_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.business-admin-update',
            with: [
                'business'     => $this->business,
                'changes'      => $this->changes,
                'imageChanges' => $this->imageChanges,
            ],
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