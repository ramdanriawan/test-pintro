-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2023 at 05:39 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian_pintro`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` varchar(11) NOT NULL,
  `jam_masuk` varchar(5) NOT NULL,
  `jam_keluar` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `pegawai_id`, `tanggal`, `jam_masuk`, `jam_keluar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1705, 1010, '25-feb-2021', '18:57', '18:58', '2023-05-03 13:16:59', '2023-05-03 13:28:21', NULL),
(1706, 1011, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', '2023-05-03 13:29:02'),
(1707, 1012, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1708, 1013, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1709, 1014, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1710, 1015, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1711, 1016, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1712, 1017, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1713, 1018, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1714, 1019, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1715, 1020, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1716, 1021, '25-Feb-2021', '', '18:58', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1717, 1022, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1718, 1023, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1719, 1025, '25-Feb-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1720, 1026, '25-Feb-2021', '18:57', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1721, 1010, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1722, 1011, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1723, 1012, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1724, 1013, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1725, 1014, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1726, 1015, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1727, 1016, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1728, 1017, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1729, 1018, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1730, 1019, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1731, 1020, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1732, 1021, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1733, 1022, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1734, 1023, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1735, 1025, '07-Mar-2021', '', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1736, 1026, '07-Mar-2021', '19:02', '', '2023-05-03 13:16:59', '2023-05-03 13:16:59', NULL),
(1737, 1010, '25-feb-2021', '18:57', '18:58', '2023-05-03 13:23:48', '2023-05-03 13:23:48', NULL),
(1738, 1010, '25-feb-2021', '18:57', '18:58', '2023-05-03 13:24:58', '2023-05-03 13:24:58', NULL),
(1739, 1010, '25-feb-2021', '18:57', '18:58', '2023-05-04 02:20:33', '2023-05-04 02:20:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_permohonan` varchar(30) NOT NULL,
  `tanggal_mulai` varchar(11) NOT NULL,
  `tanggal_selesai` varchar(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `pegawai_id`, `nomor_permohonan`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`) VALUES
(1004, 1010, '01', '01-Feb-2021', '30-Feb-2021', 'keluar kota'),
(1005, 1010, '01', '01-Feb-2021', '30-Feb-2021', ''),
(1006, 1010, '01', '01-Feb-2021', '30-Feb-2021', '');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `gaji` mediumint(9) NOT NULL DEFAULT 0,
  `tunjangan` mediumint(9) NOT NULL DEFAULT 0,
  `bonus` mediumint(9) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama`, `gaji`, `tunjangan`, `bonus`) VALUES
