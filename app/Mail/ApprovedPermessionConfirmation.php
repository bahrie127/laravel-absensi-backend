<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovedPermessionConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public  $user;
    public    $date;
    public    $reason;
    /**
     * Create a new message instance.
     */
    public function __construct(
        $user,
        $date,
        $reason,
    )
    {
        $this->user = $user;
        $this->date = $date;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Approved Permession Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.approved-permession-confirmation',
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

    public function build()
    {
        return $this->markdown('emails.approved-permession-confirmation')
        ->subject('Approved Permession '. $this->user->name)
        ->with([
            'user' => $this->user,
            'date' => $this->date,
            'reason' => $this->reason
        ]);
    }
}
