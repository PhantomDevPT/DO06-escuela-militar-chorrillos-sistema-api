#******************* SCRIPT PARA AUTOMATIZAR LA CREACION DE REQUEST,CONTROLLER Y MODEL *******************




# Definir un array con los nombres de los requests
# $requests = @("Usuario", "Cliente", "Plataforma") #pasamos así si tenemos varias tablas que crear
# $requests = @("Netflix", "Disney", "PrimeVideo", "Crunchyroll", "HBO", "Vix", "IPTV", "Spotify", "YouTubePremium", "Viki", "ChatGPT");

$requests = @("Usuario") #poner nombre de una sola tabla

# Loop a través de cada nombre y ejecutar los comandos php artisan make:request
foreach ($name in $requests) {
    php artisan make:model "${name}"
    php artisan make:controller "API/${name}Controller"
    php artisan make:request "Registrar${name}Request"
    php artisan make:request "Actualizar${name}Request"
}

# *ÄUTHENTICATION CONTROLLLER
php artisan make:controller "AUTH/AuthController"
php artisan make:request "IniciarSesionRequest"

Write-Host "Todos los requests han sido creados."

# ********************** ANTES DE EJECUTAR EL SCRIPT **********************

# Permitir la ejecución de scripts en PowerShell:
# Set-ExecutionPolicy RemoteSigned

# ********************** EJECUTAR EL SCRIPT **********************

# Script para ejecutar el Script en PowerShell
# ./create_requests.ps1


# ********************** EJECUTAR EN UN CONTROLLER PARA QUE SE CREEN LOS METODOS NECESARIOS (CREATE, SHOW, UPDATE, DELETE) **********************
# SNIPPET: api-methods