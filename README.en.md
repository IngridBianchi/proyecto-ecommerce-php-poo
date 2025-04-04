# T-Shirt Store - PHP OOP Project

This project is an online store developed in PHP using Object-Oriented Programming (OOP) paradigm. The application allows managing products, categories, users, orders, and a shopping cart, following the MVC (Model-View-Controller) design pattern.

## 🚀 Features

- **User management**: Registration, login, and roles (user and administrator).
- **Product management**: Create, edit, delete, and list products.
- **Category management**: Create and list categories.
- **Shopping cart**: Add, remove, and update products in the cart.
- **Order management**: Create orders, view details, and manage order statuses.
- **Responsive design**: Basic user interface with HTML and CSS.

---

## 📂 Project Structure

```
.
├── .htaccess                # Friendly URLs configuration
├── autoload.php             # Controller autoloader
├── config/                  # Project configuration
│   ├── db.php               # Database connection
│   ├── parameters.php       # Global parameters
├── controllers/             # Project controllers
│   ├── carritoController.php
│   ├── categoriaController.php
│   ├── errorController.php
│   ├── pedidoController.php
│   ├── productoController.php
│   └── usuarioController.php
├── database/                # Database-related files
│   └── database.sql         # SQL script to initialize the database
├── helpers/                 # Functions and utilities
│   └── utils.php
├── models/                  # Project models
│   ├── categoria.php
│   ├── pedido.php
│   ├── producto.php
│   └── usuario.php
├── views/                   # Project views
│   ├── carrito/
│   ├── categoria/
│   ├── layout/
│   ├── pedido/
│   ├── producto/
│   └── usuario/
├── assets/                  # Static files
│   ├── css/                 # CSS styles
│   └── img/                 # Images
├── uploads/                 # Uploaded files (product images)
│   └── images/
├── Dockerfile               # Docker container configuration
├── docker-compose.yml       # Docker services configuration
├── index.php                # Main entry point
└── README.md                # Project documentation
```

---

## 🛠️ Technologies Used

- **Backend**: PHP 7.4
- **Database**: MySQL 5.7
- **Frontend**: HTML5, CSS3
- **Web server**: Apache (with `mod_rewrite` enabled)
- **Containerization**: Docker and Docker Compose

---

## ⚙️ Environment Setup

### 1. Prerequisites
- Docker and Docker Compose installed on your system.

### 2. Clone the repository

```bash
git clone <REPOSITORY_URL>
cd php-oop-project
```

### 3. Build and start the containers

```bash
docker-compose up --build
```

### 4. Access the application
Open your browser and go to:

```
http://localhost:8080
```

---

## 🗄️ Database

The `database/database.sql` file contains the script to initialize the database. This script runs automatically when the MySQL container is started.

### Main tables:
- **usuarios**: Information about registered users.
- **categorias**: Product categories.
- **productos**: Product information.
- **pedidos**: Orders made by users.
- **lineas_pedidos**: Details of products in each order.

---

## 🛒 Functionalities

### Users
- Register new users.
- Login and logout.
- Roles: standard user and administrator.

### Products
- List featured products.
- View product details.
- Create, edit, and delete products (administrators only).

### Categories
- List categories.
- Create new categories (administrators only).

### Shopping Cart
- Add products to the cart.
- Update product quantities.
- Remove products from the cart.
- Empty the cart.

### Orders
- Create an order with the products in the cart.
- View order details.
- Manage order statuses (administrators only).

---

### Image Issues
- Ensure images are in the `uploads/images/` folder.
- Verify that the folder permissions are correct:

  ```bash
  chmod -R 755 uploads/images
  ```

### Docker Issues
- If the database does not initialize correctly, restart the containers:

  ```bash
  docker-compose down
  docker-compose up --build
  ```

---

## 📜 License

This project is free for educational and personal use. Commercial use is not permitted without prior authorization.

---

## ✨ Author

Developed by **Ingrid Bianchi** in PHP OOP.
Thank you for visiting this project! 😊

---