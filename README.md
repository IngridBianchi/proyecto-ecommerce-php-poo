
# Tienda de Camisetas - Proyecto PHP POO

Este proyecto es una tienda en línea desarrollada en PHP utilizando el paradigma de Programación Orientada a Objetos (POO). La aplicación permite gestionar productos, categorías, usuarios, pedidos y un carrito de compras, siguiendo el patrón de diseño MVC (Modelo-Vista-Controlador).

## 🚀 Características

- **Gestión de usuarios**: Registro, inicio de sesión y roles (usuario y administrador).
- **Gestión de productos**: Crear, editar, eliminar y listar productos.
- **Gestión de categorías**: Crear y listar categorías.
- **Carrito de compras**: Añadir, eliminar y actualizar productos en el carrito.
- **Gestión de pedidos**: Crear pedidos, ver detalles y gestionar estados de pedidos.
- **Diseño responsivo**: Interfaz de usuario básica con HTML y CSS.

---

## 📂 Estructura del Proyecto

.
├── .htaccess                # Configuración de URLs amigables
├── autoload.php             # Autocargador de controladores
├── config/                  # Configuración del proyecto
│   ├── db.php               # Conexión a la base de datos
│   ├── parameters.php       # Parámetros globales
├── controllers/             # Controladores del proyecto
│   ├── carritoController.php
│   ├── categoriaController.php
│   ├── errorController.php
│   ├── pedidoController.php
│   ├── productoController.php
│   └── usuarioController.php
├── database/                # Archivos relacionados con la base de datos
│   └── database.sql         # Script SQL para inicializar la base de datos
├── helpers/                 # Funciones y utilidades
│   └── utils.php
├── models/                  # Modelos del proyecto
│   ├── categoria.php
│   ├── pedido.php
│   ├── producto.php
│   └── usuario.php
├── views/                   # Vistas del proyecto
│   ├── carrito/
│   ├── categoria/
│   ├── layout/
│   ├── pedido/
│   ├── producto/
│   └── usuario/
├── assets/                  # Archivos estáticos
│   ├── css/                 # Estilos CSS
│   └── img/                 # Imágenes
├── uploads/                 # Archivos subidos (imágenes de productos)
│   └── images/
├── Dockerfile               # Configuración del contenedor Docker
├── docker-compose.yml       # Configuración de servicios Docker
├── index.php                # Punto de entrada principal
└── README.md                # Documentación del proyecto

---

## 🛠️ Tecnologías Utilizadas

- **Backend**: PHP 7.4
- **Base de datos**: MySQL 5.7
- **Frontend**: HTML5, CSS3
- **Servidor web**: Apache (con `mod_rewrite` habilitado)
- **Contenerización**: Docker y Docker Compose

---

## ⚙️ Configuración del Entorno

### 1. Requisitos previos
- Docker y Docker Compose instalados en tu sistema.

### 2. Clonar el repositorio

git clone <URL_DEL_REPOSITORIO>
cd proyecto-php-poo


### 3. Construir y levantar los contenedores

docker-compose up --build


### 4. Acceder a la aplicación
Abre tu navegador y accede a:  

http://localhost:8080


---

## 🗄️ Base de Datos

El archivo `database/database.sql` contiene el script para inicializar la base de datos. Este script se ejecuta automáticamente al levantar el contenedor MySQL.

### Tablas principales:
- **usuarios**: Información de los usuarios registrados.
- **categorias**: Categorías de productos.
- **productos**: Información de los productos.
- **pedidos**: Pedidos realizados por los usuarios.
- **lineas_pedidos**: Detalles de los productos en cada pedido.

---

## 🛒 Funcionalidades

### Usuarios
- Registro de nuevos usuarios.
- Inicio de sesión y cierre de sesión.
- Roles: usuario estándar y administrador.

### Productos
- Listar productos destacados.
- Ver detalles de un producto.
- Crear, editar y eliminar productos (solo administradores).

### Categorías
- Listar categorías.
- Crear nuevas categorías (solo administradores).

### Carrito de Compras
- Añadir productos al carrito.
- Actualizar cantidades de productos.
- Eliminar productos del carrito.
- Vaciar el carrito.

### Pedidos
- Crear un pedido con los productos del carrito.
- Ver detalles de un pedido.
- Gestionar el estado de los pedidos (solo administradores).

---

### Problemas con imágenes
- Verifica que las imágenes estén en la carpeta `uploads/images/`.
- Asegúrate de que los permisos de la carpeta sean correctos:
  
  chmod -R 755 uploads/images
 

### Problemas con Docker
- Si la base de datos no se inicializa correctamente, reinicia los contenedores:
 
  docker-compose down
  docker-compose up --build
 

---

## 📜 Licencia

Este proyecto es de uso libre para fines educativos y personales. No se permite su uso comercial sin autorización previa.

---

## ✨ Autor

Desarrollado por **Ingrid Bianchi** en PHP POO.  
¡Gracias por visitar este proyecto! 😊