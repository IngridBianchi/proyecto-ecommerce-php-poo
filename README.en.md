# 👕 T-Shirt Shop - PHP Project with MVC

Welcome! This project is an online T-shirt shop developed from scratch in **pure PHP**, applying the **Object-Oriented Programming (OOP)** paradigm and the **Model-View-Controller (MVC)** architecture. It's a practical demonstration of how to structure a robust and maintainable web application without relying on frameworks.

## ✨ Key Features

*   **🛒 Shopping Cart:** Full functionality to add, view, and manage products in the cart.
*   **👤 User Management:** Registration and login system with roles (Customer and Admin).
*   **📦 Order System:** Users can complete purchases and view their order history.
*   **⚙️ Admin Panel:**
    *   Product Management (CRUD).
    *   Category Management.
    *   Order Management.
*   **📐 MVC Architecture:** Organized, decoupled, and easy-to-maintain code.
*   **🚀 Friendly URLs:** Clean and semantic routes thanks to the front controller and `mod_rewrite`.

## 🛠️ Tech Stack

*   **Backend:** PHP 7.4
*   **Database:** MySQL 5.7
*   **Web Server:** Apache 2.4 (with `mod_rewrite` enabled)
*   **Frontend:** HTML5 & CSS3 (pure, no frameworks)
*   **Containerization:** Docker and Docker Compose for a consistent development environment.

## 🚀 Getting Started (Local Environment)

This project is configured to run easily on any machine with Docker.

### 1. Prerequisites

*   Have [Docker](https://www.docker.com/get-started) and [Docker Compose](https://docs.docker.com/compose/install/) installed.

### 2. Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/IngridBianchi/proyecto-ecommerce-php-poo.git
    cd your-repository
    ```

2.  **Build and run the containers:**
    This command will create and configure the Apache/PHP server and the MySQL database.
    ```bash
    docker-compose up --build
    ```

3.  **Done! Access the application:**
    Open your web browser and visit:
    > **http://localhost:8080**

### 🗄️ About the Database

The `database/database.sql` script runs **automatically** the first time the database container is started, creating all the necessary tables and data for the application to work.

## 📂 Project Structure

The project follows a clear MVC structure to separate concerns:

```
.
├── config/         # Configuration files (DB, parameters).
├── controllers/    # Business logic and coordination.
├── models/         # Classes that interact with the database.
├── views/          # HTML templates that make up the UI.
├── assets/         # CSS, images, and fonts.
├── helpers/        # Utility functions (e.g., cart management).
├── uploads/        # Directory for product images.
├── .htaccess       # Rewrite rules for friendly URLs.
├── autoload.php    # Automatic class loading.
├── index.php       # Front controller (single entry point).
└── docker-compose.yml # Development environment orchestration.
```
