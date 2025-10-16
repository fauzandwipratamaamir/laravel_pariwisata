-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2025 at 09:29 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tripgo`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tour_package_id` bigint UNSIGNED NOT NULL,
  `schedule_id` bigint UNSIGNED DEFAULT NULL,
  `pax` smallint UNSIGNED NOT NULL DEFAULT '1',
  `total_price` int UNSIGNED NOT NULL,
  `status` enum('pending','paid','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_proof_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `tour_package_id`, `schedule_id`, `pax`, `total_price`, `status`, `payment_proof_path`, `booked_at`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 13, 1, 2600000, 'paid', 'payment_proofs/azirtGH4Vh962U5oddn319T9Phd0jN0LN9Pnhtr3.png', '2025-10-16 03:49:12', '2025-10-15 20:49:33', '2025-10-15 20:49:12', '2025-10-15 20:49:33'),
(2, 1, 1, 1, 1, 1500000, 'paid', 'payment_proofs/MRur4r9xu0pL9ZW3nHBUGKkwC4S7hInvntQd9NjO.png', '2025-10-16 04:03:34', '2025-10-15 21:32:51', '2025-10-15 21:03:34', '2025-10-15 21:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Open Trip', 'open-trip', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(2, 'Private', 'private', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(3, 'Family', 'family', '2025-10-15 20:41:59', '2025-10-15 20:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `country`, `city`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Bali', 'Indonesia', 'Badung', 'bali', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(2, 'Labuan Bajo', 'Indonesia', 'Manggarai Barat', 'labuan-bajo', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(3, 'Yogyakarta', 'Indonesia', 'Yogyakarta', 'yogyakarta', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(4, 'Raja Ampat', 'Indonesia', 'Waigeo', 'raja-ampat', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(5, 'Lombok', 'Indonesia', 'Mataram', 'lombok', '2025-10-15 20:41:59', '2025-10-15 20:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itinerary_items`
--

CREATE TABLE `itinerary_items` (
  `id` bigint UNSIGNED NOT NULL,
  `tour_package_id` bigint UNSIGNED NOT NULL,
  `day_number` tinyint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itinerary_items`
--

INSERT INTO `itinerary_items` (`id`, `tour_package_id`, `day_number`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Hari 1', 'Kegiatan wisata hari 1 di Bali 3D2N Hemat', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(2, 1, 2, 'Hari 2', 'Kegiatan wisata hari 2 di Bali 3D2N Hemat', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(3, 1, 3, 'Hari 3', 'Kegiatan wisata hari 3 di Bali 3D2N Hemat', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(4, 2, 1, 'Hari 1', 'Kegiatan wisata hari 1 di Labuan Bajo 4D3N Komodo', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(5, 2, 2, 'Hari 2', 'Kegiatan wisata hari 2 di Labuan Bajo 4D3N Komodo', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(6, 2, 3, 'Hari 3', 'Kegiatan wisata hari 3 di Labuan Bajo 4D3N Komodo', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(7, 2, 4, 'Hari 4', 'Kegiatan wisata hari 4 di Labuan Bajo 4D3N Komodo', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(8, 3, 1, 'Hari 1', 'Kegiatan wisata hari 1 di Yogyakarta 3D2N Heritage', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(9, 3, 2, 'Hari 2', 'Kegiatan wisata hari 2 di Yogyakarta 3D2N Heritage', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(10, 3, 3, 'Hari 3', 'Kegiatan wisata hari 3 di Yogyakarta 3D2N Heritage', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(11, 4, 1, 'Hari 1', 'Kegiatan wisata hari 1 di Raja Ampat 5D4N Explore', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(12, 4, 2, 'Hari 2', 'Kegiatan wisata hari 2 di Raja Ampat 5D4N Explore', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(13, 4, 3, 'Hari 3', 'Kegiatan wisata hari 3 di Raja Ampat 5D4N Explore', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(14, 4, 4, 'Hari 4', 'Kegiatan wisata hari 4 di Raja Ampat 5D4N Explore', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(15, 4, 5, 'Hari 5', 'Kegiatan wisata hari 5 di Raja Ampat 5D4N Explore', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(16, 5, 1, 'Hari 1', 'Kegiatan wisata hari 1 di Lombok 4D3N Pantai', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(17, 5, 2, 'Hari 2', 'Kegiatan wisata hari 2 di Lombok 4D3N Pantai', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(18, 5, 3, 'Hari 3', 'Kegiatan wisata hari 3 di Lombok 4D3N Pantai', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(19, 5, 4, 'Hari 4', 'Kegiatan wisata hari 4 di Lombok 4D3N Pantai', '2025-10-15 20:41:59', '2025-10-15 20:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_01_000001_add_role_to_users_table', 1),
(5, '2025_01_01_000100_create_categories_table', 1),
(6, '2025_01_01_000150_create_destinations_table', 1),
(7, '2025_01_01_000200_create_tour_packages_table', 1),
(8, '2025_01_01_000230_create_package_images_table', 1),
(9, '2025_01_01_000260_create_itinerary_items_table', 1),
(10, '2025_01_01_000300_create_package_schedules_table', 1),
(11, '2025_01_01_000400_create_bookings_table', 1),
(12, '2025_01_01_010000_add_payment_proof_to_bookings', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_images`
--

CREATE TABLE `package_images` (
  `id` bigint UNSIGNED NOT NULL,
  `tour_package_id` bigint UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_images`
--

INSERT INTO `package_images` (`id`, `tour_package_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(2, 1, 'https://images.unsplash.com/photo-1543248939-ff40856f65d4', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(3, 1, 'https://images.unsplash.com/photo-1506744038136-46273834b3fb', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(4, 2, 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(5, 2, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(6, 2, 'https://images.unsplash.com/photo-1558981359-98d66f2b22c8', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(7, 3, 'https://images.unsplash.com/photo-1600585154526-990dced4db0d', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(8, 3, 'https://images.unsplash.com/photo-1612152605546-2400bd0c1b3e', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(9, 4, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(10, 4, 'https://images.unsplash.com/photo-1526483360412-f4dbaf036963', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(11, 4, 'https://images.unsplash.com/photo-1526772662000-3f88f10405ff', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(12, 5, 'https://images.unsplash.com/photo-1518684079-3c830dcef090', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(13, 5, 'https://images.unsplash.com/photo-1549880338-65ddcdfd017b', '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(14, 5, 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429', '2025-10-15 20:41:59', '2025-10-15 20:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `package_schedules`
--

CREATE TABLE `package_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `tour_package_id` bigint UNSIGNED NOT NULL,
  `depart_date` date NOT NULL,
  `seats_quota` smallint UNSIGNED NOT NULL DEFAULT '20',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_schedules`
--

INSERT INTO `package_schedules` (`id`, `tour_package_id`, `depart_date`, `seats_quota`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-10-23', 23, '2025-10-15 20:41:59', '2025-10-15 21:03:34'),
(2, 1, '2025-11-06', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(3, 1, '2025-11-20', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(4, 2, '2025-10-23', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(5, 2, '2025-11-06', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(6, 2, '2025-11-20', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(7, 3, '2025-10-23', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(8, 3, '2025-11-06', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(9, 3, '2025-11-20', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(10, 4, '2025-10-23', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(11, 4, '2025-11-06', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(12, 4, '2025-11-20', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(13, 5, '2025-10-23', 23, '2025-10-15 20:41:59', '2025-10-15 20:49:12'),
(14, 5, '2025-11-06', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(15, 5, '2025-11-20', 24, '2025-10-15 20:41:59', '2025-10-15 20:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4eI0OAh6vcYYaD4PYSLy2yDetpTZFZ04b0kA1Rv2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSkdEbXR3b2dVS2xaUjJrbzZ2SDM5OHVHc0V4RkoxQ3dEbnlnZ1lHbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9teS9ib29raW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1760589411),
('ZZJXzS8wnZyFxC4vpv84Qgmx85EHAnBvWpgWwk4N', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiemd3T3daR0JnUUt0ZDYzbUJ2d1I2amlLd3NoQ2owT1Y0VzE1VWlNaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9teS9ib29raW5ncyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1760589177);

-- --------------------------------------------------------

--
-- Table structure for table `tour_packages`
--

CREATE TABLE `tour_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `destination_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` varchar(280) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `base_price` int UNSIGNED NOT NULL,
  `duration_days` tinyint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`id`, `category_id`, `destination_id`, `title`, `slug`, `short_desc`, `description`, `base_price`, `duration_days`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Bali 3D2N Hemat', 'bali-3d2n', 'Liburan hemat 3 hari 2 malam di Bali', 'Termasuk hotel, sarapan, Ubud & Tanah Lot', 1500000, 3, 1, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(2, 1, 2, 'Labuan Bajo 4D3N Komodo', 'labuan-bajo-4d3n', 'Sailing Komodo + Pink Beach', 'Speedboat trip, snorkeling manta point, makan siang kapal', 3800000, 4, 1, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(3, 3, 3, 'Yogyakarta 3D2N Heritage', 'yogyakarta-3d2n', 'Candi & kuliner Yogya', 'Prambanan, Keraton, Malioboro, Gudeg', 1200000, 3, 1, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(4, 2, 4, 'Raja Ampat 5D4N Explore', 'raja-ampat-5d4n', 'Surga bawah laut Papua', 'Wayag, Pianemo, snorkeling karst islands', 8200000, 5, 1, '2025-10-15 20:41:59', '2025-10-15 20:41:59'),
(5, 1, 5, 'Lombok 4D3N Pantai', 'lombok-4d3n', 'Pantai selatan & Gili', 'Tanjung Aan, Merese, Gili T, snorkeling', 2600000, 4, 1, '2025-10-15 20:41:59', '2025-10-15 20:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin TripGo', 'admin12@tripgo.local', NULL, '$2y$12$EBH0Ka60jwdzHDfmTXM/mOGY0c.Cv.6hA.OGDPAIEfw92O0GmgFyu', 'admin', 'dPL1Jwqyslp7WIPqm1rBvgVm3nnmdHOqZdu11tUjVyNg8mlMWgM63zroMPT4', '2025-10-15 20:41:59', '2025-10-15 21:02:05'),
(2, 'tan', 'tanstecu@gmail.com', NULL, '$2y$12$sIBnwst28wCg85JbUvH4/ulu/E5ylTIp4F7pONSNkYrA4yv/Z89TO', 'user', NULL, '2025-10-15 20:47:00', '2025-10-15 20:47:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_tour_package_id_foreign` (`tour_package_id`),
  ADD KEY `bookings_schedule_id_foreign` (`schedule_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `destinations_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `itinerary_items`
--
ALTER TABLE `itinerary_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itinerary_items_tour_package_id_foreign` (`tour_package_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_images`
--
ALTER TABLE `package_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_images_tour_package_id_foreign` (`tour_package_id`);

--
-- Indexes for table `package_schedules`
--
ALTER TABLE `package_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_schedules_tour_package_id_foreign` (`tour_package_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tour_packages_slug_unique` (`slug`),
  ADD KEY `tour_packages_category_id_foreign` (`category_id`),
  ADD KEY `tour_packages_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itinerary_items`
--
ALTER TABLE `itinerary_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `package_images`
--
ALTER TABLE `package_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `package_schedules`
--
ALTER TABLE `package_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `package_schedules` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `itinerary_items`
--
ALTER TABLE `itinerary_items`
  ADD CONSTRAINT `itinerary_items_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_images`
--
ALTER TABLE `package_images`
  ADD CONSTRAINT `package_images_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_schedules`
--
ALTER TABLE `package_schedules`
  ADD CONSTRAINT `package_schedules_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD CONSTRAINT `tour_packages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tour_packages_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
