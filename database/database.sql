-- Database: `amanah_store`
-- Skema tabel untuk Sistem Kasir & Toko Kelontong Amanah Store

CREATE DATABASE IF NOT EXISTS `amanah_store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `amanah_store`;

-- Tabel Pengguna (Owner & Kasir)
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(191) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `role` ENUM('owner', 'kasir') NOT NULL DEFAULT 'kasir',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contoh Akun Awal (Password default: 'password123')
-- Hash dihasilkan dengan password_hash('password123', PASSWORD_DEFAULT)
INSERT INTO `users` (`nama`, `email`, `password_hash`, `role`)
VALUES ('Pak Haji (Owner)', 'owner@amanahstore.id', '$2y$10$wB.5yK06Bgl49/1Rk1m3c.4rS/j0zK0mU4eX9k.9s2.x5bH8tDk6y', 'owner')
ON DUPLICATE KEY UPDATE `id`=`id`;
