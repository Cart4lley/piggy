# PIGGY Banking System - Database Setup Guide

## Option 1: Using XAMPP (Recommended for Windows)

### 1. Install XAMPP
- Download XAMPP from: https://www.apachefriends.org/
- Install and start Apache and MySQL services

### 2. Create Database via phpMyAdmin
- Open: http://localhost/phpmyadmin
- Click "New" to create a database
- Database name: `piggy_bank`
- Collation: `utf8mb4_unicode_ci`
- Click "Create"

### 3. Update Laravel Configuration
Your `.env` file is already configured for MySQL:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=piggy_bank
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations
```powershell
cd "C:\Users\Aldrid\Documents\PIGGY"
php artisan config:clear
php artisan migrate:fresh
```

## Option 2: Using MySQL Workbench

### 1. Install MySQL Community Server
- Download from: https://dev.mysql.com/downloads/mysql/
- Install with default settings
- Remember your root password

### 2. Create Database
- Open MySQL Workbench
- Connect to local instance
- Run: `CREATE DATABASE piggy_bank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`

### 3. Update .env
If you set a password during MySQL installation, update:
```
DB_PASSWORD=your_mysql_password_here
```

### 4. Run Migrations
```powershell
php artisan migrate:fresh
```

## Quick Start Commands

After setting up MySQL database:

```powershell
# Clear Laravel configuration cache
php artisan config:clear

# Create all tables (fresh migration)
php artisan migrate:fresh

# Start Laravel server
php artisan serve

# Test the system
# Visit: http://localhost:8000/status
# Visit: http://localhost:8000/simple-test
```

## Troubleshooting

### Error: "SQLSTATE[HY000] [1049] Unknown database 'piggy_bank'"
- Make sure you created the `piggy_bank` database
- Check database name spelling in `.env`

### Error: "SQLSTATE[HY000] [2002] No connection could be made"
- Make sure MySQL service is running
- Check XAMPP control panel or Services

### Error: "Access denied for user 'root'@'localhost'"
- Check your DB_PASSWORD in `.env`
- Default XAMPP MySQL has no password for root

## Next Steps After Database Setup

1. **Test Registration**: http://localhost:8000/simple-test
2. **Create Test Account**: http://localhost:8000/test-accounts
3. **View System Status**: http://localhost:8000/status
4. **Test Login**: http://localhost:8000/test-login