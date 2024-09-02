<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $client;
    // protected $status;
    protected $attachedFile;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $filePath)
    {
        $this->client = $data;
        // $this->status = $status;
        $this->attachedFile = $filePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: env('APP_NAME')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.email',
            with: ['first_name' => $this->client['first_name'],'last_name' => $this->client['last_name'],'number_of_ticket' => $this->client['number_of_ticket'],'ticket_cost' => $this->client['ticket_cost'],'phone' => $this->client['phone']],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->attachedFile),
        ];
    }
}
