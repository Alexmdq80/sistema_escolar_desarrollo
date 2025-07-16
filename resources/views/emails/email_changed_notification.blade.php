@component('mail::message')
# Hola {{ $userName }},

Te informamos que la dirección de correo electrónico asociada a tu cuenta ha sido cambiada de forma exitosa a **{{ $newEmail }}**.

Si tú realizaste este cambio, puedes ignorar este correo.

Si no fuiste tú quien realizó este cambio, por favor, contacta con nosotros inmediatamente para asegurar tu cuenta.

Gracias,
{{ config('app.name') }}
@endcomponent