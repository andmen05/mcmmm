# MCMMM - Sistema de Gestión de Ventas

**MCMMM** es un sistema desarrollado en Laravel para la administración de productos, clientes, ventas y categorías. El objetivo principal del sistema es automatizar y simplificar la gestión comercial para pequeñas o medianas empresas.

## 🚀 Funcionalidades

- 📦 Gestión de productos (crear, editar, eliminar, buscar y filtrar)
- 📁 Clasificación por categorías
- 🧾 Registro de ventas con múltiples productos
- 👥 Gestión de clientes
- 📊 Panel de estadísticas (en desarrollo)
- 🔒 Autenticación de usuarios con Laravel Breeze


## ⚙️ Requisitos

- PHP >= 8.1
- Composer
- Node.js y npm
- MySQL o SQLite
- Laravel 10+

## 🛠 Instalación

1. Clona este repositorio:

   ```bash
   git clone https://github.com/tu-usuario/mcmmm.git
   cd mcmmm

2. Instala las dependencias de PHP:

   composer install

3. Instala las dependencias de JavaScript

   npm install && npm run dev

4. Crea el archivo .env:

   cp .env.example .env

5. Configura la base de datos en el archivo .env:

   DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mcmmm
DB_USERNAME=root
DB_PASSWORD=

6. Genera la clave de la aplicación y ejecuta migraciones:

   php artisan key:generate
   php artisan migrate

7. (Opcional) Si usas Breeze

   php artisan breeze:install
   npm run dev

8. Inicia el servidor

   php artisan serve


   ## 📦 Base de Datos

Puedes descargar la base de datos desde este repositorio:  
👉 [Descargar mcmmm.sql](./mcmmm.sql)

Luego impórtala en phpMyAdmin para tener los datos completos del sistema.

   
👨‍💻 Autores
Desarrollado por: andres mendez

Universidad: FESC - Facultad de Ingeniería

Año: 2025

📃 Licencia
Este proyecto es de uso académico. Puedes modificarlo libremente para uso educativo.





