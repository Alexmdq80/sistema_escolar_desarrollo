<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $token; // El token es lo único que necesitamos aquí

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  string  $token  El token de restablecimiento de contraseña
     * @return void
     */
    public function __construct(Usuario $usuario, string $token)
    {
        $this->usuario = $usuario;
        $this->token = $token;
        // La URL de restablecimiento ya no se genera aquí, solo el token.
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu código para restablecer tu contraseña', //
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.password-reset-token-only', // Nueva vista Markdown
            with: [
                'userName' => $this->usuario->name,
                'token' => $this->token, // Pasar el token a la vista
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
