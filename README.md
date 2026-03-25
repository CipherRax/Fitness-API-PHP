# 🏋️ Fitness Management API

A modern, RESTful API for gym management built with **Laravel 11**, **Sanctum**, and **Supabase (PostgreSQL)**. This system handles user registration, role-based access control, class bookings, and trainer attendance tracking.

---

## 🛠️ Tech Stack
- **Framework:** Laravel 11
- **Database:** PostgreSQL (via Supabase Transaction Pooler)
- **Authentication:** Laravel Sanctum (Bearer Tokens)
- **Environment:** Optimized for Arch Linux / Linux systems

---

## ⚙️ Installation & Setup

### 1. Clone & Install
```bash
git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
cd your-repo-name
composer install# 🏋️ Fitness Management API

A modern, RESTful API for gym management built with **Laravel 11**, **Sanctum**, and **Supabase (PostgreSQL)**. This system handles user registration, role-based access control, class bookings, and trainer attendance tracking.

---

## 🛠️ Tech Stack
- **Framework:** Laravel 11
- **Database:** PostgreSQL (via Supabase Transaction Pooler)
- **Authentication:** Laravel Sanctum (Bearer Tokens)
- **Environment:** Optimized for Arch Linux / Linux systems

---

## ⚙️ Installation & Setup

### 1. Clone & Install
```bash
git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
cd your-repo-name
composer install


```

## Environment configuration
```bash
DB_CONNECTION=pgsql
DB_HOST=aws-1-eu-west-1.pooler.supabase.com  # Use your specific pooler host
DB_PORT=6543
DB_DATABASE=postgres
DB_USERNAME=postgres.your_project_id
DB_PASSWORD="your_database_password"
DB_SSLMODE=prefer

SESSION_DRIVER=file

```

## Database Migrations
```bash
php artisan migrate
#The API will be available at http://localhost:8000/api
