<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;

class ProfileUpdatedNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $oldNombre;
    public $newNombre;
    public $oldApellido;
    public $newApellido;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  string  $oldNombre
     * @param  string  $newNombre
     * @param  string  $oldApellido
     * @param  string  $newApellido
     * @return void
     */
    public function __construct(Usuario $usuario, string $oldNombre, string $newNombre, string $oldApellido, string $newApellido)
    {
        $this->usuario = $usuario;
        $this->oldNombre = $oldNombre;
        $this->newNombre = $newNombre;
        $this->oldApellido = $oldApellido;
        $this->newApellido = $newApellido;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificación de cambio en tu perfil',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.profile-updated-notification', // Crea esta vista Markdown
            with: [
                'userNombre' => $this->usuario->nombre, // Nombre actual del usuario
                'oldNombre' => $this->oldNombre,
                'newNombre' => $this->newNombre,
                'oldApellido' => $this->oldApellido,
                'newApellido' => $this->newApellido,
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
