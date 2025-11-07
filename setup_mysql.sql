-- PIGGY Banking System - MySQL Database Setup
-- Run this script in your MySQL client to create the database

-- Create the database
CREATE DATABASE IF NOT EXISTS piggy_bank 
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;

-- Create a dedicated user for the application (optional, but recommended)
-- CREATE USER 'piggy_user'@'localhost' IDENTIFIED BY 'piggy_password_123';
-- GRANT ALL PRIVILEGES ON piggy_bank.* TO 'piggy_user'@'localhost';
-- FLUSH PRIVILEGES;

-- Use the database
USE piggy_bank;

-- Show that the database is ready
SELECT 'PIGGY Bank database created successfully!' as status;