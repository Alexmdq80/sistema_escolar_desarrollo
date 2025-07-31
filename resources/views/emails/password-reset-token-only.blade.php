@component('mail::message')
# Hola {{ $userName }},

Estás recibiendo este correo porque hemos recibido una solicitud de restablecimiento de contraseña para tu cuenta.

Por favor, utiliza el siguiente código para restablecer tu contraseña en tu aplicación.

Copia el siguiente código y pégalo en el campo correspondiente de la aplicación:

## {{ $token }}

Este código de restablecimiento de contraseña es válido por {{ config('auth.passwords.users.expire') }} minutos.

Si no solicitaste un restablecimiento de contraseña, no se requiere ninguna acción adicional.

Gracias,
{{ config('app.name') }}
@endcomponent
