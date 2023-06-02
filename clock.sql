-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2023-06-02 03:22:01
-- 伺服器版本： 8.0.31
-- PHP 版本： 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `clock`
--

-- --------------------------------------------------------

--
-- 資料表結構 `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(36, '2014_10_12_000000_create_users_table', 1),
(37, '2014_10_12_100000_create_password_resets_table', 1),
(38, '2019_08_19_000000_create_failed_jobs_table', 1),
(39, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(40, '2023_05_26_155344_create_punchrecord_table', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `punchrecord`
--

DROP TABLE IF EXISTS `punchrecord`;
CREATE TABLE IF NOT EXISTS `punchrecord` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '編號',
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '月份',
  `nameid` bigint UNSIGNED NOT NULL COMMENT '工讀生編號',
  `punch_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '上班打卡時間',
  `punch_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '下班打卡時間',
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '時數',
  `mark` tinyint(1) DEFAULT NULL COMMENT '更改',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `punchrecord_nameid_foreign` (`nameid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '編號',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '身份',
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cardID` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '卡號',
  `studentID` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '學號',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `username`, `password`, `cardID`, `studentID`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '管理員', NULL, 'admin', '$2y$10$h2JeGlrwz5ZJhckktMReb.1X8alWAW55.cGVHtFTgzdql17fm.RcW', NULL, NULL, NULL, '2023-06-02 02:24:12', '2023-06-02 02:24:12'),
(2, '簡至昊', '1', NULL, NULL, '1214448021', 'D1094162012', NULL, '2023-06-02 02:57:21', '2023-06-02 03:14:10'),
(3, '劉彥芝', NULL, NULL, NULL, NULL, 'D1094421701', NULL, '2023-06-02 02:58:27', '2023-06-02 02:58:27'),
(4, '蔡定辰', NULL, NULL, NULL, NULL, 'D1094161033', NULL, '2023-06-02 02:58:47', '2023-06-02 02:58:47'),
(5, '許肇恒', NULL, NULL, NULL, NULL, 'D1094161032', NULL, '2023-06-02 02:59:00', '2023-06-02 02:59:00'),
(6, '王鈺欣', NULL, NULL, NULL, NULL, 'D1104442702', NULL, '2023-06-02 02:59:29', '2023-06-02 02:59:29'),
(7, '謝承祐', NULL, NULL, NULL, NULL, 'D1104111708', NULL, '2023-06-02 02:59:39', '2023-06-02 02:59:39'),
(8, '劉伃芹', NULL, NULL, NULL, NULL, 'D1104431013', NULL, '2023-06-02 02:59:49', '2023-06-02 02:59:49'),
(9, '謝宜軒', NULL, NULL, NULL, NULL, 'D1104431034', NULL, '2023-06-02 03:00:08', '2023-06-02 03:00:08'),
(10, '林宜蓁', NULL, NULL, NULL, NULL, 'D1104221043', NULL, '2023-06-02 03:00:18', '2023-06-02 03:00:18'),
(11, '林育成', NULL, NULL, NULL, NULL, 'D1104111051', NULL, '2023-06-02 03:00:27', '2023-06-02 03:00:27'),
(12, '沈倢宇', NULL, NULL, NULL, NULL, 'D1114431002', NULL, '2023-06-02 03:00:37', '2023-06-02 03:00:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