(1, 'Guru', 1000000, 100000, 0),
(2, 'Kepala Sekolah', 1000000, 100000, 0),
(3, 'Tata Usaha', 1000000, 100000, 0),
(66, 'Jabatan 3', 10000, 10000, 1000000),
(67, 'Guru', 1000000, 100000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tanggal_lahir` varchar(11) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL,
  `agama` enum('Islam','Kristen Katolik','Kristen Protestan','Hindu','Budha') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `tgl_mulai_kerja` varchar(11) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `tanggal_lahir`, `tempat_lahir`, `jenis_kelamin`, `agama`, `alamat`, `no_telp`, `tgl_mulai_kerja`, `status`) VALUES
(1009, 'Andi Izzul Haq, S.Kom', '13-Mar-1996', 'Tangkit Baru', 'Laki - Laki', 'Islam', 'jln syekh muh said II RT 04', '082342134134', '01-Jan-2020', 'Aktif'),
(1010, 'Besse Aisyah, S.E', '16-Apr-1997', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 03', '085731615314', '01-Feb-2014', 'Aktif'),
(1011, 'Baso Sidik', '10-Sep-1996', 'Tangkit Baru', 'Laki - Laki', 'Islam', 'jln syekh muh said II RT 04', '08572625315', '15-Feb-2014', 'Aktif'),
(1012, 'Drs. Andi Pajung', '25-Okt-1989', 'Tangkit Baru', 'Laki - Laki', 'Islam', 'jln syekh muh said II RT 04', '085728316418', '10-Feb-2013', 'Aktif'),
(1013, 'Masturi,S.Ag', '31-Agu-1990', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 07', '0856353422', '04-Feb-2016', 'Aktif'),
(1014, 'Nur Aida', '16-Mar-1999', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 02', '081542637262', '10-Feb-2018', 'Aktif'),
(1015, 'Nur Atifa,S.Pd.I', '25-Des-1997', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 03', '085823721626', '03-Feb-2018', 'Aktif'),
(1016, 'Ratnawati,S.Pd', '10-Mar-1998', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 05', '0857429328328', '05-Feb-2016', 'Aktif'),
(1017, 'Dahlia, S.Pd', '07-Mar-1998', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 03', '085237283272', '02-Feb-2018', 'Aktif'),
(1018, 'Siti Sainab', '11-Mar-1998', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 06', '081234828328', '18-Feb-2018', 'Aktif'),
(1019, 'Hermawati,S.Fil.I', '18-Mei-1989', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 06', '08127433496', '08-Feb-2017', 'Aktif'),
(1020, 'Andi Nur Auliyyah,S.Pd', '20-Jun-1990', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 04', '085728323212', '16-Feb-2017', 'Aktif'),
(1021, 'Ahmad, S.Pd.I', '25-Okt-1980', 'Tangkit Baru', 'Laki - Laki', 'Islam', 'jln syekh muh said II RT 06', '082395283288', '06-Feb-2016', 'Aktif'),
(1022, 'Siti Juhria', '15-Jul-1999', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 07', '085788004395', '01-Feb-2020', 'Aktif'),
(1023, 'Rizki Indah Oktalia', '10-Okt-1998', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 06', '082283335849', '01-Feb-2020', 'Aktif'),
(1025, 'Andi Nur Wahidiah, S.Mat', '24-Nov-1988', 'Tangkit Baru', 'Perempuan', 'Islam', 'jln syekh muh said II RT 06', '08127364271', '15-Feb-2018', 'Aktif'),
(1026, 'Muhammad Ashari, S.Sos', '23-Agu-1980', 'muaro jambi', 'Laki - Laki', 'Islam', 'kota jambi', '081367714581', '01-Feb-2018', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian`
--

CREATE TABLE `penggajian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `gaji` mediumint(9) NOT NULL,
  `tunjangan` mediumint(9) NOT NULL,
  `bonus` mediumint(9) UNSIGNED NOT NULL,
  `periode` varchar(15) NOT NULL,
  `tahun` smallint(6) NOT NULL,
  `tanggal` varchar(11) NOT NULL,
  `catatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penggajian`
--

INSERT INTO `penggajian` (`id`, `pegawai_id`, `gaji`, `tunjangan`, `bonus`, `periode`, `tahun`, `tanggal`, `catatan`) VALUES
(60, 1010, 1000000, 100000, 0, 'Januari', 2020, '23-Feb-2020', '2020'),
(61, 1010, 1000000, 100000, 0, 'Januari', 2020, '23-Feb-2020', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_jabatan`
--

CREATE TABLE `riwayat_jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `gaji_jabatan` mediumint(9) UNSIGNED NOT NULL,
  `tunjangan_jabatan` mediumint(9) UNSIGNED NOT NULL,
  `bonus_jabatan` mediumint(9) UNSIGNED NOT NULL,
  `nomor_sk` varchar(30) NOT NULL,
  `tanggal` varchar(11) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_jabatan`
--

INSERT INTO `riwayat_jabatan` (`id`, `pegawai_id`, `nama_jabatan`, `gaji_jabatan`, `tunjangan_jabatan`, `bonus_jabatan`, `nomor_sk`, `tanggal`, `status`) VALUES
(10, 1009, 'Kepala Sekolah', 1000000, 100000, 0, 'SK-51/YPP-RM/VII/2020', '03-Feb-2020', 'Tidak Aktif'),
(13, 1010, 'Guru', 1000000, 100000, 0, '-', '01-Feb-2020', 'Aktif'),
(14, 1011, 'Guru', 1000000, 100000, 0, '-', '01-Feb-2019', 'Aktif'),
(15, 1012, 'Guru', 1000000, 100000, 0, '-', '02-Feb-2019', 'Aktif'),
(16, 1013, 'Guru', 1000000, 100000, 0, '-', '03-Feb-2017', 'Aktif'),
(17, 1014, 'Guru', 1000000, 100000, 0, '-', '02-Feb-2019', 'Aktif'),
(18, 1015, 'Guru', 1000000, 100000, 0, '-', '01-Feb-2018', 'Aktif'),
(19, 1016, 'Guru', 1000000, 100000, 0, '-', '03-Feb-2017', 'Aktif'),
(20, 1017, 'Guru', 1000000, 100000, 0, '-', '06-Feb-2016', 'Aktif'),
(21, 1018, 'Guru', 1000000, 100000, 0, '-', '02-Feb-2018', 'Aktif'),
(22, 1019, 'Guru', 1000000, 100000, 0, '-', '02-Feb-2018', 'Aktif'),
(23, 1020, 'Guru', 1000000, 100000, 0, '-', '02-Feb-2018', 'Aktif'),
(24, 1021, 'Guru', 1000000, 100000, 0, '420/YRM/MA//TB/2016', '01-Jul-2016', 'Aktif'),
(25, 1022, 'Guru', 1000000, 100000, 0, '-', '01-Feb-2020', 'Aktif'),
(26, 1023, 'Guru', 1000000, 100000, 0, '-', '02-Feb-2020', 'Aktif'),
(27, 1025, 'Guru', 1000000, 100000, 0, '-', '02-Feb-2018', 'Aktif'),
(28, 1026, 'Tata Usaha', 1000000, 100000, 0, '-', '01-Feb-2019', 'Aktif'),
(29, 1009, '', 0, 0, 0, '', '03-Feb-2020', '');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`, `created_at`, `updated_at`) VALUES
('YUqobqkoOGHqjjNwmeyHFexxHVbovs1b6hI7qt96', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 Edg/109.0.1518.78', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoidUlzNnNLVU9xdzMzRFExSGZnNWRpUFZCWUV3Nnh5c3d3cTAxNXdWcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6MTAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkd0p0eEhsMEhIbFJlc3dOSXd1Y0hLZUY1SUNaMHJjeDEubC5RU3l2VVJKSGtab1ZJTTgycjIiO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJHdKdHhIbDBISGxSZXN3Tkl3dWNIS2VGNUlDWjByY3gxLmwuUVN5dlVSSkhrWm9WSU04MnIyIjt9', 1683166224, '2023-05-04 02:10:24', '2023-05-04 02:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin1', 'admin@gmail.com', '$2y$10$wJtxHl0HHlReswNIwucHKeF5ICZ0rcx1.l.QSyvURJHkZoVIM82r2', '2023-05-03 13:05:16', '2023-05-03 13:05:16', NULL),
(3, 'Andi Izzul Haq, S.kom', 'kepsek@gmail.com', '$2y$10$m7u40c7A0027AemRnfBeluDg/MX4PIkf8VwPec5Y44zupdgdW3/3e', '2023-05-03 13:05:16', '2023-05-03 13:05:16', NULL),
(10, 'guru', 'guru@gmail.com', '$2a$10$UYBvEjI8uD.VdHm.f.0rdOE1O85B/.6/sT3m5o8eczAkZ5edl2/Xa', '2023-05-04 02:12:27', '2023-05-04 02:12:27', NULL),
(11, 'user test', 'usertest@gmail.com', '$2a$10$uxavhdVnkUGVfAEGnvSYv.T.Sq09qvY95k2clwWXM7TcKr4FQiEFC', '2023-05-04 02:17:47', '2023-05-04 02:17:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_id` (`pegawai_id`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuti_ibfk_1` (`pegawai_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_id` (`pegawai_id`);

--
-- Indexes for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_jabatan_ibfk_1` (`pegawai_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1740;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1028;

--
-- AUTO_INCREMENT for table `penggajian`
--
ALTER TABLE `penggajian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD CONSTRAINT `penggajian_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD CONSTRAINT `riwayat_jabatan_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
