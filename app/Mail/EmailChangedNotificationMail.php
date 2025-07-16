<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User; // Si necesitas pasar el usuario

class EmailChangedNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // O cualquier dato que necesites pasar

    /**
     * Create a new message instance.
     */
    public function __construct(User $user) // O el tipo de dato que pases
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu dirección de correo electrónico ha sido cambiada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.email_changed_notification', // Crea esta vista Markdown
            with: [
                'userName' => $this->user->nombre . ' ' . $this->user->apellido,
                'newEmail' => $this->user->email,
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