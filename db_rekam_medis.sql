-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2023 at 04:19 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekam_medis`
--

-- --------------------------------------------------------

--
-- Table structure for table `cf_user`
--

CREATE TABLE `cf_user` (
  `id` bigint UNSIGNED NOT NULL,
  `ungkapan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_cf_user` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cf_user`
--

INSERT INTO `cf_user` (`id`, `ungkapan`, `nilai_cf_user`, `created_at`, `updated_at`) VALUES
(1, 'tidak tahu', 0.00, NULL, NULL),
(2, 'mungkin ya', 0.40, NULL, NULL),
(3, 'kemungkinan besar ya', 0.60, NULL, NULL),
(4, 'hampir pasti ya', 0.80, NULL, NULL),
(5, 'pasti ya', 1.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `datas`
--

CREATE TABLE `datas` (
  `id` bigint UNSIGNED NOT NULL,
  `pasien_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_terapis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datas`
--

INSERT INTO `datas` (`id`, `pasien_id`, `data_terapis`, `created_at`, `updated_at`) VALUES
(13, '1', '{\"gejala\":[[\"G10\",\"G09\",\"G02\",\"G01\"]],\"cf\":[[\"0.4\",\"0.4\",\"0.4\",\"0.4\"]],\"kode_tindakan\":\"T01\",\"total_cf\":0.666}', '2023-12-05 06:12:42', '2023-12-05 06:12:42'),
(14, '1', '{\"gejala\":[[\"G13\",\"G12\",\"G03\",\"G02\"]],\"cf\":[[\"0.4\",\"0.4\",\"0.4\",\"0.4\"]],\"kode_tindakan\":\"T05\",\"total_cf\":0.666}', '2023-12-05 06:23:20', '2023-12-05 06:23:20'),
(16, '1', '{\"gejala\":[[\"G10\",\"G09\",\"G02\",\"G01\"]],\"cf\":[[\"0.8\",\"1\",\"0.8\",\"1\"]],\"kode_tindakan\":\"T01\",\"total_cf\":0.957}', '2023-12-05 06:28:23', '2023-12-05 06:28:23');

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
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_gejala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des_gejala` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cf_gejala` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id`, `kode_gejala`, `des_gejala`, `cf_gejala`, `created_at`, `updated_at`) VALUES
(1, 'G01', 'demam', 0.60, NULL, NULL),
(2, 'G02', 'batuk', 0.60, NULL, '2023-09-03 13:08:39'),
(3, 'G03', 'hidung tersumbat', 0.60, NULL, NULL),
(4, 'G04', 'sakit kepala', 0.60, NULL, NULL),
(5, 'G05', 'susah tidur', 0.60, NULL, NULL),
(6, 'G06', 'tidak nafsu makan', 0.60, NULL, NULL),
(7, 'G07', 'sesak nafas', 0.60, NULL, NULL),
(8, 'G08', 'pilek', 0.60, NULL, NULL),
(9, 'G09', 'mual/muntah', 0.60, NULL, NULL),
(10, 'G10', 'badan lemas', 0.60, NULL, NULL),
(11, 'G11', 'emosi berlebih', 0.60, NULL, NULL),
(12, 'G12', 'pencernaan tidak lancar', 0.60, NULL, NULL),
(13, 'G13', 'sensitif dan mudah tersinggung', 0.60, NULL, NULL),
(14, 'G14', 'lambat merespon', 0.60, NULL, NULL),
(15, 'G15', 'kulit terasa gatal', 0.60, NULL, NULL),
(16, 'G16', 'gatal dan perih', 0.60, NULL, NULL),
(17, 'G17', 'pembengkakan otot', 0.60, NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_30_041750_gejala', 1),
(6, '2023_08_30_041759_rule', 1),
(7, '2023_08_30_041806_tindakan', 1),
(8, '2023_08_30_041824_pasien', 1),
(9, '2023_09_01_084128_cf_user', 1),
(10, '2023_09_01_084307_datas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttl` date NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama_lengkap`, `jk`, `alamat`, `ttl`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, 'faki', 'Laki-laki', 'makassar', '2000-01-20', '312121', '2023-09-02 07:24:16', '2023-09-03 11:48:57');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE `rule` (
  `id` bigint UNSIGNED NOT NULL,
  `tindakan_kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gejala_kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id`, `tindakan_kode`, `gejala_kode`, `created_at`, `updated_at`) VALUES
(2, 'T02', 'G09,G08,G07,G06,G05,G04,G03,G02,G01', '2023-09-02 08:20:18', '2023-11-27 03:11:37'),
(3, 'T03', 'G14,G13,G12,G11,G04', '2023-09-02 08:20:35', '2023-12-05 06:24:54'),
(4, 'T04', 'G17,G16,G15,G08,G02', '2023-09-02 08:20:51', '2023-11-27 03:12:58'),
(5, 'T05', 'G13,G12,G03,G02', '2023-09-02 08:21:31', '2023-11-27 03:13:41'),
(6, 'T01', 'G10,G09,G02,G01', '2023-09-03 14:12:35', '2023-11-27 03:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_tindakan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tindakan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`id`, `kode_tindakan`, `nama_tindakan`, `created_at`, `updated_at`) VALUES
(1, 'T01', 'oral stimulasi', NULL, NULL),
(2, 'T02', 'blocking and standing', NULL, NULL),
(3, 'T03', 'neuro senso', NULL, NULL),
(4, 'T04', 'massage', NULL, NULL),
(5, 'T05', 'patterning', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin@gmail.com', '$2y$10$x0EMy2m.F5N/WerC3Miwde.4aHV2z7klZDPcZBVCCUgaMHzjb6mli', '1', '2023-09-02 06:58:15', NULL),
(2, 'terapi', 'Terapi', 'terapi@gmail.com', '$2y$10$.HBqEleeiwgk1YT3QqOajub3h3t5xdY4uLX.OF/pe/C9sFnmNGmxe', '2', '2023-09-02 06:58:15', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cf_user`
--
ALTER TABLE `cf_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datas`
--
ALTER TABLE `datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gejala_kode_gejala_unique` (`kode_gejala`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tindakan_kode_tindakan_unique` (`kode_tindakan`);

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
-- AUTO_INCREMENT for table `cf_user`
--
ALTER TABLE `cf_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `datas`
--
ALTER TABLE `datas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rule`
--
ALTER TABLE `rule`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
