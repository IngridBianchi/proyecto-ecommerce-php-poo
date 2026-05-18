# 🚀 Tienda E-Commerce Moderna (Refactorización Profesional PHP)

[![Versión PHP](https://img.shields.io/badge/php-%3E%3D%208.2-8892bf.svg?style=flat-square)](http://php.net/)
[![Versión MySQL](https://img.shields.io/badge/mysql-%3E%3D%208.0-4479a1.svg?style=flat-square)](https://www.mysql.com/)
[![Arquitectura](https://img.shields.io/badge/arquitectura-MVC%20+%20Repository-blue.svg?style=flat-square)](#-evolución-arquitectónica)
[![Seguridad](https://img.shields.io/badge/seguridad-OWASP%20Aligned-red.svg?style=flat-square)](#-enfoque-en-seguridad)

Este proyecto es una modernización integral de una aplicación de comercio electrónico académica heredada. Se ha transformado de un código procedimental a una **arquitectura de grado de producción** siguiendo estándares modernos (PSR), principios SOLID y prácticas avanzadas de seguridad.

---

## 🏗️ Evolución Arquitectónica

El núcleo de este proyecto es la transición de un modelo de "Controladores Pesados" a una **arquitectura multicapa**, garantizando mantenibilidad y escalabilidad.

-   **Patrón Front Controller**: Un único punto de entrada (`public/index.php`) gestiona todas las peticiones, proporcionando un sistema de enrutamiento seguro y centralizado.
-   **Autoloading PSR-4**: Uso de Composer para la carga de clases compatible con estándares, eliminando sentencias `require` manuales.
-   **Capa de Acceso a Datos (Patrón Repository)**: La lógica SQL está desacoplada de la lógica de negocio. Los repositorios gestionan la persistencia de datos usando **PDO** y **Sentencias Preparadas**.
-   **Capa de Servicios**: La lógica de negocio compleja (Autenticación, cálculos del Carrito) está encapsulada en servicios dedicados.
-   **Modelos de Dominio**: Objetos PHP puros que representan entidades de negocio, enfocados estrictamente en la estructura de datos.

### Estructura del Proyecto (Estándar PSR)
```bash
src/
├── Config/         # Singleton de Base de Datos y Entorno
├── Controllers/    # Controladores Delgados (Solo Petición/Respuesta)
├── Models/         # Entidades de Dominio
├── Repositories/   # Capa de Acceso a Datos (PDO)
├── Services/       # Capa de Lógica de Negocio
└── Utils/          # Helpers de Seguridad, Carrito y CSRF
public/             # Raíz del Documento (Assets, Punto de Entrada)
templates/          # Capa de Vista en PHP Puro (Separada de la Lógica)
```

---

## 🛡️ Enfoque en Seguridad

La seguridad no se trató como un añadido, sino como un requisito fundamental:

-   **Prevención de SQL Injection**: Migración del 100% de `mysqli` a **Sentencias Preparadas de PDO**. Tolerancia cero a la concatenación de consultas.
-   **Mitigación de XSS**: Implementación de una utilidad de escape global (`Security::e()`) aplicada a todo el contenido generado por el usuario en la capa de vista.
-   **Protección CSRF**: Validación basada en tokens implementada para todas las peticiones que cambian el estado (POST/PUT/DELETE).
-   **Autenticación Segura**: Contraseñas hasheadas usando `password_hash()` con sales modernas gestionadas automáticamente (estándares de PHP 8.2).
-   **Integridad del Entorno**: Credenciales sensibles gestionadas mediante archivos `.env`, manteniendo los secretos fuera del código fuente.

---

## ⚡ Stack Técnico

-   **Backend**: PHP 8.2 (Tipado estricto habilitado)
-   **Base de Datos**: MySQL 8.0
-   **Infraestructura**: Docker + Docker Compose (Configuración multi-contenedor)
-   **Frontend**: CSS puro con Flexbox/Grid para una interfaz responsiva y estética "Rock-style".
-   **Dependencias**: Composer (PHP Dotenv, PHPUnit ready).

---

## 🛠️ Inicio Rápido

### Requisitos
- Docker y Docker Compose
- Composer

### Instalación
1.  **Clonar el repositorio**:
    ```bash
    git clone https://github.com/vparr/proyecto-ecommerce-php-poo.git
    cd proyecto-ecommerce-php-poo
    ```
2.  **Instalar dependencias**:
    ```bash
    composer install
    # O mediante Docker si no tienes composer local:
    docker run --rm -v ${PWD}:/app composer install
    ```
3.  **Configuración de Entorno**:
    ```bash
    cp .env.example .env
    ```
4.  **Lanzar la aplicación**:
    ```bash
    docker-compose up -d --build
    ```
5.  **Acceso**: Visita `http://localhost:8080`

---

## 🎯 Puntos Clave 

-   **Experiencia en Refactorización**: Migración exitosa de un código legado a una arquitectura moderna con namespaces.
-   **Programación Defensiva**: Fuerte enfoque en validación de entradas, protección CSRF/XSS y manejo seguro de datos.
-   **Código Limpio**: Adherencia a los estándares de codificación PSR-12 y principios DRY (Don't Repeat Yourself).
-   **Mentalidad DevOps**: Entorno de desarrollo contenedorizado para un comportamiento consistente en cualquier máquina.

---
*Desarrollado con ❤️ y enfoque en la excelencia técnica por Ingrid Bianchi.*
