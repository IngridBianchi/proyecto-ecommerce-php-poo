# 🚀 Modern E-Commerce Store (Pure PHP Overhaul)

[![PHP Version](https://img.shields.io/badge/php-%3E%3D%208.2-8892bf.svg?style=flat-square)](http://php.net/)
[![MySQL Version](https://img.shields.io/badge/mysql-%3E%3D%208.0-4479a1.svg?style=flat-square)](https://www.mysql.com/)
[![Architecture](https://img.shields.io/badge/architecture-MVC%20+%20Repository-blue.svg?style=flat-square)](#-architectural-evolution)
[![Security](https://img.shields.io/badge/security-OWASP%20Aligned-red.svg?style=flat-square)](#-security-first-approach)

This project is a comprehensive modernization of a legacy academic PHP e-commerce application. It has been transformed from a procedural-style codebase into a **production-grade architecture** following modern standards (PSR), SOLID principles, and advanced security practices.

---

## 🏗️ Architectural Evolution

The core of this project is the transition from a "Fat Controller" model to a **multi-layered architecture**, ensuring maintainability and scalability.

-   **Front Controller Pattern**: A single entry point (`public/index.php`) manages all requests, providing a secure and centralized routing system.
-   **PSR-4 Autoloading**: Leveraging Composer for standard-compliant class loading, eliminating manual `require` statements.
-   **Data Access Layer (Repository Pattern)**: SQL logic is decoupled from business logic. Repositories manage data persistence using **PDO** and **Prepared Statements**.
-   **Service Layer**: Complex business logic (Authentication, Cart calculations) is encapsulated in dedicated services.
-   **Domain Models**: Clean PHP objects representing business entities, focused strictly on data structure.

### Project Structure (PSR Standard)
```bash
src/
├── Config/         # Environment & Database Singleton
├── Controllers/    # Slim Controllers (Request/Response only)
├── Models/         # Domain Entities
├── Repositories/   # Data Access Layer (PDO)
├── Services/       # Business Logic Layer
└── Utils/          # Security, Cart, and CSRF Helpers
public/             # Document Root (Assets, Entry Point)
templates/          # Pure PHP View Layer (Separated from Logic)
```

---

## 🛡️ Security-First Approach

Security was not treated as an afterthought, but as a core requirement:

-   **SQL Injection Prevention**: 100% migration from `mysqli` to **PDO Prepared Statements**. Zero tolerance for raw query concatenation.
-   **XSS Mitigation**: Implementation of a global escaping utility (`Security::e()`) applied to all user-generated content in the view layer.
-   **CSRF Protection**: Token-based validation implemented for all state-changing requests (POST/PUT/DELETE).
-   **Secure Authentication**: Passwords hashed using `password_hash()` with modern, automatically managed salts (PHP 8.2 standards).
-   **Environmental Integrity**: Sensitive credentials managed via `.env` files, keeping secrets out of the codebase.

---

## ⚡ Technical Stack

-   **Backend**: PHP 8.2 (Strict types enabled)
-   **Database**: MySQL 8.0
-   **Infrastructure**: Docker + Docker Compose (Multi-container setup)
-   **Frontend**: Vanilla CSS with Flexbox/Grid for a responsive, "Rock-style" UI.
-   **Dependencies**: Composer (PHP Dotenv, PHPUnit ready).

---

## 🛠️ Quick Start

### Prerequisites
- Docker & Docker Compose
- Composer

### Installation
1.  **Clone the repository**:
    ```bash
    git clone https://github.com/vparr/proyecto-ecommerce-php-poo.git
    cd proyecto-ecommerce-php-poo
    ```
2.  **Install dependencies**:
    ```bash
    composer install
    # Or via Docker if you don't have composer local:
    docker run --rm -v ${PWD}:/app composer install
    ```
3.  **Environment Setup**:
    ```bash
    cp .env.example .env
    ```
4.  **Launch the application**:
    ```bash
    docker-compose up -d --build
    ```
5.  **Access**: Visit `http://localhost:8080`

---

## 🎯 Portfolio Highlights

-   **Refactoring Expertise**: Successfully migrated a legacy codebase to a modern, namespaced architecture.
-   **Defensive Programming**: Strong focus on input validation, CSRF/XSS protection, and secure data handling.
-   **Clean Code**: Adherence to PSR-12 coding standards and DRY (Don't Repeat Yourself) principles.
-   **DevOps Mindset**: Containerized development environment for consistent behavior across machines.

---
*Developed with ❤️ and focus on engineering excellence by Ingrid Bianchi.*

