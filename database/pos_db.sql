-- Adminer 4.8.4 MySQL 8.0.40-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `barangs`;
CREATE TABLE `barangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_barang` decimal(10,2) NOT NULL,
  `stok` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barangs_user_id_foreign` (`user_id`),
  CONSTRAINT `barangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `barangs` (`id`, `nama_barang`, `gambar_barang`, `harga_barang`, `stok`, `user_id`, `created_at`, `updated_at`) VALUES
(6,	'Baju bola manchester city',	'1730931527.jpg',	25.00,	10,	5,	'2024-11-06 15:18:47',	'2024-11-25 06:01:25'),
(7,	'Baju bola manchester united',	'1730931630.jpeg',	30.00,	18,	5,	'2024-11-06 15:20:30',	'2024-12-07 02:44:17'),
(8,	'baju bola Bayern Munchen',	'1730931753.jpeg',	27.00,	13,	5,	'2024-11-06 15:22:33',	'2024-11-25 06:04:04'),
(9,	'Gitar Akustik',	'1731317875.jpg',	450.00,	24,	6,	'2024-11-11 02:37:55',	'2024-11-14 11:36:34'),
(10,	'Bass Elektrik',	'1731317911.jpg',	550.00,	10,	6,	'2024-11-11 02:38:31',	'2024-11-11 02:38:31'),
(11,	'senjata',	'1731485642.jpg',	500.00,	10,	7,	'2024-11-13 01:14:02',	'2024-11-13 01:14:02'),
(12,	'keris',	'1731485666.jpg',	100.00,	5,	7,	'2024-11-13 01:14:26',	'2024-11-13 01:14:26'),
(13,	'topi',	'1731485688.jpeg',	25.00,	30,	7,	'2024-11-13 01:14:48',	'2024-11-13 01:14:48');

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_barangs` bigint unsigned NOT NULL,
  `stok` int NOT NULL,
  `totalharga` decimal(10,2) NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `carts` (`id`, `id_barangs`, `stok`, `totalharga`, `user_id`, `created_at`, `updated_at`) VALUES
(16,	12,	5,	500.00,	7,	'2024-11-13 01:14:54',	'2024-11-13 01:15:05'),
(17,	11,	1,	500.00,	7,	'2024-11-13 01:15:02',	'2024-11-13 01:15:02');

DROP TABLE IF EXISTS `detail_transaksis`;
CREATE TABLE `detail_transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksis` bigint unsigned NOT NULL,
  `id_barangs` bigint unsigned NOT NULL,
  `kuantitas` int NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_transaksis_user_id_foreign` (`user_id`),
  CONSTRAINT `detail_transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `detail_transaksis` (`id`, `id_transaksis`, `id_barangs`, `kuantitas`, `harga_satuan`, `subtotal`, `user_id`, `created_at`, `updated_at`) VALUES
(1,	1,	8,	1,	27.00,	27.00,	5,	'2024-11-14 09:22:47',	'2024-11-14 09:22:47'),
(2,	1,	7,	1,	30.00,	30.00,	5,	'2024-11-14 09:22:47',	'2024-11-14 09:22:47'),
(3,	1,	6,	1,	25.00,	25.00,	5,	'2024-11-14 09:22:47',	'2024-11-14 09:22:47'),
(4,	2,	9,	1,	450.00,	450.00,	6,	'2024-11-14 11:36:34',	'2024-11-14 11:36:34'),
(5,	3,	6,	1,	25.00,	25.00,	5,	'2024-11-25 06:01:25',	'2024-11-25 06:01:25'),
(6,	3,	8,	2,	27.00,	54.00,	5,	'2024-11-25 06:01:25',	'2024-11-25 06:01:25'),
(7,	4,	8,	1,	27.00,	27.00,	5,	'2024-11-25 06:04:04',	'2024-11-25 06:04:04'),
(8,	5,	7,	1,	30.00,	30.00,	5,	'2024-12-07 02:44:17',	'2024-12-07 02:44:17');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
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


DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faqs` (`id`, `pertanyaan`, `jawaban`, `created_at`, `updated_at`) VALUES
(2,	'Apa itu aplikasi Pos Kasirku?',	'Pos Kasirku adalah aplikasi point-of-sale (POS) yang dirancang untuk membantu pelaku usaha mengelola penjualan, stok barang, dan laporan keuangan secara efisien. Aplikasi ini cocok digunakan oleh toko retail, restoran, dan berbagai jenis usaha lainnya.',	'2024-11-25 08:01:48',	'2024-11-25 08:01:48'),
(3,	'Bagaimana cara menambahkan produk ke dalam aplikasi?',	'Untuk menambahkan produk:\r\n\r\n    - Buka menu Produk di dashboard.\r\n    - Klik tombol Tambah Produk.\r\n    - Isi informasi seperti nama produk, harga, stok awal, dan kategori.\r\n    - Klik Simpan untuk menyimpan data produk.',	'2024-11-25 08:02:41',	'2024-11-25 08:12:40');

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_pakets` bigint unsigned NOT NULL,
  `nama_member` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `members_user_id_foreign` (`user_id`),
  CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `members` (`id`, `id_pakets`, `nama_member`, `alamat`, `telepon`, `tanggal_mulai`, `tanggal_selesai`, `user_id`, `created_at`, `updated_at`) VALUES
(2,	3,	'rayhan adrian',	'bogor jawa barat',	'085646462323',	'2024-11-13',	'2025-05-13',	1,	'2024-11-13 01:09:30',	'2024-11-13 01:09:30'),
(4,	4,	'Wisnu Saputra',	'rusun KPAD , condet jakarta timur',	'085646462323',	'2024-11-14',	'2025-11-15',	1,	'2024-11-13 15:51:15',	'2024-11-13 15:51:15'),
(6,	2,	'Salman',	'cijantung',	'082246314280',	'2024-11-25',	'2024-12-26',	1,	'2024-11-25 07:59:23',	'2024-11-25 07:59:50');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_reset_tokens_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2024_10_31_134815_create_barangs_table',	1),
(6,	'2024_10_31_141142_create_paket_members_table',	1),
(7,	'2024_10_31_142457_create_members_table',	1),
(8,	'2024_10_31_143651_create_transaksis_table',	1),
(9,	'2024_10_31_143933_create_detail_transaksis_table',	1),
(10,	'2024_11_06_223058_create_carts_table',	2),
(11,	'2024_11_25_140843_create_faqs_table',	3),
(12,	'2024_12_01_134619_create_pendapats_table',	4);

DROP TABLE IF EXISTS `paket_members`;
CREATE TABLE `paket_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `durasi` enum('1-bulan','6-bulan','12-bulan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `status` enum('tersedia','tidak_tersedia') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paket_members_user_id_foreign` (`user_id`),
  CONSTRAINT `paket_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `paket_members` (`id`, `durasi`, `harga`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(2,	'1-bulan',	300.00,	'tersedia',	1,	'2024-11-11 03:48:15',	'2024-11-11 03:48:15'),
(3,	'6-bulan',	1800.00,	'tersedia',	1,	'2024-11-11 03:48:33',	'2024-11-11 03:50:02'),
(4,	'12-bulan',	2500.00,	'tersedia',	1,	'2024-11-11 03:50:44',	'2024-11-11 03:51:20');

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pendapats`;
CREATE TABLE `pendapats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kritik_saran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pendapats` (`id`, `nama`, `email`, `kritik_saran`, `created_at`, `updated_at`) VALUES
(1,	'mahes',	'mahes@gmail.com',	'bagus webnya',	'2024-12-01 07:41:52',	'2024-12-01 07:41:52'),
(2,	'mikel',	'mikel@gmail.com',	'tambahin testimoni',	'2024-12-01 07:42:48',	'2024-12-01 07:42:48'),
(3,	'syamil',	'syamil@gmail.com',	'bagus banget',	'2024-12-01 07:44:14',	'2024-12-01 07:44:14'),
(4,	'fadlan',	'fadlan@gmail.com',	'keren',	'2024-12-01 07:44:59',	'2024-12-01 07:44:59');

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `transaksis`;
CREATE TABLE `transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_members` bigint unsigned NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksis_user_id_foreign` (`user_id`),
  CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transaksis` (`id`, `id_members`, `tanggal_transaksi`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2024-11-14',	82.00,	5,	'2024-11-14 09:22:47',	'2024-11-14 09:22:47'),
(2,	2,	'2024-11-14',	450.00,	6,	'2024-11-14 11:36:34',	'2024-11-14 11:36:34'),
(3,	1,	'2024-11-25',	79.00,	5,	'2024-11-25 06:01:25',	'2024-11-25 06:01:25'),
(4,	1,	'2024-11-25',	27.00,	5,	'2024-11-25 06:04:04',	'2024-11-25 06:04:04'),
(5,	6,	'2024-12-07',	30.00,	5,	'2024-12-07 02:44:17',	'2024-12-07 02:44:17');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','member','guest') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'guest',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'AdminKasirKu',	'adminkasirku@gmail.com',	NULL,	'admin',	'$2y$12$XC9fKdQcoxKZk4RpuODB9enyFzebQkS7YRbJXADRGixIFV0iopXYG',	NULL,	NULL,	'2024-11-04 04:46:32'),
(2,	'Achmad Fadli Iskandar',	'fadli17@gmail.com',	NULL,	'guest',	'$2y$12$T1orrgdCIPQf7H1.Rccyc.Qnn3odwSuQaBAaA7NYOnJZzFTSdsxKW',	NULL,	'2024-11-01 23:40:52',	'2024-11-04 08:03:58'),
(3,	'dhani diaz prayitno',	'sirdhan@gmail.com',	NULL,	'guest',	'$2y$12$2TzLLr/gORvF4XTyrhiLOON5EMCdhJr1/n2DE8RLTVf.2KPbx83NC',	NULL,	'2024-11-04 04:48:50',	'2024-11-13 16:15:18'),
(5,	'Salman',	'salman@gmail.com',	NULL,	'member',	'$2y$12$AXXA.f6OUOvg2Ys/HPfBceTIiCJYnTZEX0hRaZsV6RgOCOnH/W26a',	NULL,	'2024-11-04 18:53:46',	'2024-11-04 18:53:46'),
(6,	'rayhan adrian',	'rayhanad@gmail.com',	NULL,	'member',	'$2y$12$UCZF3r1O/jGc.gsg36fLY./a655Bmap40JUv8WuthnXBNF43WtLMC',	NULL,	'2024-11-06 15:26:51',	'2024-11-06 15:26:51'),
(7,	'Wisnu Saputra',	'wisnu@gmail.com',	NULL,	'member',	'$2y$12$Nr5lRiKL2D9Qi5De3nYb0.bTVXocFcnzNHnVE6gEogy5kF0UdzPFC',	NULL,	'2024-11-13 01:10:20',	'2024-11-13 01:10:20');

-- 2024-12-18 12:01:15
