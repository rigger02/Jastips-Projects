-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 03 Jun 2023 pada 16.21
-- Versi server: 10.5.19-MariaDB-cll-lve
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u824923760_takeit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_l_feedback`
--

CREATE TABLE `tbl_l_feedback` (
  `id_tlf` bigint(20) UNSIGNED NOT NULL,
  `feedback_tlf` text NOT NULL,
  `id_tmu` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_l_log`
--

CREATE TABLE `tbl_l_log` (
  `id_tll` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `useraccess` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_l_log`
--

INSERT INTO `tbl_l_log` (`id_tll`, `module`, `action`, `useraccess`, `created_at`, `updated_at`) VALUES
(1, 'Login', 'User do login', 2, '2023-05-29 15:56:03', '2023-05-29 15:56:03'),
(2, 'Login', 'User do login', 1, '2023-05-29 15:56:23', '2023-05-29 15:56:23'),
(3, 'Login', 'User do login', 3, '2023-05-29 15:56:41', '2023-05-29 15:56:41'),
(4, 'Login', 'User do login', 3, '2023-05-29 15:56:43', '2023-05-29 15:56:43'),
(5, 'Driver', 'Driver do Register', 4, '2023-05-29 15:56:56', '2023-05-29 15:56:56'),
(6, 'Login', 'User do login', 4, '2023-05-29 15:57:42', '2023-05-29 15:57:42'),
(7, 'Store', 'Register Store', 1, '2023-05-29 16:00:19', '2023-05-29 16:00:19'),
(8, 'Store', 'Register Store', 3, '2023-05-29 16:01:11', '2023-05-29 16:01:11'),
(9, 'Store', 'Change User to Store', 3, '2023-05-29 16:04:44', '2023-05-29 16:04:44'),
(10, 'Store', 'Change User to Store', 1, '2023-05-29 16:05:09', '2023-05-29 16:05:09'),
(11, 'Address', 'Add Address id: 2 to Address', 2, '2023-05-29 16:08:13', '2023-05-29 16:08:13'),
(12, 'Address', 'Add Address id: 2 to Address', 2, '2023-05-29 16:08:19', '2023-05-29 16:08:19'),
(13, 'Address', 'Add Address id: 2 to Address', 2, '2023-05-29 16:10:22', '2023-05-29 16:10:22'),
(14, 'Address', 'Add Address id: 2 to Address', 2, '2023-05-29 16:10:26', '2023-05-29 16:10:26'),
(15, 'Login', 'User do login', 2, '2023-05-29 16:11:24', '2023-05-29 16:11:24'),
(16, 'Login', 'User do login', 1, '2023-05-29 16:19:13', '2023-05-29 16:19:13'),
(17, 'Login', 'User do login', 1, '2023-05-29 16:37:17', '2023-05-29 16:37:17'),
(18, 'product', 'add Product 1', 1, '2023-05-29 16:37:46', '2023-05-29 16:37:46'),
(19, 'product', 'add Product 2', 1, '2023-05-29 16:38:05', '2023-05-29 16:38:05'),
(20, 'Login', 'User do login', 3, '2023-05-29 16:38:16', '2023-05-29 16:38:16'),
(21, 'Login', 'User do login', 2, '2023-05-29 16:40:42', '2023-05-29 16:40:42'),
(22, 'product', 'add Product 3', 3, '2023-05-29 16:45:27', '2023-05-29 16:45:27'),
(23, 'product', 'add Product 4', 3, '2023-05-29 16:45:43', '2023-05-29 16:45:43'),
(24, 'product', 'add Product 5', 3, '2023-05-29 16:46:06', '2023-05-29 16:46:06'),
(25, 'Login', 'User do login', 2, '2023-05-29 22:00:32', '2023-05-29 22:00:32'),
(26, 'Login', 'User do login', 2, '2023-05-29 22:00:56', '2023-05-29 22:00:56'),
(27, 'Login', 'User do login', 1, '2023-05-29 22:01:51', '2023-05-29 22:01:51'),
(28, 'Login', 'User do login', 2, '2023-05-29 22:01:59', '2023-05-29 22:01:59'),
(29, 'Login', 'User do login', 2, '2023-05-30 01:08:25', '2023-05-30 01:08:25'),
(30, 'Login', 'User do login', 2, '2023-05-30 02:22:47', '2023-05-30 02:22:47'),
(31, 'Login', 'User do login', 2, '2023-05-30 13:28:49', '2023-05-30 13:28:49'),
(32, 'Login', 'User do login', 2, '2023-05-30 13:42:31', '2023-05-30 13:42:31'),
(33, 'Login', 'User do login', 1, '2023-05-30 13:45:06', '2023-05-30 13:45:06'),
(34, 'Login', 'User do login', 3, '2023-05-30 15:05:41', '2023-05-30 15:05:41'),
(35, 'Login', 'User do login', 3, '2023-05-30 15:37:15', '2023-05-30 15:37:15'),
(36, 'Login', 'User do login', 2, '2023-05-30 16:42:36', '2023-05-30 16:42:36'),
(37, 'Login', 'User do login', 2, '2023-05-30 17:49:56', '2023-05-30 17:49:56'),
(38, 'Login', 'User do login', 2, '2023-05-30 17:59:21', '2023-05-30 17:59:21'),
(39, 'Login', 'User do login', 3, '2023-05-30 17:59:35', '2023-05-30 17:59:35'),
(40, 'Login', 'User do login', 2, '2023-05-30 18:22:53', '2023-05-30 18:22:53'),
(41, 'Login', 'User do login', 3, '2023-05-30 18:23:50', '2023-05-30 18:23:50'),
(42, 'Login', 'User do login', 2, '2023-05-30 18:55:55', '2023-05-30 18:55:55'),
(43, 'Login', 'User do login', 3, '2023-05-30 18:57:35', '2023-05-30 18:57:35'),
(44, 'Login', 'User do login', 2, '2023-05-30 19:13:28', '2023-05-30 19:13:28'),
(45, 'Login', 'User do login', 2, '2023-05-30 19:31:10', '2023-05-30 19:31:10'),
(46, 'Login', 'User do login', 3, '2023-05-30 19:31:20', '2023-05-30 19:31:20'),
(47, 'Login', 'User do login', 2, '2023-05-31 01:13:25', '2023-05-31 01:13:25'),
(48, 'Login', 'User do login', 3, '2023-05-31 01:13:43', '2023-05-31 01:13:43'),
(49, 'Login', 'User do login', 2, '2023-05-31 10:39:49', '2023-05-31 10:39:49'),
(50, 'Login', 'User do login', 2, '2023-05-31 10:39:49', '2023-05-31 10:39:49'),
(51, 'product', 'add asds', 3, '2023-05-31 13:46:16', '2023-05-31 13:46:16'),
(52, 'product', 'add Cek', 3, '2023-05-31 13:47:20', '2023-05-31 13:47:20'),
(53, 'product', 'add asda', 3, '2023-05-31 14:30:38', '2023-05-31 14:30:38'),
(54, 'Login', 'User do login', 2, '2023-05-31 14:33:06', '2023-05-31 14:33:06'),
(55, 'Login', 'User do login', 3, '2023-05-31 14:34:29', '2023-05-31 14:34:29'),
(56, 'product', 'add Bebek', 3, '2023-05-31 14:34:56', '2023-05-31 14:34:56'),
(57, 'product', 'add Bebek', 3, '2023-05-31 14:36:11', '2023-05-31 14:36:11'),
(58, 'Login', 'User do login', 2, '2023-05-31 17:05:20', '2023-05-31 17:05:20'),
(59, 'Login', 'User do login', 2, '2023-05-31 22:42:56', '2023-05-31 22:42:56'),
(60, 'Login', 'User do login', 1, '2023-05-31 22:44:23', '2023-05-31 22:44:23'),
(61, 'product', 'add Produk. apa ajjja', 1, '2023-05-31 22:45:48', '2023-05-31 22:45:48'),
(62, 'Login', 'User do login', 2, '2023-05-31 22:46:30', '2023-05-31 22:46:30'),
(63, 'Login', 'User do login', 3, '2023-06-01 13:56:51', '2023-06-01 13:56:51'),
(64, 'Login', 'User do login', 2, '2023-06-01 16:24:10', '2023-06-01 16:24:10'),
(65, 'Login', 'User do login', 3, '2023-06-01 16:35:04', '2023-06-01 16:35:04'),
(66, 'product', 'add asdas', 3, '2023-06-01 17:16:40', '2023-06-01 17:16:40'),
(67, 'Login', 'User do login', 3, '2023-06-01 17:58:49', '2023-06-01 17:58:49'),
(68, 'product', 'add Cek euy', 3, '2023-06-01 18:04:44', '2023-06-01 18:04:44'),
(69, 'Login', 'User do login', 3, '2023-06-01 22:15:15', '2023-06-01 22:15:15'),
(70, 'Login', 'User do login', 3, '2023-06-02 00:02:50', '2023-06-02 00:02:50'),
(71, 'product', 'add tes lagi', 3, '2023-06-02 01:09:44', '2023-06-02 01:09:44'),
(72, 'product', 'add dfsd', 3, '2023-06-02 01:11:03', '2023-06-02 01:11:03'),
(73, 'Login', 'User do login', 2, '2023-06-02 02:34:48', '2023-06-02 02:34:48'),
(74, 'Login', 'User do login', 1, '2023-06-02 02:55:30', '2023-06-02 02:55:30'),
(75, 'Product', 'delete dfsd', 1, '2023-06-02 10:55:21', '2023-06-02 10:55:21'),
(76, 'Product', 'delete tes lagi', 1, '2023-06-02 10:56:19', '2023-06-02 10:56:19'),
(77, 'Login', 'User do login', 2, '2023-06-02 11:21:35', '2023-06-02 11:21:35'),
(78, 'Login', 'User do login', 3, '2023-06-02 15:13:35', '2023-06-02 15:13:35'),
(79, 'Login', 'User do login', 2, '2023-06-02 15:16:53', '2023-06-02 15:16:53'),
(80, 'Login', 'User do login', 2, '2023-06-02 15:18:23', '2023-06-02 15:18:23'),
(81, 'Login', 'User do login', 3, '2023-06-02 15:18:43', '2023-06-02 15:18:43'),
(82, 'Login', 'User do login', 3, '2023-06-02 15:20:12', '2023-06-02 15:20:12'),
(83, 'product', 'add dyt', 3, '2023-06-02 15:20:25', '2023-06-02 15:20:25'),
(84, 'product', 'add safas', 3, '2023-06-02 15:21:22', '2023-06-02 15:21:22'),
(85, 'Product', 'delete safas', 3, '2023-06-02 15:21:43', '2023-06-02 15:21:43'),
(86, 'Login', 'User do login', 2, '2023-06-02 15:26:50', '2023-06-02 15:26:50'),
(87, 'Login', 'User do login', 3, '2023-06-02 15:29:14', '2023-06-02 15:29:14'),
(88, 'Login', 'User do login', 2, '2023-06-02 15:30:50', '2023-06-02 15:30:50'),
(89, 'Login', 'User do login', 2, '2023-06-02 15:36:20', '2023-06-02 15:36:20'),
(90, 'Login', 'User do login', 2, '2023-06-02 15:38:29', '2023-06-02 15:38:29'),
(91, 'Address', 'Add Address id: 2 to Address', 2, '2023-06-02 16:37:22', '2023-06-02 16:37:22'),
(92, 'Address', 'Add Address id: 2 to Address', 2, '2023-06-02 16:38:35', '2023-06-02 16:38:35'),
(93, 'Address', 'Add Address id: 2 to Address', 2, '2023-06-02 17:06:33', '2023-06-02 17:06:33'),
(94, 'Login', 'User do login', 2, '2023-06-02 17:19:18', '2023-06-02 17:19:18'),
(95, 'Login', 'User do login', 3, '2023-06-02 17:27:07', '2023-06-02 17:27:07'),
(96, 'Product', 'delete dyt', 3, '2023-06-02 17:27:19', '2023-06-02 17:27:19'),
(97, 'Product', 'delete Cek euy', 3, '2023-06-02 17:31:19', '2023-06-02 17:31:19'),
(98, 'Login', 'User do login', 2, '2023-06-02 19:19:13', '2023-06-02 19:19:13'),
(99, 'Login', 'User do login', 3, '2023-06-02 19:25:06', '2023-06-02 19:25:06'),
(100, 'Login', 'User do login', 2, '2023-06-02 20:11:30', '2023-06-02 20:11:30'),
(101, 'Login', 'User do login', 4, '2023-06-02 20:25:20', '2023-06-02 20:25:20'),
(102, 'Login', 'User do login', 4, '2023-06-02 20:29:25', '2023-06-02 20:29:25'),
(103, 'Login', 'User do login', 4, '2023-06-02 22:25:36', '2023-06-02 22:25:36'),
(104, 'Login', 'User do login', 4, '2023-06-03 00:35:37', '2023-06-03 00:35:37'),
(105, 'Login', 'User do login', 4, '2023-06-03 01:36:55', '2023-06-03 01:36:55'),
(106, 'Login', 'User do login', 3, '2023-06-03 10:14:17', '2023-06-03 10:14:17'),
(107, 'Login', 'User do login', 3, '2023-06-03 10:26:35', '2023-06-03 10:26:35'),
(108, 'Login', 'User do login', 2, '2023-06-03 10:28:18', '2023-06-03 10:28:18'),
(109, 'Login', 'User do login', 3, '2023-06-03 10:36:24', '2023-06-03 10:36:24'),
(110, 'Login', 'User do login', 3, '2023-06-03 10:40:46', '2023-06-03 10:40:46'),
(111, 'Login', 'User do login', 2, '2023-06-03 10:58:46', '2023-06-03 10:58:46'),
(112, 'Login', 'User do login', 3, '2023-06-03 11:03:38', '2023-06-03 11:03:38'),
(113, 'Login', 'User do login', 3, '2023-06-03 11:04:19', '2023-06-03 11:04:19'),
(114, 'Login', 'User do login', 2, '2023-06-03 11:46:21', '2023-06-03 11:46:21'),
(115, 'Login', 'User do login', 3, '2023-06-03 12:42:27', '2023-06-03 12:42:27'),
(116, 'Login', 'User do login', 2, '2023-06-03 12:45:34', '2023-06-03 12:45:34'),
(117, 'Login', 'User do login', 4, '2023-06-03 12:52:50', '2023-06-03 12:52:50'),
(118, 'Login', 'User do login', 2, '2023-06-03 13:14:24', '2023-06-03 13:14:24'),
(119, 'Login', 'User do login', 2, '2023-06-03 13:17:07', '2023-06-03 13:17:07'),
(120, 'Login', 'User do login', 2, '2023-06-03 13:21:18', '2023-06-03 13:21:18'),
(121, 'Address', 'Add Address id: 2 to Address', 2, '2023-06-03 14:46:52', '2023-06-03 14:46:52'),
(122, 'Login', 'User do login', 2, '2023-06-03 15:41:03', '2023-06-03 15:41:03'),
(123, 'Login', 'User do login', 3, '2023-06-03 15:51:32', '2023-06-03 15:51:32'),
(124, 'Login', 'User do login', 3, '2023-06-03 16:07:15', '2023-06-03 16:07:15'),
(125, 'Login', 'User do login', 1, '2023-06-03 16:23:38', '2023-06-03 16:23:38'),
(126, 'product', 'add asdqwe', 1, '2023-06-03 16:26:44', '2023-06-03 16:26:44'),
(127, 'Product', 'delete asdqwe', 1, '2023-06-03 16:28:02', '2023-06-03 16:28:02'),
(128, 'Product', 'Update Product 1 status publish', 3, '2023-06-03 16:29:13', '2023-06-03 16:29:13'),
(129, 'Product', 'Update Product 1 status publish', 3, '2023-06-03 16:32:39', '2023-06-03 16:32:39'),
(130, 'Product', 'Update Product 1 status unpublish', 3, '2023-06-03 16:34:09', '2023-06-03 16:34:09'),
(131, 'Product', 'Update Product 1 status publish', 1, '2023-06-03 16:42:30', '2023-06-03 16:42:30'),
(132, 'Product', 'Update Product 1 status unpublish', 1, '2023-06-03 16:42:55', '2023-06-03 16:42:55'),
(133, 'Product', 'Update Product 1 status publish', 1, '2023-06-03 16:44:49', '2023-06-03 16:44:49'),
(134, 'Product', 'Update Product 1 status unpublish', 1, '2023-06-03 16:45:38', '2023-06-03 16:45:38'),
(135, 'Product', 'Update Product 2 status unpublish', 1, '2023-06-03 16:45:44', '2023-06-03 16:45:44'),
(136, 'Product', 'Update Product 1 status publish', 1, '2023-06-03 16:45:58', '2023-06-03 16:45:58'),
(137, 'Product', 'Update Product 2 status publish', 1, '2023-06-03 16:45:59', '2023-06-03 16:45:59'),
(138, 'Product', 'Update Product 1 status unpublish', 1, '2023-06-03 16:55:47', '2023-06-03 16:55:47'),
(139, 'Product', 'Update Product 1 status publish', 1, '2023-06-03 16:55:53', '2023-06-03 16:55:53'),
(140, 'Product', 'Update Product 1 status unpublish', 1, '2023-06-03 16:56:12', '2023-06-03 16:56:12'),
(141, 'Product', 'Update Product 1 status publish', 1, '2023-06-03 16:56:14', '2023-06-03 16:56:14'),
(142, 'Login', 'User do login', 4, '2023-06-03 17:08:36', '2023-06-03 17:08:36'),
(143, 'Login', 'User do login', 3, '2023-06-03 17:40:21', '2023-06-03 17:40:21'),
(144, 'Login', 'User do login', 2, '2023-06-03 18:19:09', '2023-06-03 18:19:09'),
(145, 'Login', 'User do login', 3, '2023-06-03 18:20:54', '2023-06-03 18:20:54'),
(146, 'Login', 'User do login', 4, '2023-06-03 22:07:35', '2023-06-03 22:07:35'),
(147, 'Login', 'User do login', 4, '2023-06-03 22:36:25', '2023-06-03 22:36:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_m_driver`
--

CREATE TABLE `tbl_m_driver` (
  `id_tmd` bigint(20) UNSIGNED NOT NULL,
  `id_tmu` bigint(20) UNSIGNED NOT NULL,
  `status_tmd` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `status_active_account` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_m_driver`
--

INSERT INTO `tbl_m_driver` (`id_tmd`, `id_tmu`, `status_tmd`, `status_active_account`, `created_at`, `updated_at`) VALUES
(1, 4, 'aktif', 1, '2023-05-29 15:56:56', '2023-05-29 15:56:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_m_store`
--

CREATE TABLE `tbl_m_store` (
  `id_tms` bigint(20) UNSIGNED NOT NULL,
  `name_tms` varchar(255) NOT NULL,
  `phone_tms` varchar(255) NOT NULL,
  `image_tms` varchar(255) DEFAULT NULL,
  `address_tms` varchar(255) NOT NULL,
  `id_tmu` bigint(20) UNSIGNED NOT NULL,
  `status_tms` enum('open','close') NOT NULL DEFAULT 'open',
  `status_active_account` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_m_store`
--

INSERT INTO `tbl_m_store` (`id_tms`, `name_tms`, `phone_tms`, `image_tms`, `address_tms`, `id_tmu`, `status_tms`, `status_active_account`, `created_at`, `updated_at`) VALUES
(1, 'Rigger Store', '003', 'uploads/1685350819_restaurant 1.jpg', 'Pinayungan', 1, 'open', 1, '2023-05-29 16:00:19', '2023-05-29 16:00:19'),
(2, 'Panz Store', '002', 'uploads/1685350871_restaurant 2.jpg', 'ceplik', 3, 'open', 1, '2023-05-29 16:01:11', '2023-05-29 16:01:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_m_user`
--

CREATE TABLE `tbl_m_user` (
  `id_tmu` bigint(20) UNSIGNED NOT NULL,
  `name_tmu` varchar(255) NOT NULL,
  `phone_tmu` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` enum('customer','driver','store','admin') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_m_user`
--

INSERT INTO `tbl_m_user` (`id_tmu`, `name_tmu`, `phone_tmu`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'rigger', '002', '$2y$10$J/0cNcmFZ056Y.aUhbYlV.QQ5E3Onlg90zTb6Kj27DKj46Cxb38TW', 'store', '2023-05-29 15:54:52', '2023-05-29 16:05:09'),
(2, 'badrio', '003', '$2y$10$jqnZ1VFPcgi5qNu8rHLrAOLuCQYD5Q94stnyNhjvkuM1u2d4umuJu', 'customer', '2023-05-29 15:55:37', '2023-05-29 15:55:37'),
(3, 'trisya', '004', '$2y$10$xMpSjaatUW7..RMo5umqA.paKubeB3MtBb1YJ13nb4BpiPL0GeoLS', 'store', '2023-05-29 15:56:34', '2023-05-29 16:04:44'),
(4, 'rakha', '005', '$2y$10$XU8QCKao82tV.mttlBpeq.JzJE89uv49XAdbVXJeYu4MEQzOfZv0e', 'driver', '2023-05-29 15:56:56', '2023-05-29 15:56:56'),
(5, 'Lexy Belk', '2149238574', 'QflIjXIV', 'customer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Noell Powton', '2869103540', 'QmWVLoN', 'driver', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Karlyn Peacey', '9479539164', 'yF22uv1SWCn', 'store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Aguste Cherrison', '9987062375', 'IW3yoPZv', 'store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Ofelia Indge', '9232174490', '2ryGOvFMq6Py', 'store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Emmalynne Eliasen', '5955642246', 'BgizYeh7UnDK', 'store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Tamra Rivelin', '7932137733', 'MDmVaR', 'driver', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Codie Doogue', '4533349652', 'Qi6dWu6', 'store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Juline Torvey', '5139290162', 'OWZ2hYFjL6', 'driver', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Karl Bertl', '2957321477', 'iEcQGye', 'customer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Minda Diperaus', '1541693603', 'kt31axa', 'customer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Gratia Pennyman', '5141823305', 'gPYHRHOh', 'customer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Suzanna Lanfer', '2871930787', 'VrWTkX3MhA', 'driver', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Talyah Smallpiece', '9126152600', 'ipWrtCFsh', 'store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Cathrin Canape', '9763330776', 'y8XAaowt', 'store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Clare Genese', '8416573257', 'em76EUiUmf', 'customer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Natala Seakin', '8253317251', '5HMHw4', 'customer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Augustina Wordsley', '5839214671', 'SCZhHdoek', 'driver', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Ruby Micallef', '7444378499', '90kdfiXFFXB', 'store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Thain Elsdon', '7672637962', 'TS0t2vTIm927', 'driver', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Fanny Woolf', '7801866010', 'sJjWEKVO9qs', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Beau Berriball', '7414524342', 'e5rBsNzYzKv', 'store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Hurley Goosey', '3111686628', 'A4nsma62', 'driver', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Anita Nichol', '2287079842', 'ZrfvO2V', 'store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Rodie Colomb', '1997158741', '4XG0kezkSWx', 'driver', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_t_customer_address`
--

CREATE TABLE `tbl_t_customer_address` (
  `id_ttca` bigint(20) UNSIGNED NOT NULL,
  `name_ttca` varchar(255) NOT NULL,
  `phone_ttca` varchar(255) NOT NULL,
  `static_ttca` text NOT NULL,
  `dynamic_ttca` text DEFAULT NULL,
  `isActive_ttca` tinyint(4) NOT NULL DEFAULT 0,
  `id_tmu` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_t_customer_address`
--

INSERT INTO `tbl_t_customer_address` (`id_ttca`, `name_ttca`, `phone_ttca`, `static_ttca`, `dynamic_ttca`, `isActive_ttca`, `id_tmu`, `created_at`, `updated_at`) VALUES
(8, 'Trisya Nurmayanti', '085458455244', 'Karawang', 'Pasir Panjang', 1, 2, '2023-06-02 17:06:33', '2023-06-02 17:06:33'),
(9, 'Muhamad Badrio Taupani', '085885436239', 'Jawa Barat', 'Ceplik', 0, 2, '2023-06-03 14:46:52', '2023-06-03 14:46:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_t_order_purchase`
--

CREATE TABLE `tbl_t_order_purchase` (
  `id_ttop` bigint(20) UNSIGNED NOT NULL,
  `qty_ttop` int(11) NOT NULL,
  `description_ttop` text DEFAULT NULL,
  `status_ttop` enum('pending','process','onTheWay','delivered') NOT NULL DEFAULT 'pending',
  `transaction_ttop` varchar(255) NOT NULL,
  `id_ttps` bigint(20) UNSIGNED NOT NULL,
  `id_tmd` bigint(20) UNSIGNED DEFAULT NULL,
  `id_ttca` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_t_order_purchase`
--

INSERT INTO `tbl_t_order_purchase` (`id_ttop`, `qty_ttop`, `description_ttop`, `status_ttop`, `transaction_ttop`, `id_ttps`, `id_tmd`, `id_ttca`, `created_at`, `updated_at`) VALUES
(16, 1, '', 'process', '1685700419_dVpQlr', 1, NULL, 8, '2023-06-02 17:06:59', '2023-06-03 23:09:10'),
(17, 3, '', 'process', '1685700419_dVpQlr', 2, NULL, 8, '2023-06-02 17:06:59', '2023-06-03 23:09:10'),
(18, 2, '', 'process', '1685711526_UsTNGz', 3, NULL, 8, '2023-06-02 20:12:06', '2023-06-02 20:12:06'),
(19, 2, '', 'process', '1685711526_UsTNGz', 4, NULL, 8, '2023-06-02 20:12:06', '2023-06-02 20:12:06'),
(20, 2, '', 'process', '1685711526_UsTNGz', 5, NULL, 8, '2023-06-02 20:12:06', '2023-06-02 20:12:06'),
(21, 1, '', 'process', '1685711526_UsTNGz', 10, NULL, 8, '2023-06-02 20:12:06', '2023-06-02 20:12:06'),
(22, 1, '', 'process', '1685770833_HWhDNP', 5, 1, 8, '2023-06-03 12:40:33', '2023-06-03 23:14:19'),
(23, 1, '', 'process', '1685770833_HWhDNP', 10, 1, 8, '2023-06-03 12:40:33', '2023-06-03 23:14:19'),
(24, 1, '', 'pending', '1685782254_JFzBwQ', 1, NULL, 8, '2023-06-03 15:50:54', '2023-06-03 15:50:54'),
(25, 1, '', 'pending', '1685782254_JFzBwQ', 2, NULL, 8, '2023-06-03 15:50:54', '2023-06-03 15:50:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_t_product_store`
--

CREATE TABLE `tbl_t_product_store` (
  `id_ttps` bigint(20) UNSIGNED NOT NULL,
  `name_ttps` varchar(255) NOT NULL,
  `image_ttps` varchar(255) NOT NULL,
  `price_ttps` int(11) NOT NULL,
  `status_ttps` enum('publish','unpublish') NOT NULL DEFAULT 'publish',
  `id_tms` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_t_product_store`
--

INSERT INTO `tbl_t_product_store` (`id_ttps`, `name_ttps`, `image_ttps`, `price_ttps`, `status_ttps`, `id_tms`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', 'uploads/1685353066_Product 1.jpg', 13000, 'publish', 1, '2023-05-29 16:37:46', '2023-06-03 16:56:14'),
(2, 'Product 2', 'uploads/1685353085_Product 2.jpg', 12000, 'publish', 1, '2023-05-29 16:38:05', '2023-06-03 16:45:59'),
(3, 'Product 3', 'uploads/1685353527_Product 3.jpg', 15000, 'publish', 2, '2023-05-29 16:45:27', '2023-05-29 16:45:27'),
(4, 'Product 4', 'uploads/1685353543_Product 4.jpg', 10000, 'unpublish', 2, '2023-05-29 16:45:43', '2023-05-29 16:45:43'),
(5, 'Product 5', 'uploads/1685353566_Product 5.jpg', 19000, 'publish', 2, '2023-05-29 16:46:06', '2023-05-29 16:46:06'),
(10, 'Bebek', 'uploads/1685518571.jpeg', 15000, 'publish', 2, '2023-05-31 14:36:11', '2023-05-31 14:36:11');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_driver_history`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_driver_history` (
`id_tmd` bigint(20) unsigned
,`transaction_ttop` varchar(255)
,`name_ttca` varchar(255)
,`phone_ttca` varchar(255)
,`static_ttca` text
,`dynamic_ttca` text
,`status_ttop` enum('pending','process','onTheWay','delivered')
,`date` varchar(72)
,`time` varchar(10)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_driver_history`
--
DROP TABLE IF EXISTS `vw_driver_history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u824923760_root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `vw_driver_history`  AS SELECT `ttop`.`id_tmd` AS `id_tmd`, `ttop`.`transaction_ttop` AS `transaction_ttop`, `ttca`.`name_ttca` AS `name_ttca`, `ttca`.`phone_ttca` AS `phone_ttca`, `ttca`.`static_ttca` AS `static_ttca`, `ttca`.`dynamic_ttca` AS `dynamic_ttca`, `ttop`.`status_ttop` AS `status_ttop`, date_format(`ttop`.`updated_at`,'%d %M %Y') AS `date`, date_format(`ttop`.`updated_at`,'%H:%i') AS `time` FROM (`tbl_t_order_purchase` `ttop` join `tbl_t_customer_address` `ttca` on(`ttca`.`id_ttca` = `ttop`.`id_ttca`)) WHERE `ttop`.`status_ttop` = 'delivered' GROUP BY `ttop`.`id_tmd`, `ttop`.`transaction_ttop`, `ttca`.`name_ttca`, `ttca`.`phone_ttca`, `ttca`.`static_ttca`, `ttca`.`dynamic_ttca`, `ttop`.`status_ttop`, `ttop`.`updated_at` LIMIT 0, 10 ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `tbl_l_feedback`
--
ALTER TABLE `tbl_l_feedback`
  ADD PRIMARY KEY (`id_tlf`),
  ADD KEY `tbl_l_feedback_id_tmu_foreign` (`id_tmu`);

--
-- Indeks untuk tabel `tbl_l_log`
--
ALTER TABLE `tbl_l_log`
  ADD PRIMARY KEY (`id_tll`),
  ADD KEY `tbl_l_log_useraccess_foreign` (`useraccess`);

--
-- Indeks untuk tabel `tbl_m_driver`
--
ALTER TABLE `tbl_m_driver`
  ADD PRIMARY KEY (`id_tmd`),
  ADD KEY `tbl_m_driver_id_tmu_foreign` (`id_tmu`);

--
-- Indeks untuk tabel `tbl_m_store`
--
ALTER TABLE `tbl_m_store`
  ADD PRIMARY KEY (`id_tms`),
  ADD UNIQUE KEY `tbl_m_store_name_tms_unique` (`name_tms`),
  ADD UNIQUE KEY `tbl_m_store_phone_tms_unique` (`phone_tms`),
  ADD KEY `tbl_m_store_id_tmu_foreign` (`id_tmu`);

--
-- Indeks untuk tabel `tbl_m_user`
--
ALTER TABLE `tbl_m_user`
  ADD PRIMARY KEY (`id_tmu`);

--
-- Indeks untuk tabel `tbl_t_customer_address`
--
ALTER TABLE `tbl_t_customer_address`
  ADD PRIMARY KEY (`id_ttca`),
  ADD KEY `tbl_t_customer_address_id_tmu_foreign` (`id_tmu`);

--
-- Indeks untuk tabel `tbl_t_order_purchase`
--
ALTER TABLE `tbl_t_order_purchase`
  ADD PRIMARY KEY (`id_ttop`),
  ADD KEY `tbl_t_order_purchase_id_ttps_foreign` (`id_ttps`),
  ADD KEY `tbl_t_order_purchase_id_tmd_foreign` (`id_tmd`),
  ADD KEY `tbl_t_order_purchase_id_ttca_foreign` (`id_ttca`);

--
-- Indeks untuk tabel `tbl_t_product_store`
--
ALTER TABLE `tbl_t_product_store`
  ADD PRIMARY KEY (`id_ttps`),
  ADD KEY `tbl_t_product_store_id_tms_foreign` (`id_tms`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_l_feedback`
--
ALTER TABLE `tbl_l_feedback`
  MODIFY `id_tlf` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_l_log`
--
ALTER TABLE `tbl_l_log`
  MODIFY `id_tll` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT untuk tabel `tbl_m_driver`
--
ALTER TABLE `tbl_m_driver`
  MODIFY `id_tmd` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_m_store`
--
ALTER TABLE `tbl_m_store`
  MODIFY `id_tms` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_m_user`
--
ALTER TABLE `tbl_m_user`
  MODIFY `id_tmu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tbl_t_customer_address`
--
ALTER TABLE `tbl_t_customer_address`
  MODIFY `id_ttca` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_t_order_purchase`
--
ALTER TABLE `tbl_t_order_purchase`
  MODIFY `id_ttop` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_t_product_store`
--
ALTER TABLE `tbl_t_product_store`
  MODIFY `id_ttps` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_l_feedback`
--
ALTER TABLE `tbl_l_feedback`
  ADD CONSTRAINT `tbl_l_feedback_id_tmu_foreign` FOREIGN KEY (`id_tmu`) REFERENCES `tbl_m_user` (`id_tmu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_l_log`
--
ALTER TABLE `tbl_l_log`
  ADD CONSTRAINT `tbl_l_log_useraccess_foreign` FOREIGN KEY (`useraccess`) REFERENCES `tbl_m_user` (`id_tmu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_m_driver`
--
ALTER TABLE `tbl_m_driver`
  ADD CONSTRAINT `tbl_m_driver_id_tmu_foreign` FOREIGN KEY (`id_tmu`) REFERENCES `tbl_m_user` (`id_tmu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_m_store`
--
ALTER TABLE `tbl_m_store`
  ADD CONSTRAINT `tbl_m_store_id_tmu_foreign` FOREIGN KEY (`id_tmu`) REFERENCES `tbl_m_user` (`id_tmu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_t_customer_address`
--
ALTER TABLE `tbl_t_customer_address`
  ADD CONSTRAINT `tbl_t_customer_address_id_tmu_foreign` FOREIGN KEY (`id_tmu`) REFERENCES `tbl_m_user` (`id_tmu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_t_order_purchase`
--
ALTER TABLE `tbl_t_order_purchase`
  ADD CONSTRAINT `tbl_t_order_purchase_id_tmd_foreign` FOREIGN KEY (`id_tmd`) REFERENCES `tbl_m_driver` (`id_tmd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_t_order_purchase_id_ttca_foreign` FOREIGN KEY (`id_ttca`) REFERENCES `tbl_t_customer_address` (`id_ttca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_t_order_purchase_id_ttps_foreign` FOREIGN KEY (`id_ttps`) REFERENCES `tbl_t_product_store` (`id_ttps`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_t_product_store`
--
ALTER TABLE `tbl_t_product_store`
  ADD CONSTRAINT `tbl_t_product_store_id_tms_foreign` FOREIGN KEY (`id_tms`) REFERENCES `tbl_m_store` (`id_tms`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
