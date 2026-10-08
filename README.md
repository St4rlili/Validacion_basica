# Sistema de Validación y Registro en MongoDB

Este proyecto es una aplicación web en PHP que recibe los datos de un formulario de registro, aplica filtros de validación básicos (expresiones regulares) y almacena la información de forma segura en una base de datos de **MongoDB Atlas**. Todo el entorno se ejecuta sobre contenedores **Docker**.

## Requisitos Previos

Antes de arrancar el proyecto, asegúrate de tener instalado en tu máquina:
* [Docker Desktop](https://docker.com)
* Una cuenta en [MongoDB Atlas](https://mongodb.com) con un clúster activo.

## Instalación y Configuración

Sigue estos pasos para levantar el proyecto en tu entorno local:

### 1. Clonar el repositorio
```bash
git clone https://github.com
cd tu-repositorio
```

### 2. Configurar las Variables de Entorno
Duplica el archivo de ejemplo y renómbralo:
```bash
cp docker-compose.example.yml docker-compose.yml
```
Abre el nuevo archivo `docker-compose.yml` y reemplaza el valor de `MONGO_URI` con la cadena de conexión real de tu clúster de MongoDB.

### 3. Levantar los contenedores e instalar dependencias
Ejecuta el siguiente comando para compilar e iniciar el servidor web Apache con PHP 8.2:
```bash
docker compose up -d --build
```

Una vez que el contenedor esté corriendo, instala la librería oficial de MongoDB a través de Composer ejecutando:
```bash
docker compose exec servidor-php composer install
```

## Uso de la Aplicación

Una vez completada la instalación, abre tu navegador web e ingresa a:
[http://localhost:8080](http://localhost:8080)

* **`index.php`**: Contiene el formulario de registro.
* **`resultado.php`**: Muestra las alertas de éxito o los errores de validación recuperados de la sesión de PHP.