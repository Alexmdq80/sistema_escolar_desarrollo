<x-mail::message>
# ¡Hola {{ $usuario->name }}!

Gracias por registrarte. Por favor, haz clic en el botón de abajo para verificar tu dirección de correo electrónico.

<x-mail::button :url="$verificationUrl">
Verificar Correo Electrónico
</x-mail::button>

Este enlace expirará en 60 minutos.

Si no creaste una cuenta, puedes ignorar este correo.

Gracias,<br>
Sistema de Gestión Escolar

</x-mail::message>
