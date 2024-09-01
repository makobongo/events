<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendClientMail extends Mailable
{
    use Queueable, SerializesModels;

    private $client;
    private $file_path;

    private $img;

    /**
     * Create a new message instance.
     */
    public function __construct($client, $filePath, $img)
    {
        $this->client = $client;
        $this->file_path = $filePath;
        $this->img = $img;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'data'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.client',
            with: ['first_name' => $this->client['first_name'], 'last_name' => $this->client['last_name'], 'phone' => $this->client['phone'], 'number_of_ticket' => $this->client['number_of_ticket'], 'name_of_ticket' => $this->client['name_of_ticket'], 'ticket_cost' => $this->client['ticket_cost'],'img'=>$this->img],
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
            Attachment::fromPath($this->file_path),
        ];
    }
}
