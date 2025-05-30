# Laundry Website (Laravel 12)

This is a modern laundry service management system built with Laravel 12. It includes a customer-facing interface and a robust admin dashboard to manage bookings, services, and revenue.

---

## 📂 Features

### ✨ User Features:
- Book laundry services online
- View booking status
- Contact form

### 🛠️ Admin Features:
- Dashboard with booking statistics and revenue tracking
- Manage all laundry bookings
- Manage services offered
- View urgent and today’s pickups
- Export booking data
- Filter and search through bookings

---

## 🧰 Tech Stack
- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Bootstrap, custom CSS
- **Database**: MySQL
- **Charts**: Chart.js or ApexCharts (optional)

---

## 🚀 Getting Started

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/laundry-app.git
cd laundry-app
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run dev
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with your database and mail credentials.

### 4. Setup Database
Create a new MySQL database (e.g., `laundry_db`), then:

#### Option A: Use Migrations
```bash
php artisan migrate
```

#### Option B: Import Backup SQL
1. Open your MySQL tool (phpMyAdmin or CLI)
2. Create a database `laundry_db`
3. Import the file at `database/backup/db.sql`

---

## 🔐 Admin Login

- **URL**: `/admin/login`
- **Username**: `babdav25@gmail.com`
- **Password**: `password123`

---

## 📊 Admin Dashboard Includes:
- Total bookings
- Pending, Confirmed, Completed, and Cancelled counts
- Today’s pickups
- Urgent bookings
- Weekly booking chart
- Estimated weekly revenue

---

## 📁 Folder Structure Overview

```
laundry-app/
├── app/
│   └── Http/
│       ├── Controllers/
│       │   └── AdminController.php
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── bookings.blade.php
├── database/
│   ├── migrations/
│   └── backup/
│       └── db.sql
```

---

## 🛠 Artisan Commands

Run Laravel's built-in server:
```bash
php artisan serve
```

Clear configuration cache:
```bash
php artisan config:clear
php artisan cache:clear
```

---

## 📬 Contact
For support, reach out via [balaaadhamu45@gmail.com](mailto:balaaadhamu45@gmail.com) or create an issue on GitHub.

---

## 📄 License
MIT License. Feel free to use and modify.
