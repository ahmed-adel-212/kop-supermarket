-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2020 at 04:30 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petrodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `name_ar`, `city_id`, `created_at`, `updated_at`) VALUES
(9, 'Elshikh zaid', 'Ø§Ù„Ø´ÙŠØ® Ø²Ø§ÙŠØ¯', 2, NULL, '2020-09-03 08:29:09'),
(10, 'Elshoon', 'Ø§Ù„Ø´ÙˆÙ†', 8, NULL, '2020-09-03 08:29:19'),
(11, 'eltraa', 'Ø§Ù„ØªØ±Ø¹Ø©', 9, NULL, '2020-09-03 08:29:28'),
(12, 'elmgzar', 'Ø§Ù„Ù…Ø¬Ø²Ø±', 6, NULL, '2020-09-03 08:29:38'),
(13, 'Mahatet elraml', 'Ù…Ø­Ø·Ø© Ø§Ù„Ø±Ù…Ù„', 7, NULL, '2020-09-03 08:29:50'),
(14, 'Elgamaa', 'Ø§Ù„Ø¬Ø§Ù…Ø¹Ø©', 5, NULL, '2020-09-03 08:30:00'),
(15, 'Torel', 'ØªÙˆØ±ÙŠÙ„', 5, NULL, '2020-09-03 08:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `governorate_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `name_ar`, `governorate_id`, `created_at`, `updated_at`) VALUES
(2, '6 October', '6 Ø£ÙƒØªÙˆØ¨Ø±', 1, NULL, '2020-09-03 08:15:33'),
(5, 'Mansoura', 'Ø§Ù„Ù…Ù†ØµÙˆØ±Ø©', 5, NULL, '2020-09-03 08:18:13'),
(6, 'Belqas', 'Ø¨Ù„Ù‚Ø§Ø³', 5, NULL, '2020-09-03 08:18:21'),
(7, 'Mahatet el raml', 'Ù…Ø­Ø·Ø© Ø§Ù„Ø±Ù…Ù„', 2, NULL, '2020-09-03 08:18:31'),
(8, 'Elmhala Elkobra', 'Ø§Ù„Ù…Ø­Ù„Ø© Ø§Ù„ÙƒØ¨Ø±Ù‰', 6, NULL, '2020-09-03 08:18:41'),
(9, 'Mahalet Rohh', 'Ù…Ø­Ù„Ø© Ø±ÙˆØ­', 6, NULL, '2020-09-20 07:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `governorates`
--

CREATE TABLE `governorates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `governorates`
--

INSERT INTO `governorates` (`id`, `name`, `name_ar`, `created_at`, `updated_at`) VALUES
(1, 'Cairo', 'Ø§Ù„Ù‚Ø§Ù‡Ø±Ø©', NULL, '2020-09-03 07:52:53'),
(2, 'Alexandria', 'Ø§Ù„Ø§Ø³ÙƒÙ†Ø¯Ø±ÙŠØ©', NULL, '2020-09-03 07:53:05'),
(5, 'Dakahlia', 'Ø§Ù„Ø¯Ù‚Ù‡Ù„ÙŠØ©', NULL, '2020-09-03 07:53:16'),
(6, 'Algharbya', 'Ø§Ù„ØºØ±Ø¨ÙŠØ©', NULL, '2020-09-20 07:20:41'),
(8, 'Monfya', 'Ø§Ù„Ù…Ù†ÙˆÙÙŠØ©', '2020-09-03 07:51:41', '2020-09-03 07:52:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_city_id_foreign` (`city_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_governorate_id_foreign` (`governorate_id`);

--
-- Indexes for table `governorates`
--
ALTER TABLE `governorates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `governorates`
--
ALTER TABLE `governorates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
