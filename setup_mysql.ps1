# PIGGY Banking System - MySQL Setup Script
# Run this script to set up MySQL database for PIGGY

Write-Host "🐷 PIGGY Banking System - MySQL Setup" -ForegroundColor Magenta
Write-Host "=====================================" -ForegroundColor Magenta
Write-Host ""

# Check if MySQL is installed and accessible
Write-Host "1. Checking MySQL installation..." -ForegroundColor Yellow
try {
    $mysqlVersion = mysql --version
    Write-Host "   ✅ MySQL found: $mysqlVersion" -ForegroundColor Green
} catch {
    Write-Host "   ❌ MySQL not found in PATH. Please install MySQL or add it to your PATH." -ForegroundColor Red
    Write-Host "   📥 Download MySQL from: https://dev.mysql.com/downloads/mysql/" -ForegroundColor Blue
    exit 1
}

Write-Host ""
Write-Host "2. Creating PIGGY database..." -ForegroundColor Yellow

# Prompt for MySQL root password
$rootPassword = Read-Host "   Enter MySQL root password (press Enter if no password)" -AsSecureString
$plainPassword = [System.Runtime.InteropServices.Marshal]::PtrToStringAuto([System.Runtime.InteropServices.Marshal]::SecureStringToBSTR($rootPassword))

# Create database
Write-Host "   Creating database 'piggy_bank'..." -ForegroundColor Cyan
try {
    if ($plainPassword) {
        mysql -u root -p"$plainPassword" -e "CREATE DATABASE IF NOT EXISTS piggy_bank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; USE piggy_bank; SELECT 'PIGGY database created successfully!' as status;"
    } else {
        mysql -u root -e "CREATE DATABASE IF NOT EXISTS piggy_bank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; USE piggy_bank; SELECT 'PIGGY database created successfully!' as status;"
    }
    Write-Host "   ✅ Database 'piggy_bank' created successfully!" -ForegroundColor Green
} catch {
    Write-Host "   ❌ Failed to create database. Please check your MySQL credentials." -ForegroundColor Red
    Write-Host "   💡 You can also run the SQL manually:" -ForegroundColor Blue
    Write-Host "      mysql -u root -p < setup_mysql.sql" -ForegroundColor Gray
    exit 1
}

Write-Host ""
Write-Host "3. Running Laravel migrations..." -ForegroundColor Yellow
try {
    php artisan config:clear
    php artisan migrate:fresh
    Write-Host "   ✅ Database tables created successfully!" -ForegroundColor Green
} catch {
    Write-Host "   ❌ Migration failed. Please check your .env configuration." -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "🎉 PIGGY Banking System MySQL setup complete!" -ForegroundColor Green
Write-Host ""
Write-Host "📋 Database Details:" -ForegroundColor Cyan
Write-Host "   Database: piggy_bank" -ForegroundColor Gray
Write-Host "   Host: 127.0.0.1:3306" -ForegroundColor Gray
Write-Host "   Username: root" -ForegroundColor Gray
Write-Host ""
Write-Host "🚀 Next steps:" -ForegroundColor Blue
Write-Host "   1. Start the Laravel server: php artisan serve" -ForegroundColor Gray
Write-Host "   2. Test registration: http://localhost:8000/simple-test" -ForegroundColor Gray
Write-Host "   3. View status: http://localhost:8000/status" -ForegroundColor Gray
Write-Host ""