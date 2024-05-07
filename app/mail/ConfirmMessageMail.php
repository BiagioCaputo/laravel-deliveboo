<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $customer_address;
    public $customer_name;
    public $final_price;
    /**
     * Create a new message instance.
     */
    public function __construct($sender, $customer_address, $customer_name, $final_price)
    {
        $this->sender = $sender;
        $this->customer_address = $customer_address;
        $this->customer_name = $customer_name;
        $this->final_price = $final_price;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'team4@esempio.com',
            replyTo: $this->sender,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.confirm_payment.message',
            with: ['customer_address' => $this->customer_address, 'customer_name' => $this->customer_name, 'final_price' => $this->final_price],
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
