<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;


    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        // Genera una URL firmada para la verificación
        // Aquí usamos una URL con el token que guardaste en el usuario
        // Asegúrate de que 'verification.verify' sea el nombre de tu ruta de API para verificar
       if (empty($user->verification_token)) {
            // Esto no debería ocurrir si lo asignaste en RegisterController
            // Considera lanzar una excepción o loggear un error
            \Log::error('User has no verification token when trying to send email!', ['user_id' => $user->id]);
            // Si el token es null, esto causará el error.
            // Podrías generar uno aquí temporalmente para probar,
            // pero lo ideal es que venga del RegisterController.
            $user->verification_token = Str::random(60); // ¡Solo para depuración si no se genera antes!
        }

        $this->verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $this->user->id, // Usa $this->user->id para referirte al ID del usuario
                'token' => $this->user->verification_token // Usa $this->user->verification_token para el token
            ]
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verifica tu dirección de correo electrónico',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.verify', // La vista Markdown
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
