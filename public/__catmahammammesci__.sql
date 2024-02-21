-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2024 at 08:22 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `__catmahammammesci__`
--

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` bigint UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint UNSIGNED NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_forms`
--

CREATE TABLE `booking_forms` (
  `id` int UNSIGNED NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `massage_package` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hammam_package` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `male_pax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `female_pax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_status_id` int UNSIGNED DEFAULT NULL,
  `answered_time` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_forms`
--

CREATE TABLE `contact_forms` (
  `id` int UNSIGNED NOT NULL,
  `name_surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_status_id` int UNSIGNED DEFAULT NULL,
  `answered_time` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int UNSIGNED NOT NULL,
  `name_surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name_surname`, `phone`, `country`, `email`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'demo', '00905438991063', 'Turkey', 'farshadnabizadeh1993@gmail.com', 1, NULL, '2024-02-21 16:42:52', '2024-02-21 16:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `code`, `percentage`, `note`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'demo1', '3434', '20', NULL, 1, NULL, '2024-02-21 16:43:53', '2024-02-21 16:43:53');

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
-- Table structure for table `form_statuses`
--

CREATE TABLE `form_statuses` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_statuses`
--

INSERT INTO `form_statuses` (`id`, `name`, `color`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'demo1', '#ea9999', 1, NULL, '2024-02-21 16:43:36', '2024-02-21 16:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`id`, `name`, `phone`, `iban`, `note`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'demo2', '00905438991063', 'TR8987498743223478942374389', NULL, 1, NULL, '2024-02-21 16:44:54', '2024-02-21 16:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `phone`, `person`, `person_account_number`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'demo1', '00905438991063', '3', '3', 1, NULL, '2024-02-21 16:44:14', '2024-02-21 16:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `medical_forms`
--

CREATE TABLE `medical_forms` (
  `id` int UNSIGNED NOT NULL,
  `name_surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `therapist_gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heart_problems` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_pressure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `varicose_veins` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asthma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vertebral_problem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joint_problems` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fractures` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skin_allergies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lodine_allergies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hyperthyroidism` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diabetes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `epilepsy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pregnant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_problems` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `covid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `covid_note` longtext COLLATE utf8mb4_unicode_ci,
  `surgery` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surgery_note` longtext COLLATE utf8mb4_unicode_ci,
  `signature` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(53, '2014_10_12_000000_create_users_table', 1),
(54, '2014_10_12_100000_create_password_resets_table', 1),
(55, '2019_02_16_100417_create_medical_forms', 1),
(56, '2019_08_19_000000_create_failed_jobs_table', 1),
(57, '2021_06_30_185732_create_countries', 1),
(58, '2021_07_01_120408_create_discounts', 1),
(59, '2021_07_01_120409_create_sales_persons', 1),
(60, '2021_07_01_120409_create_therapists', 1),
(61, '2021_07_01_120410_create_form_statuses', 1),
(62, '2021_07_01_120410_create_sources', 1),
(63, '2021_07_01_120412_create_services', 1),
(64, '2021_07_01_120415_create_customers', 1),
(65, '2021_07_01_120415_create_payment_types', 1),
(66, '2021_07_01_120416_create_reservations', 1),
(67, '2021_07_01_120417_create_booking_forms', 1),
(68, '2021_07_01_120417_create_contact_forms', 1),
(69, '2021_07_01_120417_create_guides', 1),
(70, '2021_07_01_120417_create_hotels', 1),
(71, '2021_07_01_120417_create_reservations_comissions', 1),
(72, '2021_07_01_120417_create_reservations_medical_form', 1),
(73, '2021_07_01_120417_create_reservations_payment_types', 1),
(74, '2021_07_01_120417_create_reservations_services', 1),
(75, '2021_07_01_120417_create_reservations_therapists', 1),
(76, '2021_10_15_185352_create_permission_tables', 1),
(77, '2022_08_29_121724_create_audits_table', 1),
(78, '2023_02_08_170415_create_whatsapp_numbers', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `type_name`, `note`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'demo1', NULL, 1, NULL, '2024-02-21 16:44:22', '2024-02-21 16:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'show users', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(2, 'create users', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(3, 'edit users', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(4, 'delete users', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(5, 'show roles', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(6, 'create roles', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(7, 'edit roles', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(8, 'delete roles', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(9, 'show customers', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(10, 'create customers', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(11, 'edit customers', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(12, 'delete customers', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(13, 'show bookingform', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(14, 'edit bookingform', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(15, 'delete bookingform', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(16, 'show contactform', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(17, 'edit contactform', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(18, 'delete contactform', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(19, 'create reservation', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(20, 'edit reservation', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(21, 'delete reservation', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(22, 'show hotel', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(23, 'create hotel', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(24, 'edit hotel', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(25, 'delete hotel', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(26, 'show payment type', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(27, 'create payment type', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(28, 'edit payment type', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(29, 'delete payment type', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(30, 'show sources', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(31, 'create sources', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(32, 'edit sources', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(33, 'delete sources', 'web', '2024-02-21 16:40:46', '2024-02-21 16:40:46'),
(34, 'show form statuses', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(35, 'create form statuses', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(36, 'edit form statuses', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(37, 'delete form statuses', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(38, 'show services', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(39, 'create services', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(40, 'edit services', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(41, 'delete services', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(42, 'show guides', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(43, 'create guides', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(44, 'edit guides', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(45, 'delete guides', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(46, 'show sales person', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(47, 'create sales person', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(48, 'edit sales person', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(49, 'delete sales person', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(50, 'show therapist', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(51, 'create therapist', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(52, 'edit therapist', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(53, 'delete therapist', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(54, 'show discount', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(55, 'create discount', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(56, 'edit discount', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(57, 'delete discount', 'web', '2024-02-21 16:40:47', '2024-02-21 16:40:47'),
(58, 'show reservation', 'web', '2024-02-21 16:41:06', '2024-02-21 16:41:06'),
(59, 'show reservation reports', 'web', '2024-02-21 16:41:06', '2024-02-21 16:41:06'),
(60, 'show accounting reports', 'web', '2024-02-21 16:41:06', '2024-02-21 16:41:06'),
(61, 'show reports', 'web', '2024-02-21 16:41:06', '2024-02-21 16:41:06'),
(62, 'show definitions', 'web', '2024-02-21 16:41:06', '2024-02-21 16:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int UNSIGNED NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `discount_id` int UNSIGNED DEFAULT NULL,
  `source_id` int UNSIGNED NOT NULL,
  `reservation_note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations_comissions`
--

CREATE TABLE `reservations_comissions` (
  `id` bigint UNSIGNED NOT NULL,
  `reservation_id` int UNSIGNED NOT NULL,
  `hotel_id` int UNSIGNED DEFAULT NULL,
  `comission_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comission_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations_medical_forms`
--

CREATE TABLE `reservations_medical_forms` (
  `id` bigint UNSIGNED NOT NULL,
  `reservation_id` int UNSIGNED NOT NULL,
  `medical_form_id` int UNSIGNED NOT NULL,
  `piece` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations_payments_types`
--

CREATE TABLE `reservations_payments_types` (
  `id` bigint UNSIGNED NOT NULL,
  `reservation_id` int UNSIGNED NOT NULL,
  `payment_type_id` int UNSIGNED NOT NULL,
  `payment_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations_services`
--

CREATE TABLE `reservations_services` (
  `id` bigint UNSIGNED NOT NULL,
  `reservation_id` int UNSIGNED NOT NULL,
  `service_id` int UNSIGNED NOT NULL,
  `piece` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations_therapists`
--

CREATE TABLE `reservations_therapists` (
  `id` bigint UNSIGNED NOT NULL,
  `reservation_id` int UNSIGNED NOT NULL,
  `therapist_id` int UNSIGNED NOT NULL,
  `piece` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', '2024-02-21 16:41:06', '2024-02-21 16:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_persons`
--

CREATE TABLE `sales_persons` (
  `id` int UNSIGNED NOT NULL,
  `name_surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_persons`
--

INSERT INTO `sales_persons` (`id`, `name_surname`, `phone_number`, `email_address`, `note`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'demo5', '00905438991063', 'farshadnabizadeh1993@gmail.com', NULL, 1, NULL, '2024-02-21 16:45:30', '2024-02-21 16:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `currency`, `cost`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'demo1', 'EUR', '35', 1, NULL, '2024-02-21 16:45:08', '2024-02-21 16:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE `sources` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`id`, `name`, `color`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'demo2', '#276cb8', 1, NULL, '2024-02-21 16:44:33', '2024-02-21 16:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `therapists`
--

CREATE TABLE `therapists` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `therapists`
--

INSERT INTO `therapists` (`id`, `name`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'demo2', 1, NULL, '2024-02-21 16:45:38', '2024-02-21 16:45:38');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'farshadnabizadeh1993@gmail.com', 'farshadnabizadeh1993@gmail.com', NULL, '$2y$10$1.V/oPmsXkiI/CJQywMeWO6Trkv6DOdUU37K.2Qc5m/jh0h9r8eRq', NULL, '2024-02-21 16:40:26', '2024-02-21 16:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_numbers`
--

CREATE TABLE `whatsapp_numbers` (
  `id` int UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  ADD KEY `audits_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `booking_forms`
--
ALTER TABLE `booking_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_forms_form_status_id_foreign` (`form_status_id`);

--
-- Indexes for table `contact_forms`
--
ALTER TABLE `contact_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_forms_form_status_id_foreign` (`form_status_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form_statuses`
--
ALTER TABLE `form_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_forms`
--
ALTER TABLE `medical_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_customer_id_foreign` (`customer_id`),
  ADD KEY `reservations_discount_id_foreign` (`discount_id`),
  ADD KEY `reservations_source_id_foreign` (`source_id`);

--
-- Indexes for table `reservations_comissions`
--
ALTER TABLE `reservations_comissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_comissions_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservations_comissions_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `reservations_medical_forms`
--
ALTER TABLE `reservations_medical_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_medical_forms_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservations_medical_forms_medical_form_id_foreign` (`medical_form_id`);

--
-- Indexes for table `reservations_payments_types`
--
ALTER TABLE `reservations_payments_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_payments_types_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservations_payments_types_payment_type_id_foreign` (`payment_type_id`);

--
-- Indexes for table `reservations_services`
--
ALTER TABLE `reservations_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_services_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservations_services_service_id_foreign` (`service_id`);

--
-- Indexes for table `reservations_therapists`
--
ALTER TABLE `reservations_therapists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_therapists_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservations_therapists_therapist_id_foreign` (`therapist_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales_persons`
--
ALTER TABLE `sales_persons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `therapists`
--
ALTER TABLE `therapists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `whatsapp_numbers`
--
ALTER TABLE `whatsapp_numbers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_forms`
--
ALTER TABLE `booking_forms`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_forms`
--
ALTER TABLE `contact_forms`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_statuses`
--
ALTER TABLE `form_statuses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medical_forms`
--
ALTER TABLE `medical_forms`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations_comissions`
--
ALTER TABLE `reservations_comissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations_medical_forms`
--
ALTER TABLE `reservations_medical_forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations_payments_types`
--
ALTER TABLE `reservations_payments_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations_services`
--
ALTER TABLE `reservations_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations_therapists`
--
ALTER TABLE `reservations_therapists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_persons`
--
ALTER TABLE `sales_persons`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sources`
--
ALTER TABLE `sources`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `therapists`
--
ALTER TABLE `therapists`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `whatsapp_numbers`
--
ALTER TABLE `whatsapp_numbers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_forms`
--
ALTER TABLE `booking_forms`
  ADD CONSTRAINT `booking_forms_form_status_id_foreign` FOREIGN KEY (`form_status_id`) REFERENCES `form_statuses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_forms`
--
ALTER TABLE `contact_forms`
  ADD CONSTRAINT `contact_forms_form_status_id_foreign` FOREIGN KEY (`form_status_id`) REFERENCES `form_statuses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `sources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations_comissions`
--
ALTER TABLE `reservations_comissions`
  ADD CONSTRAINT `reservations_comissions_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_comissions_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations_medical_forms`
--
ALTER TABLE `reservations_medical_forms`
  ADD CONSTRAINT `reservations_medical_forms_medical_form_id_foreign` FOREIGN KEY (`medical_form_id`) REFERENCES `medical_forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_medical_forms_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations_payments_types`
--
ALTER TABLE `reservations_payments_types`
  ADD CONSTRAINT `reservations_payments_types_payment_type_id_foreign` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_payments_types_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations_services`
--
ALTER TABLE `reservations_services`
  ADD CONSTRAINT `reservations_services_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations_therapists`
--
ALTER TABLE `reservations_therapists`
  ADD CONSTRAINT `reservations_therapists_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_therapists_therapist_id_foreign` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
