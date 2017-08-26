-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.2.3-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for db_crud_member2
/*CREATE DATABASE IF NOT EXISTS `db_crud_member2` */ /*!40100 DEFAULT CHARACTER SET latin1 */;
/*USE `db_crud_member2`;*/


-- Dumping structure for table db_crud_member2.jenisindustris
CREATE TABLE IF NOT EXISTS `jenisindustris` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.jenisindustris: ~16 rows (approximately)
/*!40000 ALTER TABLE `jenisindustris` DISABLE KEYS */;
INSERT INTO `jenisindustris` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'banking', NULL, NULL),
	(2, 'auditing', NULL, NULL),
	(3, 'automotive manufacturing', NULL, NULL),
	(4, 'food & beverage', NULL, NULL),
	(5, 'retail', NULL, NULL),
	(6, 'e-commerce', NULL, NULL),
	(7, 'construction', NULL, NULL),
	(8, 'service industry', NULL, NULL),
	(9, 'mining, oil & gas', NULL, NULL),
	(10, 'property development', NULL, NULL),
	(11, 'hospitality', NULL, NULL),
	(12, 'insurance & assurance', NULL, NULL),
	(13, 'government', NULL, NULL),
	(14, 'healthcare', NULL, NULL),
	(15, 'advertising / media', NULL, NULL),
	(16, 'transportation', NULL, NULL);
/*!40000 ALTER TABLE `jenisindustris` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.jeniskelas
CREATE TABLE IF NOT EXISTS `jeniskelas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.jeniskelas: ~6 rows (approximately)
/*!40000 ALTER TABLE `jeniskelas` DISABLE KEYS */;
INSERT INTO `jeniskelas` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Reguler', NULL, NULL),
	(2, 'IHT', NULL, NULL),
	(3, 'Private Class', NULL, NULL),
	(4, 'Seminar', NULL, NULL),
	(5, 'Public Class', NULL, NULL),
	(6, 'Outbond', NULL, NULL);
/*!40000 ALTER TABLE `jeniskelas` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.materis
CREATE TABLE IF NOT EXISTS `materis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.materis: ~38 rows (approximately)
/*!40000 ALTER TABLE `materis` DISABLE KEYS */;
INSERT INTO `materis` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Business Acumen', NULL, NULL),
	(2, 'Business Etiquette', NULL, NULL),
	(3, 'Call Center', NULL, NULL),
	(4, 'Coaching & Mentoring', NULL, NULL),
	(5, 'Collection Management', NULL, NULL),
	(6, 'Commitment', NULL, NULL),
	(7, 'Communication Skill', NULL, NULL),
	(8, 'Creative Thinking Techniq', NULL, '2017-08-16 04:07:30'),
	(9, 'Effective Meeting', NULL, NULL),
	(10, 'Ekspresi Suara', NULL, NULL),
	(11, 'Emotional Intelligence', NULL, NULL),
	(12, 'Entrepreneurial Marketing', NULL, NULL),
	(13, 'Financial Planning', NULL, NULL),
	(14, 'Generation GAP', NULL, NULL),
	(15, 'Leadership Excellance', NULL, NULL),
	(16, 'Make up class', NULL, NULL),
	(17, 'Managerial Skill', NULL, NULL),
	(18, 'Maximize Your Strength', NULL, NULL),
	(19, 'Media Relation', NULL, NULL),
	(20, 'Negotiation Skill', NULL, NULL),
	(21, 'Presentation Skill', NULL, NULL),
	(22, 'Problem Solving - Decision Making', NULL, NULL),
	(23, 'Profesional Appearance', NULL, NULL),
	(24, 'Protokoler', NULL, NULL),
	(25, 'Public Relations', NULL, NULL),
	(26, 'Public Speaking', NULL, NULL),
	(27, 'Risk Management', NULL, NULL),
	(28, 'Role Awareness', NULL, NULL),
	(29, 'Secretary & P A Skill', NULL, NULL),
	(30, 'Selling Skills', NULL, NULL),
	(31, 'Service Excellance', NULL, NULL),
	(32, 'Smart Thinking (Skills for critical Understanding)', NULL, NULL),
	(33, 'Speed Thinking', NULL, NULL),
	(34, 'Stress Management', NULL, NULL),
	(35, 'Table Manners', NULL, NULL),
	(36, 'Total Image', NULL, NULL),
	(37, 'Train The Trainers', NULL, NULL),
	(38, 'Training Need Analysis', NULL, NULL);
