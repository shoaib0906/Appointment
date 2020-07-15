-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 08:49 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appoint1`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `client_id` int(10) DEFAULT NULL,
  `employee_id` int(10) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `date` date NOT NULL,
  `comments` text,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--
-- Error reading structure for table appoint1.clients: #1932 - Table 'appoint1.clients' doesn't exist in engine
-- Error reading data for table appoint1.clients: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `appoint1`.`clients`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--
-- Error reading structure for table appoint1.employees: #1932 - Table 'appoint1.employees' doesn't exist in engine
-- Error reading data for table appoint1.employees: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `appoint1`.`employees`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `employee_service`
--

CREATE TABLE `employee_service` (
  `employee_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2017_05_11_072916_create_1494476956_roles_table', 1),
(3, '2017_05_11_072917_create_1494476957_users_table', 1),
(4, '2017_05_11_073120_create_1494477080_clients_table', 1),
(5, '2017_05_11_073245_create_1494477165_employees_table', 1),
(6, '2017_05_11_074042_create_1494477642_working_hours_table', 1),
(7, '2017_05_11_074334_create_1494477814_appointments_table', 1),
(8, '2017_12_19_115904_create_services_table', 1),
(9, '2017_12_19_122552_create_employee_service_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Administrator (can create other users)', '2019-10-16 11:24:05', '2019-10-16 11:24:05'),
(2, 'Executive', '2019-10-29 05:16:03', '2019-10-29 05:16:03'),
(3, 'PS', '2019-10-29 05:16:07', '2019-10-29 05:16:07'),
(4, 'Simple user', '2019-10-16 11:24:05', '2019-10-16 11:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `created_at`, `updated_at`, `name`, `price`) VALUES
(1, '2019-10-29 05:19:20', '2019-10-29 05:19:20', 'Meeting', 0.00),
(2, '2019-10-29 05:19:27', '2019-10-29 05:19:27', 'Conference', 0.00),
(3, '2019-10-29 05:19:32', '2019-10-29 05:19:32', 'Tour', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$er5358zLagPnjJlmxstLYuWBd.jJzTwE6sVzeXNSm96RQAgqLXoi2', 1, 'z2wj5MbPxYmP5d7ePiQzMY8IAcRevtaS3Cl5ednAVstYckwmAPaeuCQ4F0I9', '2019-10-16 11:24:05', '2019-10-16 11:24:05'),
(7, 'Executive One', 'executive@gmail.com', '$2y$10$q3b6Bg34yKvWEhZfsL5nv.LvH/AgMbxnC3n89H4HwixxLQC85sBnm', 2, 'h4aOlEqnDMOCLKDYdbzW0ikr8vzgf3mRUNohLSutKAD5pry3M8niPg474bTX', '2019-10-29 05:24:48', '2019-10-29 05:24:48'),
(8, 'GM Shafiq', 'gmit@gmail.com', '$2y$10$Qi6ZgHFXEHt/ZXgfbPElYeCrLB8Go0qrOO9eXuzNvTa5FEkzah0J.', 2, 'n4zoFQ2giswBMREU9DZpPgAmT2f632dCIYOdGdi4Sg8v96B9OpyF5zIUSvPH', '2019-10-29 05:25:08', '2019-10-29 05:25:08'),
(9, 'Ps Executive one', 'ps@gmail.com', '$2y$10$EL5xfzA8YM./xfpBo5PTpe1Q133B4H59u2Gz8aoObCd3reEjn/mnK', 3, '27xR0tJPszni2hzSS1zNzKPsAFeoFGoU0G75OcIS6nQhVCCF1CZy31VtmSMN', '2019-10-29 05:26:23', '2019-10-29 05:26:23'),
(10, 'Golam Rabbi', 'rabbi@gmail.com', '$2y$10$v26jLag1e8vWWaoYM1qJK.SXDvC7ZRehdTTxgH0xefa61qAGb1fW6', 3, 'u2DPWdK259v7TEWtkSyIqsP9bL0GISsk4gQxOLKOAAOt4NOlg5dB4Win6G4v', '2019-10-29 05:26:53', '2019-10-29 05:26:53'),
(12, 'shoaib ahmed', 'ex@gmail.com', '$2y$10$Y8gHYeXRZhFrJpWuz6Aoq.At67FY.2Py3Uj3UZHj1vTPLiIiGEKRe', 2, NULL, '2019-10-30 00:52:30', '2019-10-30 00:52:30'),
(13, 'shoaib ahmed', 'shoabcse.ru@gmail.com', '$2y$10$d7yza7Aq5R9NP/EC5nKsMeF8m/KLvGZXWO9UoS2HiwMBA5TGqW3d6', 4, 'fw0tHBGfnwMj5aSQzd0R0Hm4lmPpNoFTlV1ETUDbFmoZ5B4uxPVBUMHPqeP5', '2019-10-30 04:25:40', '2019-10-30 04:25:40'),
(14, 'Shoaib Ahmed', 'toka@gmail.com', '$2y$10$yIwqYjlq/0f9/YlHL4CAmu8YmVhxLIrOZQPhShkHm95EPwo1UXHmO', 4, 'iIyQhIxHGXT5T876jBLMAOHNAusfL0NWw15ngQijNO5FkzZpAXJmeywOFU0i', '2019-10-30 05:34:23', '2019-10-30 05:34:23'),
(15, 'Piash', 'piash@gmail.com', '$2y$10$PSUJnTZVbt/MuoHtmwoIle5RMu41JaO1PfqokP31uMbfPNa3zYc/2', 4, NULL, '2019-11-18 22:31:15', '2019-11-18 22:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--
-- Error reading structure for table appoint1.working_hours: #1932 - Table 'appoint1.working_hours' doesn't exist in engine
-- Error reading data for table appoint1.working_hours: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `appoint1`.`working_hours`' at line 1

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_service`
--
ALTER TABLE `employee_service`
  ADD KEY `employee_service_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_service_service_id_foreign` (`service_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `35985_5913e89d4a576` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_service`
--
ALTER TABLE `employee_service`
  ADD CONSTRAINT `employee_service_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `employee_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `35985_5913e89d4a576` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
