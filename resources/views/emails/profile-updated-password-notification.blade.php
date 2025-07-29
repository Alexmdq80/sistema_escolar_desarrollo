@component('mail::message')
# Hola {{ $userNombre }},

Te informamos que se han realizado cambios en la información de tu perfil.

- **LA CONTRASEÑA HA SIDO MODIFICADA.**

Si no fuiste tú quien realizó estos cambios, por favor, contacta a nuestro equipo de soporte inmediatamente.

También te recomendamos cambiar tu contraseña si sospechas de actividad no autorizada.

Gracias,
{{ config('app.name') }}

@endcomponent
