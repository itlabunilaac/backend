-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Create database
CREATE DATABASE IF NOT EXISTS `e_journal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `e_journal`;

-- Dumping structure for table e_journal.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admins: ~1 rows (approximately)
INSERT INTO `admins` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@ejournal.com', NULL, '$2y$12$4QJhq7kCfIJbZZgF/8MKCuOGDyDQwY7Z3L5J4F6M8N9P1Q2R3S4T5', NULL, '2025-06-30 09:00:00', '2025-06-30 09:00:00');

-- Dumping structure for table e_journal.admin_tokens
CREATE TABLE IF NOT EXISTS `admin_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint unsigned NOT NULL,
  `token` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'API Token',
  `expires_at` timestamp NOT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_tokens_token_unique` (`token`),
  KEY `admin_tokens_admin_id_foreign` (`admin_id`),
  CONSTRAINT `admin_tokens_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_tokens: ~0 rows (approximately)

-- Dumping structure for table e_journal.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cache: ~0 rows (approximately)

-- Dumping structure for table e_journal.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cache_locks: ~0 rows (approximately)

-- Dumping structure for table e_journal.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table failed_jobs: ~0 rows (approximately)

-- Dumping structure for table e_journal.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobs: ~0 rows (approximately)

-- Dumping structure for table e_journal.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_batches: ~0 rows (approximately)

-- Dumping structure for table e_journal.jurnals
CREATE TABLE IF NOT EXISTS `jurnals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `akreditasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_akreditasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_penerbit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unknown Author',
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping sample data for table jurnals: ~12 rows (approximately)
INSERT INTO `jurnals` (`id`, `foto`, `deskripsi`, `akreditasi`, `link_akreditasi`, `subject`, `penerbit`, `link_penerbit`, `judul`, `penulis`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, 'Comprehensive study on implementing machine learning algorithms for early disease detection and medical diagnosis.', 'Sinta 1', 'https://sinta.ristekbrin.go.id', 'Teknologi Informasi', 'International Journal of Medical AI', 'https://example.com/medical-ai', 'Machine Learning for Healthcare Diagnosis', 'Dr. Ahmad Santoso', 2500, '2025-06-30 09:00:00', '2025-06-30 09:00:00', NULL),
	(2, NULL, 'Research on renewable energy integration in urban environments for sustainable city development.', 'Scopus', 'https://scopus.com', 'Lingkungan', 'Green Technology Journal', 'https://example.com/green-tech', 'Sustainable Energy Solutions for Smart Cities', 'Prof. Siti Rahayu', 1800, '2025-06-30 09:05:00', '2025-06-30 09:05:00', NULL),
	(3, NULL, 'Analysis of how digital technologies are reshaping economic structures and business models.', 'Sinta 2', 'https://sinta.ristekbrin.go.id', 'Ekonomi', 'Digital Economy Review', 'https://example.com/digital-economy', 'Economic Impact of Digital Transformation', 'Dr. Budi Prasetyo', 1500, '2025-06-30 09:10:00', '2025-06-30 09:10:00', NULL),
	(4, NULL, 'Study on implementation of smart manufacturing technologies in modern industrial processes.', 'Sinta 1', 'https://sinta.ristekbrin.go.id', 'Teknik Industri', 'Manufacturing Technology Today', 'https://example.com/manufacturing', 'Advanced Manufacturing Processes in Industry 4.0', 'Ir. Dewi Lestari', 1200, '2025-06-30 09:15:00', '2025-06-30 09:15:00', NULL),
	(5, NULL, 'Comprehensive analysis of blockchain implementation in banking and financial institutions.', 'Scopus', 'https://scopus.com', 'Teknologi Informasi', 'FinTech Innovation Journal', 'https://example.com/fintech', 'Blockchain Technology in Financial Services', 'Dr. Andi Wijaya', 1000, '2025-06-30 09:20:00', '2025-06-30 09:20:00', NULL),
	(6, NULL, 'Real-time water quality monitoring system using Internet of Things sensors and data analytics.', 'Sinta 2', 'https://sinta.ristekbrin.go.id', 'Lingkungan', 'Environmental Monitoring Journal', 'https://example.com/env-monitoring', 'Water Quality Assessment Using IoT Sensors', 'Dr. Maya Sari', 800, '2025-06-30 09:25:00', '2025-06-30 09:25:00', NULL),
	(7, NULL, 'Impact assessment of microfinance institutions on rural community economic empowerment.', 'Sinta 3', 'https://sinta.ristekbrin.go.id', 'Ekonomi', 'Rural Development Quarterly', 'https://example.com/rural-dev', 'Microfinance and Rural Economic Development', 'Prof. Joko Susilo', 600, '2025-06-30 09:30:00', '2025-06-30 09:30:00', NULL),
	(8, NULL, 'Practical implementation of lean manufacturing principles in small and medium enterprises.', 'Sinta 2', 'https://sinta.ristekbrin.go.id', 'Teknik Industri', 'Industrial Engineering Today', 'https://example.com/industrial-eng', 'Lean Manufacturing Implementation Case Study', 'Dr. Rini Handayani', 450, '2025-06-30 09:35:00', '2025-06-30 09:35:00', NULL),
	(9, NULL, 'Exploring the potential of AI-powered educational tools and personalized learning systems.', 'Sinta 1', 'https://sinta.ristekbrin.go.id', 'Teknologi Informasi', 'Educational Technology Review', 'https://example.com/edtech', 'Artificial Intelligence in Education Technology', 'Dr. Fajar Nugroho', 300, '2025-06-30 09:40:00', '2025-06-30 09:40:00', NULL),
	(10, NULL, 'Regional strategies for climate change adaptation and environmental resilience building.', 'Scopus', 'https://scopus.com', 'Lingkungan', 'Climate Research International', 'https://example.com/climate', 'Climate Change Adaptation Strategies', 'Prof. Retno Wulandari', 200, '2025-06-30 09:45:00', '2025-06-30 09:45:00', NULL),
	(11, NULL, 'Effective digital marketing approaches for small and medium enterprises in the digital age.', 'Sinta 3', 'https://sinta.ristekbrin.go.id', 'Ekonomi', 'Small Business Marketing Journal', 'https://example.com/sme-marketing', 'Digital Marketing Strategies for SMEs', 'Dr. Eko Prasetyo', 150, '2025-06-30 09:50:00', '2025-06-30 09:50:00', NULL),
	(12, NULL, 'Implementation of Six Sigma methodology for quality improvement in manufacturing processes.', 'Sinta 2', 'https://sinta.ristekbrin.go.id', 'Teknik Industri', 'Quality Management Review', 'https://example.com/quality-mgmt', 'Quality Control in Manufacturing Using Six Sigma', 'Ir. Bambang Utomo', 100, '2025-06-30 09:55:00', '2025-06-30 09:55:00', NULL);

-- Dumping structure for table e_journal.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table migrations: ~7 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_12_30_000001_create_admins_table', 1),
	(5, '2024_12_30_000002_create_jurnals_table', 1),
	(6, '2024_12_30_000003_add_soft_deletes_to_jurnals_table', 1),
	(7, '2024_12_30_000006_add_penulis_to_jurnals_table', 2);

-- Dumping structure for table e_journal.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table e_journal.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sessions: ~0 rows (approximately)

-- Dumping structure for table e_journal.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Test User', 'test@example.com', '2025-06-30 09:00:00', '$2y$12$4QJhq7kCfIJbZZgF/8MKCuOGDyDQwY7Z3L5J4F6M8N9P1Q2R3S4T5', 'abcdef1234567890', '2025-06-30 09:00:00', '2025-06-30 09:00:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
