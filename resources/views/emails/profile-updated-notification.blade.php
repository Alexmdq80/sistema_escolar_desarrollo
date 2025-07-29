@component('mail::message')
# Hola {{ $userNombre }},

Te informamos que se han realizado cambios en la información de tu perfil.

@if ($oldNombre !== $newNombre)
- **Nombre anterior:** {{ $oldNombre }}
- **Nuevo nombre:** {{ $newNombre }}
@endif

@if ($oldApellido !== $newApellido)
- **Apellido anterior:** {{ $oldApellido }}
- **Nuevo apellido:** {{ $newApellido }}
@endif

Si no fuiste tú quien realizó estos cambios, por favor, contacta a nuestro equipo de soporte inmediatamente.

También te recomendamos cambiar tu contraseña si sospechas de actividad no autorizada.

Gracias,
{{ config('app.name') }}

@endcomponent
