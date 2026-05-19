-- ====================================
-- DATABASE: sentra
-- PURPOSE: Sentra Event Management System
-- CHARSET: utf8mb4
-- ====================================

-- Create Database (if not exists)
CREATE DATABASE IF NOT EXISTS `sentra` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sentra`;

-- ====================================
-- TABLE 1: USERS
-- Menyimpan data pengguna terdaftar
-- ====================================
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Unik Pengguna',
  `name` VARCHAR(255) NOT NULL COMMENT 'Nama Pengguna',
  `email` VARCHAR(255) UNIQUE NOT NULL COMMENT 'Email Unik Pengguna',
  `password` VARCHAR(255) NOT NULL COMMENT 'Password terenkripsi (bcrypt)',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Waktu akun dibuat',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Waktu akun terakhir diupdate',
  
  INDEX idx_email (email) COMMENT 'Index untuk query by email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ====================================
-- TABLE 2: POSTS
-- Menyimpan postingan/event
-- ====================================
CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Unik Postingan',
  `title` VARCHAR(255) NOT NULL COMMENT 'Judul Postingan/Event',
  `content` LONGTEXT NOT NULL COMMENT 'Isi Postingan/Deskripsi Event',
  `user_id` INT NOT NULL COMMENT 'ID Pembuat Postingan',
  `image_path` VARCHAR(255) NULL COMMENT 'Path ke gambar banner event (relative path)',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Waktu postingan dibuat',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Waktu postingan terakhir diupdate',
  
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  INDEX idx_user_id (user_id) COMMENT 'Index untuk query by user_id',
  INDEX idx_created_at (created_at) COMMENT 'Index untuk sorting by created_at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ====================================
-- TABLE 3: REGISTRATIONS
-- Menyimpan data pendaftaran peserta event
-- ====================================
CREATE TABLE IF NOT EXISTS `registrations` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Unik Registrasi',
  `event_id` INT NOT NULL COMMENT 'ID Event/Postingan yang diikuti',
  `user_id` INT NOT NULL COMMENT 'ID Pengguna yang mendaftar',
  `name` VARCHAR(255) NOT NULL COMMENT 'Nama Peserta',
  `class` VARCHAR(100) NULL COMMENT 'Kelas/Tingkat Peserta (XI-A, XII-B, dll)',
  `phone_number` VARCHAR(20) NULL COMMENT 'Nomor Telepon Peserta',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Waktu pendaftaran',
  
  FOREIGN KEY (`event_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  INDEX idx_event_id (event_id) COMMENT 'Index untuk query by event_id',
  INDEX idx_user_id (user_id) COMMENT 'Index untuk query by user_id',
  INDEX idx_created_at (created_at) COMMENT 'Index untuk sorting by created_at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ====================================
-- VERIFICATION QUERIES
-- ====================================
-- Uncomment berikut untuk verify structure:
-- SHOW TABLES;
-- DESCRIBE users;
-- DESCRIBE posts;
-- DESCRIBE registrations;
