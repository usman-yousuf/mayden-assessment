<?php

namespace App\Mail;

use App\Models\ShoppingList;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShoppingListShareMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ShoppingList $shoppingList)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shared Shopping List: ' . $this->shoppingList->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.shopping-list-share',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
