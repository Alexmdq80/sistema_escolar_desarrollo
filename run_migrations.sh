## este script corre las migraciones necesarias para
## refactorizar la BD hacia las convenciones laravel.
## y corre los seeders para corregir la BD de localidades,
## y armar la tabla modalidad_nivel, escuela_modalidad_nivel
# Mostrar un mensaje y esperar una respuesta del usuario
echo "Este proceso ejecutará las migraciones para refactorizar la BD a las convenciones de Laravel, y correrá dos seeders para poblar la tabla escuela_modalidad_nivel, y otro para corregir las localidades."
read -p "¿Quieres comenzar el proceso? (y/n): " respuesta

# Convertir la respuesta a minúsculas y verificar si es 'y'
if [[ "$(echo $respuesta | tr '[:upper:]' '[:lower:]')" == "y" ]]; then

    echo "Iniciando las migraciones de la FASE 1..."
    php artisan migrate

    # Verifica si la migración de la fase 1 fue exitosa
    if [ $? -eq 0 ]; then
        echo "FASE 1 completada. Corriendo el seeder..."
        php artisan db:seed --class=ModalidadNivelSeeder

        # Verifica si el seeder fue exitoso
        if [ $? -eq 0 ]; then
            echo "Seeder completado. Continuando con las migraciones de la FASE 2..."
            php artisan migrate --path=database/migrations/after_create_escuela_modalidad_nivel

            echo "¡Proceso de migración y seeder terminado!"
            if [ $? -eq 0 ]; then
                php artisan db:seed --class=CorregirLocalidadsSeeder
                if [ $? -eq 0 ]; then
                    echo "Seeder de localidades completado."
                else
                    echo "¡Error al correr el seeder de localidades! Deteniendo el proceso."
                fi
            else
                echo "¡Error en las migraciones de la FASE 2! Deteniendo el proceso."
            fi
        else
            echo "¡Error al correr el seeder! Deteniendo el proceso."
        fi
    else
        echo "¡Error en las migraciones de la FASE 1! Deteniendo el proceso."
    fi

else
    echo "Proceso cancelado por el usuario."
fi
