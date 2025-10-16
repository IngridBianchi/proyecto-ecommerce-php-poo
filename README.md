# 👕 Tienda de Camisetas - Proyecto PHP con MVC

¡Bienvenido! Este proyecto es una tienda online de camisetas desarrollada desde cero en **PHP puro**, aplicando el paradigma de **Programación Orientada a Objetos (POO)** y la arquitectura **Modelo-Vista-Controlador (MVC)**. Es una demostración práctica de cómo estructurar una aplicación web robusta y mantenible sin depender de frameworks.

## ✨ Características Principales

*   **🛒 Carrito de Compras:** Funcionalidad completa para añadir, ver y gestionar productos en el carrito.
*   **👤 Gestión de Usuarios:** Sistema de registro y login con roles (Cliente y Administrador).
*   **📦 Sistema de Pedidos:** Los usuarios pueden finalizar compras y consultar su historial de pedidos.
*   **⚙️ Panel de Administración:**
    *   Gestión de Productos (CRUD).
    *   Gestión de Categorías.
    *   Administración de Pedidos.
*   **📐 Arquitectura MVC:** Código organizado, desacoplado y fácil de mantener.
*   **🚀 URLs Amigables:** Rutas limpias y semánticas gracias al controlador frontal y `mod_rewrite`.

## 🛠️ Stack Tecnológico

*   **Backend:** PHP 7.4
*   **Base de Datos:** MySQL 5.7
*   **Servidor Web:** Apache 2.4 (con `mod_rewrite` habilitado)
*   **Frontend:** HTML5 y CSS3 (puro, sin frameworks)
*   **Contenerización:** Docker y Docker Compose para un entorno de desarrollo consistente.

## 🚀 Cómo Empezar (Entorno Local)

Este proyecto está configurado para ejecutarse fácilmente en cualquier máquina con Docker.

### 1. Requisitos Previos

*   Tener [Docker](https://www.docker.com/get-started) y [Docker Compose](https://docs.docker.com/compose/install/) instalados.

### 2. Instalación

1.  **Clona el repositorio:**
    ```bash
    git clone https://github.com/IngridBianchi/proyecto-ecommerce-php-poo.git
    cd tu-repositorio
    ```

2.  **Construye y levanta los contenedores:**
    Este comando creará y configurará el servidor Apache/PHP y la base de datos MySQL.
    ```bash
    docker-compose up --build
    ```

3.  **¡Listo! Accede a la aplicación:**
    Abre tu navegador web y visita:
    > **http://localhost:8080**

### 🗄️ Sobre la Base de Datos

El script `database/database.sql` se ejecuta **automáticamente** la primera vez que se levanta el contenedor de la base de datos, creando todas las tablas y datos necesarios para que la aplicación funcione.

## 📂 Estructura del Proyecto

El proyecto sigue una estructura MVC clara para separar responsabilidades:

```
.
├── config/         # Ficheros de configuración (BBDD, parámetros).
├── controllers/    # Lógica de negocio y coordinación.
├── models/         # Clases que interactúan con la base de datos.
├── views/          # Plantillas HTML que conforman la UI.
├── assets/         # CSS, imágenes y fuentes.
├── helpers/        # Funciones de utilidad (ej. gestión del carrito).
├── uploads/        # Directorio para imágenes de productos.
├── .htaccess       # Reglas de reescritura para URLs amigables.
├── autoload.php    # Carga automática de clases.
├── index.php       # Controlador frontal (punto de entrada único).
└── docker-compose.yml # Orquestación del entorno de desarrollo.
```