/*!40000 ALTER TABLE `materis` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.migrations: ~6 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(13, '2014_10_12_000000_create_users_table', 1),
	(14, '2014_10_12_100000_create_password_resets_table', 1),
	(15, '2017_07_29_051432_laratrust_setup_tables', 1),
	(16, '2017_07_29_053958_create_materis_table', 1),
	(17, '2017_07_29_054021_create_jeniskelas_table', 1),
	(18, '2017_07_29_054034_create_pesertas_table', 1),
	(20, '2017_07_29_144819_create_pesertamateris_table', 2),
	(21, '2017_08_16_034228_create_jenisindustris_table', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('agung.adzo@gmail.com', '9a9cc48ef3dd0f671ffe82e4b6266189bf0a1f96efd9fbd0b5f88d784230bb09', '2017-07-30 09:26:09');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.permission_role: ~0 rows (approximately)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.pesertamateris
CREATE TABLE IF NOT EXISTS `pesertamateris` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `peserta_id` int(10) unsigned NOT NULL,
  `materi_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pesertamateris_peserta_id_index` (`peserta_id`),
  KEY `pesertamateris_materi_id_index` (`materi_id`),
  CONSTRAINT `pesertamateris_materi_id_foreign` FOREIGN KEY (`materi_id`) REFERENCES `materis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pesertamateris_peserta_id_foreign` FOREIGN KEY (`peserta_id`) REFERENCES `pesertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.pesertamateris: ~0 rows (approximately)
/*!40000 ALTER TABLE `pesertamateris` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesertamateris` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.pesertas
CREATE TABLE IF NOT EXISTS `pesertas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nis` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nohp` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jeniskelamin` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'laki-laki',
  `jeniskelas_id` int(10) unsigned NOT NULL,
  `tempatlahir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggallahir` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usia` int(3) DEFAULT NULL,
  `nohpdarurat` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamatlengkap` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `didaftarkanoleh` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mengetahuidb` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latarbelakang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `perusahaan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departemenpeserta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `leveljabatan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenisindustri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `universitas` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jurusan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `namasekolah` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggalpelaksanaan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `judulprogram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lokasipelaksanaan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kotapelaksanaan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `akuninstagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `materi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `posted_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edit_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pesertas_nis_unique` (`nis`),
  KEY `pesertas_id_jeniskelas_foreign` (`jeniskelas_id`),
  CONSTRAINT `pesertas_id_jeniskelas_foreign` FOREIGN KEY (`jeniskelas_id`) REFERENCES `jeniskelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.pesertas: ~3 rows (approximately)
/*!40000 ALTER TABLE `pesertas` DISABLE KEYS */;
INSERT INTO `pesertas` (`id`, `nama`, `nis`, `nohp`, `email`, `jeniskelamin`, `jeniskelas_id`, `tempatlahir`, `tanggallahir`, `usia`, `nohpdarurat`, `alamatlengkap`, `didaftarkanoleh`, `mengetahuidb`, `latarbelakang`, `perusahaan`, `departemenpeserta`, `jabatan`, `leveljabatan`, `jenisindustri`, `universitas`, `jurusan`, `namasekolah`, `tanggalpelaksanaan`, `judulprogram`, `lokasipelaksanaan`, `kotapelaksanaan`, `akuninstagram`, `materi`, `posted_by`, `edit_by`, `created_at`, `updated_at`) VALUES
	(16, 'use DateTime', 'REG-1608170001', '34535345', 'fdas@dsag.fsdf', 'perempuan', 1, 'use DateTime', '1985-06-04', 32, '34534534', 'use DateTime', 'perusahaan', 'use DateTime', 'bekerja', 'use DateTime', 'use DateTime', NULL, NULL, NULL, '', '', NULL, '2017-08-26', 'use DateTime', 'use DateTime', 'use DateTime', 'tetssst', 'Business Acumen, Entrepreneurial Marketing, Risk Management', 'Admin', NULL, '2016-06-19 03:00:30', '2017-08-16 13:00:30'),
	(17, 'sholeh', 'PRV-1608170002', '83448348', 'sholeh@gmail.com', 'laki-laki', 3, 'test tesssss', '1994-06-14', 23, '453534534', 'test tesssss', 'perusahaan', 'instagram', 'bekerja', 'test tesssss', 'test tesssss', 'test tesssss', 'fresh graduate', 'banking', '', '', '', '2017-08-18', 'test tesssss', 'test tesssss', 'test tesssss', 'dsfsdffsd', 'Coaching & Mentoring, Leadership Excellance, Role Awareness', 'Admin', NULL, '2016-08-16 13:06:06', '2017-08-16 13:06:06'),
	(18, 'udin', 'OBN-1608170003', '08127545453', 'shole@gmail.com', 'laki-laki', 6, '', '', 32, '', '', NULL, '', 'sekolah', '', '', 'test tesssss', '', 'banking', '', '', 'test', '2000-08-10', 'test tesssss', 'test tesssss', 'test tesssss', 'test tesssss', 'Protokoler, Smart Thinking (Skills for critical Understanding)', 'Admin', NULL, '2017-08-16 13:08:08', '2017-08-16 13:08:08');
/*!40000 ALTER TABLE `pesertas` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Admin', NULL, '2017-07-29 06:01:57', '2017-07-29 06:01:57'),
	(2, 'user', 'User', NULL, '2017-07-29 06:01:57', '2017-07-29 06:01:57');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.role_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
	(1, 1),
	(2, 2),
	(6, 2);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;


-- Dumping structure for table db_crud_member2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passview` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_crud_member2.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `passview`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin', 'agung.adzo@gmail.com', '$2y$10$hJLDWpkfbZzZveW/0wZWw.tbySEsmLSLJmMoZ4Vk3A5ioEWorDhkK', 'rahasia', 'OZ42pLRauoEu2R6FEvm5EfymdfA3B4is7sxp9fclEkdLFmDmZToMz1OVn3gY', '2017-07-29 06:01:58', '2017-08-23 05:54:00'),
	(2, 'Sample User', 'user', 'taviacorp@gmail.com', '$2y$10$yLcTDiH5mjUMXlIJm60Oz.FSizINSUsbeb7uTkXbPpB0Zxhy4ts1C', 'user', 'OWS0l2h1JSqUqrTf2BVVvM6LsF6soSuOx8cwMeXQhfjOHajXK8Pdliua02vx', '2017-07-29 06:01:58', '2017-08-19 05:23:23'),
	(6, 'Test User', 'testuser', 'test2@test.test', '$2y$10$5q52eI2p2PKmsOIsRMXEEOXwb3.mNMFEBzK8KD7QaCy9XBcXiuEgK', 'testuser', 'uKmtghR87oqh8UlE93l0vb4fnd5u6033RsTXCgksGywormpQ7j7rZdaR5o6Z', '2017-08-06 17:39:43', '2017-08-08 12:02:10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
