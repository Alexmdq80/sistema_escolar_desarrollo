<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario; // Si necesitas pasar el usuario

class EmailChangedNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario; // O cualquier dato que necesites pasar

    /**
     * Create a new message instance.
     */
    public function __construct(Usuario $usuario) // O el tipo de dato que pases
    {
        $this->usuario = $usuario;
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
                'userName' => $this->usuario->nombre . ' ' . $this->usuario->apellido,
                'newEmail' => $this->usuario->email,
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
