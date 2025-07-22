-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2025 at 09:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukdc_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','finished','rejected') NOT NULL DEFAULT 'pending',
  `url` varchar(255) NOT NULL,
  `sub_sub_criteria_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `commentator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `commented_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `user_id`, `status`, `url`, `sub_sub_criteria_id`, `comment`, `commentator_id`, `commented_at`) VALUES
(21, 22, 'finished', '5alFP2ZjoYa7L45mQAsW3lnjKAX25uOvYvGm6NKn.pdf', 8, NULL, NULL, '2025-07-22 17:10:12'),
(22, 22, 'pending', 'L0somNlXtzt6WED01QNdFdHNuZTAttkul9APe8oT.pdf', 18, NULL, NULL, '2025-07-23 00:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `archive_pengajaran`
--

CREATE TABLE `archive_pengajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengajaran_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `archive_pengajaran`
--

INSERT INTO `archive_pengajaran` (`id`, `pengajaran_id`, `path`) VALUES
(5, 11, 'K1MHaatcPhseVNfAz4vMXWAZjen9lcplqMWwbqPv.pdf'),
(6, 12, 'xlzEtxAfZCtsCqLua3daUUTsSzGKMnflTQQzwpi4.docx');

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_sub_criteria_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit`
--

INSERT INTO `credit` (`id`, `sub_sub_criteria_id`, `user_id`, `qty`) VALUES
(25, 8, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `credit_on_pos`
--

CREATE TABLE `credit_on_pos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_sub_criteria_id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `credit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_pengajaran`
--

CREATE TABLE `credit_pengajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kredit_pengajaran_mata_kuliah_id` bigint(20) UNSIGNED NOT NULL,
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `sks` int(11) NOT NULL,
  `type` enum('10 SKS Pertama','2 SKS Berikutnya') NOT NULL DEFAULT '10 SKS Pertama',
  `tahun_ajaran` varchar(255) NOT NULL,
  `kelompok` enum('Mandiri','Tim') NOT NULL DEFAULT 'Mandiri',
  `semester` enum('gasal','genap') NOT NULL DEFAULT 'gasal',
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_pengajaran`
--

INSERT INTO `credit_pengajaran` (`id`, `user_id`, `kredit_pengajaran_mata_kuliah_id`, `jurusan_id`, `sks`, `type`, `tahun_ajaran`, `kelompok`, `semester`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(11, 22, 9, 11, 3, '2 SKS Berikutnya', '2024', 'Mandiri', 'gasal', 'approved', '', '2025-07-22 10:12:12', '2025-07-22 10:13:37'),
(12, 22, 9, 11, 3, '10 SKS Pertama', '2025', 'Mandiri', 'gasal', 'pending', NULL, '2025-07-22 17:24:57', '2025-07-22 17:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id`, `name`) VALUES
(7, 'Pendidikan'),
(8, 'Penunjang');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `name`) VALUES
(6, 'Kepegawaian'),
(7, 'Staf TU'),
(8, 'Asisten Ahli'),
(9, 'Lektor'),
(10, 'Lektor Kepala'),
(11, 'Profesor');

-- --------------------------------------------------------

--
-- Table structure for table `kredit_pengajaran_mata_kuliah`
--

CREATE TABLE `kredit_pengajaran_mata_kuliah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `credit` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kredit_pengajaran_mata_kuliah`
--

INSERT INTO `kredit_pengajaran_mata_kuliah` (`id`, `jabatan_id`, `jurusan_id`, `name`, `credit`) VALUES
(9, 8, 11, 'Metode Penelitian', 0.50),
(10, 9, 11, 'Metode Penelitian', 1.00),
(11, 10, 11, 'Metode Penelitian', 1.00),
(12, 11, 11, 'Metode Penelitian', 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_03_06_042155_create_user_table', 1),
(7, '2025_03_25_211502_create_table_billboard', 6),
(8, '2025_03_25_212042_create_baliho', 7),
(9, '2025_03_25_212143_create_videotron', 8),
(10, '2025_03_25_212243_create_media_baliho', 9),
(11, '2025_03_25_212840_create_media_billboard', 10),
(12, '2025_03_25_212957_create_media_videotron', 11),
(13, '2025_03_25_214006_create_settings', 12),
(14, '2025_06_20_034132_create_criteria', 13),
(15, '2025_06_20_034240_create_sub_criteria', 14),
(16, '2025_06_20_034406_create_sub_sub_criteria', 15),
(17, '2025_06_20_034839_create_credit', 16),
(19, '2025_06_20_135709_create_archives', 17),
(20, '2025_06_28_203252_update_archives', 17),
(21, '2025_06_28_203818_update_archives_tabel', 18),
(22, '2025_06_28_223440_update_archives_table', 19),
(23, '2025_06_29_165109_create_jabatan', 20),
(24, '2025_06_29_171626_create_credit_on_pos', 21),
(25, '2025_07_06_131451_create_publikasi_karya', 22),
(44, '2025_07_06_225258_create_pengabdian', 23),
(45, '2025_07_06_225951_create_pengabdian_dokumen', 23),
(46, '2025_07_06_230058_create_pengabdian_anggota_dosen', 23),
(47, '2025_07_06_230138_create_pengabdian_anggota_mahasiswa', 23),
(48, '2025_07_06_230216_create_pengabdian_anggota_eksternal', 23),
(49, '2025_07_13_213212_create_poin_credit_umum', 23),
(54, '2025_07_13_220144_create_poin_credit_jenis', 24),
(55, '2025_07_13_220210_create_poin_credit_capaian', 24),
(56, '2025_07_13_222414_update_publikasi_karya', 24),
(57, '2025_07_13_234736_update_publikasi_karya', 25),
(58, '2025_07_13_235629_create_poin_credit_kegiatan', 26),
(59, '2025_07_14_000217_update_pengabdian', 27),
(60, '2025_07_14_000307_update_pengabdian', 28),
(61, '2025_07_14_131647_update_pengabdian_anggota_dosen', 29),
(65, '2025_07_14_154237_create_publikasi_karya_anggota_dosen', 30),
(66, '2025_07_14_154710_create_publikasi_karya_anggota_mahasiswa', 30),
(67, '2025_07_14_154921_create_publikasi_karya_anggota_eksternal', 30),
(68, '2025_07_20_095931_create_program_studi', 31),
(71, '2025_07_20_100933_update_user_relation_to_prodi', 32),
(74, '2025_07_20_125753_create_kredit_pengajara_mata_kuliah', 33),
(76, '2025_07_20_133607_create_credit_pengajaran', 34),
(77, '2025_07_21_103009_create_archive_pengajaran', 35);

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian`
--

CREATE TABLE `pengabdian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_kegiatan` varchar(255) NOT NULL,
  `affiliasi` varchar(255) NOT NULL,
  `kelompok_bidang` varchar(255) DEFAULT NULL,
  `litabmas_sebelumnya` varchar(255) DEFAULT NULL,
  `jenis_skim` varchar(255) DEFAULT NULL,
  `lokasi_kegiatan` varchar(255) DEFAULT NULL,
  `tahun_usulan` year(4) NOT NULL,
  `tahun_kegiatan` year(4) NOT NULL,
  `tahun_pelaksanaan` year(4) NOT NULL,
  `lama_kegiatan` int(11) NOT NULL,
  `dana_dikti` bigint(20) NOT NULL,
  `dana_pt` bigint(20) NOT NULL,
  `dana_lain` bigint(20) NOT NULL,
  `in_kind` varchar(255) DEFAULT NULL,
  `nama_mitra` varchar(255) DEFAULT NULL,
  `nomor_sk` varchar(255) DEFAULT NULL,
  `tanggal_sk` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','rejected','approved') NOT NULL DEFAULT 'pending',
  `review_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori_kegiatan` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengabdian`
--

INSERT INTO `pengabdian` (`id`, `judul_kegiatan`, `affiliasi`, `kelompok_bidang`, `litabmas_sebelumnya`, `jenis_skim`, `lokasi_kegiatan`, `tahun_usulan`, `tahun_kegiatan`, `tahun_pelaksanaan`, `lama_kegiatan`, `dana_dikti`, `dana_pt`, `dana_lain`, `in_kind`, `nama_mitra`, `nomor_sk`, `tanggal_sk`, `user_id`, `status`, `review_notes`, `created_at`, `updated_at`, `kategori_kegiatan`) VALUES
(12, 'Mengabdikan Mahasiswa Untuk Melayani Masyarakat', 'lembaga_pengabdian', 'sosial_masyarakat', 'hibah_internal', 'hibah_pt', 'Desa Pare', '2023', '2024', '2024', 1, 0, 10000000, 0, 'Penyediaan aplikasi bahasa penerjemah untuk belajar mandiri', 'Desa Pare', '123/KKN.02/2024', '2024-08-01', 22, 'pending', NULL, '2025-07-22 17:13:07', '2025-07-22 17:13:07', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_anggota_dosen`
--

CREATE TABLE `pengabdian_anggota_dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengabdian_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `peran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengabdian_anggota_dosen`
--

INSERT INTO `pengabdian_anggota_dosen` (`id`, `pengabdian_id`, `nama_dosen`, `peran`, `created_at`, `updated_at`, `user_id`) VALUES
(14, 12, 'Ryan Putranda Kristanto, M.Kom | 0518059203', 'ketua', '2025-07-22 17:13:07', '2025-07-22 17:13:07', 22);

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_anggota_eksternal`
--

CREATE TABLE `pengabdian_anggota_eksternal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengabdian_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `institusi` varchar(255) NOT NULL,
  `peran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengabdian_anggota_eksternal`
--

INSERT INTO `pengabdian_anggota_eksternal` (`id`, `pengabdian_id`, `nama`, `institusi`, `peran`, `created_at`, `updated_at`) VALUES
(8, 12, 'Ibu Cendy Linata', 'Desa Pare', 'fasilitator', '2025-07-22 17:13:07', '2025-07-22 17:13:07'),
(9, 12, 'Maria Angela', 'Desa Pare', 'mitra', '2025-07-22 17:13:07', '2025-07-22 17:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_anggota_mahasiswa`
--

CREATE TABLE `pengabdian_anggota_mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengabdian_id` bigint(20) UNSIGNED NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `peran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengabdian_anggota_mahasiswa`
--

INSERT INTO `pengabdian_anggota_mahasiswa` (`id`, `pengabdian_id`, `nama_mahasiswa`, `peran`, `created_at`, `updated_at`) VALUES
(10, 12, 'Dita Anggelia', 'ketua', '2025-07-22 17:13:07', '2025-07-22 17:13:07'),
(11, 12, 'Nathalie Audrea', 'asisten', '2025-07-22 17:13:07', '2025-07-22 17:13:07'),
(12, 12, 'Putri Meilyanti', 'anggota', '2025-07-22 17:13:07', '2025-07-22 17:13:07'),
(13, 12, 'Tsaniya Putri', 'surveyor', '2025-07-22 17:13:07', '2025-07-22 17:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_dokumen`
--

CREATE TABLE `pengabdian_dokumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengabdian_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dokumen` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `jenis_dokumen` varchar(255) NOT NULL,
  `tautan_dokumen` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengabdian_dokumen`
--

INSERT INTO `pengabdian_dokumen` (`id`, `pengabdian_id`, `nama_dokumen`, `keterangan`, `jenis_dokumen`, `tautan_dokumen`, `file_path`, `created_at`, `updated_at`) VALUES
(12, 12, '', '', 'surat_tugas', '', NULL, '2025-07-22 17:13:07', '2025-07-22 17:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `poin_credit_capaian`
--

CREATE TABLE `poin_credit_capaian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `credit` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poin_credit_capaian`
--

INSERT INTO `poin_credit_capaian` (`id`, `name`, `credit`, `created_at`, `updated_at`) VALUES
(2, 'Penulis Pertama', 10.00, '2025-07-22 10:52:08', '2025-07-22 10:52:08'),
(3, 'Penulis Kedua', 4.00, '2025-07-22 10:52:21', '2025-07-22 10:52:21'),
(4, 'Penulis Ketiga', 2.00, '2025-07-22 10:52:48', '2025-07-22 10:52:48'),
(5, 'Penulis Keempat', 1.30, '2025-07-22 10:53:24', '2025-07-22 10:53:24'),
(6, 'Penulis Kelima', 1.00, '2025-07-22 10:54:32', '2025-07-22 10:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `poin_credit_jenis`
--

CREATE TABLE `poin_credit_jenis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `credit` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poin_credit_jenis`
--

INSERT INTO `poin_credit_jenis` (`id`, `name`, `credit`, `created_at`, `updated_at`) VALUES
(3, 'Hasil penelitian dalam bentuk buku referensi', 40.00, '2025-07-22 10:33:20', '2025-07-22 10:33:20'),
(4, 'Hasil penelitian dalam bentuk buku monograf', 20.00, '2025-07-22 10:33:43', '2025-07-22 10:33:43'),
(5, 'Hasil penelitian atau hasil pemikiran dalam buku yang dipublikasikan Internasional', 15.00, '2025-07-22 10:50:31', '2025-07-22 10:50:31'),
(6, 'Hasil penelitian atau hasil pemikiran dalam buku yang dipublikasikan Nasional', 10.00, '2025-07-22 10:51:00', '2025-07-22 10:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `poin_credit_kegiatan`
--

CREATE TABLE `poin_credit_kegiatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `credit` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poin_credit_kegiatan`
--

INSERT INTO `poin_credit_kegiatan` (`id`, `name`, `credit`, `created_at`, `updated_at`) VALUES
(2, 'Menduduki jabatan pimpinan pada lembaga pemerintahan/pejabat negara yang harus dibebaskan dari jabatan organiknya tiap semester', 5.50, '2025-07-22 11:01:14', '2025-07-22 11:01:14'),
(3, 'Melaksanakan pengembangan hasil pendidikan dan penelitian yang dapat dimanfaatkan oleh masyarakat/industri setiap program', 3.00, '2025-07-22 11:01:57', '2025-07-22 11:01:57'),
(4, 'Memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram: Dalam satu semester atau lebih tingkat internasional tiap program', 4.00, '2025-07-22 11:03:27', '2025-07-22 11:03:27'),
(5, 'Memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram: Dalam satu semester atau lebih tingkat nasional tiap program', 3.00, '2025-07-22 11:03:43', '2025-07-22 11:03:43'),
(6, 'Memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram: Dalam satu semester atau lebih tingkat lokal tiap program', 2.00, '2025-07-22 11:04:03', '2025-07-22 11:04:03'),
(7, 'Memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram: Kurang dari satu semester dan minimal satu bulan tingkat internasional tiap program', 3.00, '2025-07-22 11:04:56', '2025-07-22 11:04:56'),
(8, 'Memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram: Kurang dari satu semester dan minimal satu bulan tingkat nasional tiap program', 2.00, '2025-07-22 11:05:11', '2025-07-22 11:05:11'),
(9, 'Memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram: Kurang dari satu semester dan minimal satu bulan tingkat lokal tiap program', 1.00, '2025-07-22 11:05:32', '2025-07-22 11:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `poin_credit_umum`
--

CREATE TABLE `poin_credit_umum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `credit` double(8,2) NOT NULL,
  `type` enum('penelitian','pengabdian') NOT NULL DEFAULT 'penelitian',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poin_credit_umum`
--

INSERT INTO `poin_credit_umum` (`id`, `name`, `credit`, `type`, `created_at`, `updated_at`) VALUES
(4, 'Jurnal Internasional bereputasi (terindeks pada database internasional bereputasi dan berfaktor dampak)', 40.00, 'penelitian', '2025-07-22 10:55:53', '2025-07-22 10:55:53'),
(5, 'Jurnal internasional terindeks pada basis data internasional bereputasi', 30.00, 'penelitian', '2025-07-22 10:56:30', '2025-07-22 10:56:30'),
(6, 'Jurnal internasional terindeks pada basis data internasional di luar kategori 2', 20.00, 'penelitian', '2025-07-22 10:57:13', '2025-07-22 10:57:13'),
(7, 'Jurnal Nasional terakreditasi DIKTI', 25.00, 'penelitian', '2025-07-22 10:57:56', '2025-07-22 10:57:56'),
(8, 'Jurnal nasional terakreditasi peringkat 1 dan 2', 25.00, 'penelitian', '2025-07-22 10:58:27', '2025-07-22 10:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id`, `name`) VALUES
(3, 'Tanpa Prodi'),
(5, 'Manajemen Pemasaran'),
(6, 'Manajemen Perhotelan'),
(7, 'Akuntansi'),
(8, 'Ilmu Hukum'),
(9, 'Teknik Industri'),
(10, 'Teknik Arsitektur'),
(11, 'Teknik Ilmu Informatika'),
(12, 'Akupuntur dan Pengobatan Herbal');

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_karya`
--

CREATE TABLE `publikasi_karya` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pk_1` tinyint(1) NOT NULL DEFAULT 0,
  `pk_2` tinyint(1) NOT NULL DEFAULT 0,
  `pk_3` tinyint(1) NOT NULL DEFAULT 0,
  `pk_4` tinyint(1) NOT NULL DEFAULT 0,
  `pk_5` tinyint(1) NOT NULL DEFAULT 0,
  `pk_6` tinyint(1) NOT NULL DEFAULT 0,
  `pk_7` tinyint(1) NOT NULL DEFAULT 0,
  `pk_8` tinyint(1) NOT NULL DEFAULT 0,
  `pk_9` tinyint(1) NOT NULL DEFAULT 0,
  `pk_10` tinyint(1) NOT NULL DEFAULT 0,
  `pk_11` tinyint(1) NOT NULL DEFAULT 0,
  `pk_12` tinyint(1) NOT NULL DEFAULT 0,
  `pk_13` tinyint(1) NOT NULL DEFAULT 0,
  `aktivitas_litabmas` varchar(255) DEFAULT NULL,
  `judul_artikel` varchar(255) NOT NULL,
  `nama_seminar` varchar(255) DEFAULT NULL,
  `tanggal_terbit` date NOT NULL,
  `penerbit_penyelenggara` varchar(255) NOT NULL,
  `kota_penyelenggaraan` varchar(255) DEFAULT NULL,
  `seminar` tinyint(1) NOT NULL DEFAULT 0,
  `prosiding` tinyint(1) NOT NULL DEFAULT 0,
  `bahasa` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `issn` varchar(255) DEFAULT NULL,
  `e_issn` varchar(255) DEFAULT NULL,
  `tautan_eksternal` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('pending','rejected','approved') NOT NULL DEFAULT 'pending',
  `review_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis_publikasi` bigint(20) UNSIGNED NOT NULL,
  `kategori_capaian` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publikasi_karya`
--

INSERT INTO `publikasi_karya` (`id`, `user_id`, `pk_1`, `pk_2`, `pk_3`, `pk_4`, `pk_5`, `pk_6`, `pk_7`, `pk_8`, `pk_9`, `pk_10`, `pk_11`, `pk_12`, `pk_13`, `aktivitas_litabmas`, `judul_artikel`, `nama_seminar`, `tanggal_terbit`, `penerbit_penyelenggara`, `kota_penyelenggaraan`, `seminar`, `prosiding`, `bahasa`, `isbn`, `issn`, `e_issn`, `tautan_eksternal`, `keterangan`, `status`, `review_notes`, `created_at`, `updated_at`, `jenis_publikasi`, `kategori_capaian`) VALUES
(14, 22, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'penelitian_dasar', 'Penerapan Interaksi Manusia dan Komputer Dalam Dunia Bisnis Marketing', '', '2025-01-28', 'Gramedia', 'Jakarta', 0, 0, 'Indonesia', '', '', '', '', '', 'approved', '-', '2025-07-22 17:02:09', '2025-07-22 17:23:50', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_karya_anggota_dosen`
--

CREATE TABLE `publikasi_karya_anggota_dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publikasi_karya_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `peran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publikasi_karya_anggota_dosen`
--

INSERT INTO `publikasi_karya_anggota_dosen` (`id`, `publikasi_karya_id`, `user_id`, `nama_dosen`, `peran`, `created_at`, `updated_at`) VALUES
(13, 14, 24, 'Citra Anggraini Tresyanto, S.E., M.M. | 0727128801', 'ketua', '2025-07-22 17:02:09', '2025-07-22 17:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_karya_anggota_eksternal`
--

CREATE TABLE `publikasi_karya_anggota_eksternal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publikasi_karya_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `institusi` varchar(255) NOT NULL,
  `peran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publikasi_karya_anggota_eksternal`
--

INSERT INTO `publikasi_karya_anggota_eksternal` (`id`, `publikasi_karya_id`, `nama`, `institusi`, `peran`, `created_at`, `updated_at`) VALUES
(9, 14, 'Maria Angela', 'Universitas Surabaya', 'mitra', '2025-07-22 17:02:09', '2025-07-22 17:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_karya_anggota_mahasiswa`
--

CREATE TABLE `publikasi_karya_anggota_mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publikasi_karya_id` bigint(20) UNSIGNED NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `peran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publikasi_karya_anggota_mahasiswa`
--

INSERT INTO `publikasi_karya_anggota_mahasiswa` (`id`, `publikasi_karya_id`, `nama_mahasiswa`, `peran`, `created_at`, `updated_at`) VALUES
(9, 14, 'Dita Anggelia', 'anggota', '2025-07-22 17:02:09', '2025-07-22 17:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `web_title` varchar(255) NOT NULL,
  `web_icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `web_title`, `web_icon`) VALUES
(1, 'Perhitungan Angka Kredit UKDC', '1750359012_Screenshot_133-removebg-preview (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `sub_criteria`
--

CREATE TABLE `sub_criteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criteria_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_criteria`
--

INSERT INTO `sub_criteria` (`id`, `criteria_id`, `name`) VALUES
(5, 7, 'Mengikuti Pendidikan Formal dan Memperoleh Gelar/Sebutan/Ijazah'),
(6, 7, 'Mengikuti Diklat prajabatan'),
(7, 7, 'Kegiatan pelaksanaan pendidikan untuk pendidikan dokter klinis'),
(8, 8, 'Menjadi anggota dalam suatu Panitia/Badan pada perguruan tinggi'),
(9, 8, 'Menjadi anggota/badan pada lembaga pemerintah');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_criteria`
--

CREATE TABLE `sub_sub_criteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_criteria_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `credit` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_sub_criteria`
--

INSERT INTO `sub_sub_criteria` (`id`, `sub_criteria_id`, `name`, `unit`, `credit`) VALUES
(8, 5, 'Doktor/Sederajat', 'Bukti tugas/izin belajar dan pindai ijazah asli', 200),
(9, 5, 'Magister/sederajat', 'Bukti tugas/izin belajar dan pindai ijazah asli', 150),
(10, 6, 'Golongan III', 'Bukti tugas/izin belajar dan pindai ijazah asli', 3),
(11, 7, 'Melakukan pengajaran untuk peserta pendidikan dokter melalui tindakan medik spesialistik', 'Pindai SK Penugasan dan bukti kinerja', 4),
(12, 7, 'Melakukan pengajaran konsultasi spesialis kepada peserta pendidikan dokter', 'Pindai SK Penugasan dan bukti kinerja', 2),
(13, 7, 'Melakukan pemeriksaan luar dengan pembimbingan terhadap peserta pendidikan dokter', 'Pindai SK Penugasan dan bukti kinerja', 2),
(14, 7, 'Melakukan pemeriksaan dalam dengan pembimbingan terhadap peserta pendidikan dokter', 'Pindai SK Penugasan dan bukti kinerja', 3),
(15, 7, 'Menjadi seksi ahli dengan pembimbingan terhadap peserta pendidikan dokter', 'Pindai SK Penugasan dan bukti kinerja', 1),
(16, 8, 'Sebagai Ketua/Wakil Ketua merangkap Anggota, tiap tahun', 'Bukti penunjang', 3),
(17, 8, 'Sebagai Anggota, tiap tahun', 'Bukti Penunjang', 2),
(18, 9, 'Panitia Pusat, sebagai Ketua/Wakil Ketua, tiap kepanitiaan', 'Bukti penunjang', 3),
(19, 9, 'Panitia Pusat, sebagai Anggota, tiap kepanitiaan', 'Bukti penunjang', 2),
(20, 9, 'Panitia Daerah, sebagai Ketua/Wakil Ketua, tiap kepanitiaan', 'Bukti penunjang', 2),
(21, 9, 'Panitia Daerah, sebagai Anggota, tiap kepanitiaan', 'Bukti penunjang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staf','dosen') NOT NULL DEFAULT 'dosen',
  `username` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seri_karpeg` varchar(255) NOT NULL,
  `tempat_tanggal_lahir` varchar(255) NOT NULL,
  `kredit_pendidikan_terhitung` varchar(255) NOT NULL,
  `pangkat` varchar(255) NOT NULL,
  `fakultas` varchar(255) NOT NULL,
  `universitas` varchar(255) NOT NULL,
  `jurusan` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `role`, `username`, `remember_token`, `created_at`, `updated_at`, `seri_karpeg`, `tempat_tanggal_lahir`, `kredit_pendidikan_terhitung`, `pangkat`, `fakultas`, `universitas`, `jurusan`) VALUES
(16, 'Birgitta Puji Ardhana Reswari, S.Psi., M.Si.', '$2y$12$2SWALcd86y42kMPVAM9mPuUypl4abA92QlegAklyRL67I5WDU6nOS', 'admin', '0020536', NULL, NULL, '2025-07-22 08:46:15', '-', '-', '-', 'Kepegawaian', '-', '-', 3),
(21, 'Margaretha Dwi Suprapti Setyaningrum, S.E.', '$2y$12$uRC5byTC/xSH9Zznh7H0LuJ8026hDqQ6igenRi5NLF7bYOxAL6Ave', 'staf', '0020588', NULL, '2025-07-22 09:05:19', '2025-07-22 09:18:57', '0020588', '-', '0', 'Staf TU', 'Teknik', 'Universitas Katolik Darma Cendika', 11),
(22, 'Ryan Putranda Kristanto, M.Kom', '$2y$12$16vPXRZuxQgsgQ07kUI9aO39S80Nz4ume7CvkKayAgr.zAkVtUsmi', 'dosen', '0518059203', NULL, '2025-07-22 09:07:32', '2025-07-22 09:19:09', '0518059203', 'Yogyakarta, 18 Mei 1992', '0', 'Asisten Ahli', 'Teknik', 'Universitas Katolik Darma Cendika', 11),
(23, 'Frasisca Novianti Ayulupita Sedho, S.E.', '$2y$12$xa4wDzpglF7dXN/Gdj64NONp14sFSo24ZZaP7LxvVekY44/.QAyLW', 'staf', '0020460', NULL, '2025-07-22 09:09:58', '2025-07-22 09:19:22', '0020460', '-', '0', 'Staf TU', 'Manajemen', 'Universitas Katolik Darma Cendika', 5),
(24, 'Citra Anggraini Tresyanto, S.E., M.M.', '$2y$12$FkMzYmQ3x41XlkTWCvJiveUHdp5PCXd0dbXJ7PyHzohG0Hj4G74nO', 'dosen', '0727128801', NULL, '2025-07-22 09:11:36', '2025-07-22 09:19:41', '0727128801', 'Surabaya, 27 Desember 1988', '0', 'Asisten Ahli', 'Manajemen', 'Universitas Katolik Darma Cendika', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_user_id_foreign` (`user_id`),
  ADD KEY `archives_sub_sub_criteria_id_foreign` (`sub_sub_criteria_id`),
  ADD KEY `archives_commentator_id_foreign` (`commentator_id`);

--
-- Indexes for table `archive_pengajaran`
--
ALTER TABLE `archive_pengajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archive_pengajaran_pengajaran_id_foreign` (`pengajaran_id`);

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_sub_sub_criteria_id_foreign` (`sub_sub_criteria_id`),
  ADD KEY `credit_user_id_foreign` (`user_id`);

--
-- Indexes for table `credit_on_pos`
--
ALTER TABLE `credit_on_pos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_on_pos_sub_sub_criteria_id_foreign` (`sub_sub_criteria_id`),
  ADD KEY `credit_on_pos_jabatan_id_foreign` (`jabatan_id`);

--
-- Indexes for table `credit_pengajaran`
--
ALTER TABLE `credit_pengajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_pengajaran_user_id_foreign` (`user_id`),
  ADD KEY `credit_pengajaran_kredit_pengajaran_mata_kuliah_id_foreign` (`kredit_pengajaran_mata_kuliah_id`),
  ADD KEY `credit_pengajaran_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kredit_pengajaran_mata_kuliah`
--
ALTER TABLE `kredit_pengajaran_mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kredit_pengajaran_mata_kuliah_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `kredit_pengajaran_mata_kuliah_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengabdian`
--
ALTER TABLE `pengabdian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengabdian_user_id_foreign` (`user_id`),
  ADD KEY `pengabdian_kategori_kegiatan_foreign` (`kategori_kegiatan`);

--
-- Indexes for table `pengabdian_anggota_dosen`
--
ALTER TABLE `pengabdian_anggota_dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengabdian_anggota_dosen_pengabdian_id_foreign` (`pengabdian_id`),
  ADD KEY `pengabdian_anggota_dosen_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengabdian_anggota_eksternal`
--
ALTER TABLE `pengabdian_anggota_eksternal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengabdian_anggota_eksternal_pengabdian_id_foreign` (`pengabdian_id`);

--
-- Indexes for table `pengabdian_anggota_mahasiswa`
--
ALTER TABLE `pengabdian_anggota_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengabdian_anggota_mahasiswa_pengabdian_id_foreign` (`pengabdian_id`);

--
-- Indexes for table `pengabdian_dokumen`
--
ALTER TABLE `pengabdian_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengabdian_dokumen_pengabdian_id_foreign` (`pengabdian_id`);

--
-- Indexes for table `poin_credit_capaian`
--
ALTER TABLE `poin_credit_capaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poin_credit_jenis`
--
ALTER TABLE `poin_credit_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poin_credit_kegiatan`
--
ALTER TABLE `poin_credit_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poin_credit_umum`
--
ALTER TABLE `poin_credit_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publikasi_karya`
--
ALTER TABLE `publikasi_karya`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publikasi_karya_user_id_foreign` (`user_id`),
  ADD KEY `publikasi_karya_jenis_publikasi_foreign` (`jenis_publikasi`),
  ADD KEY `publikasi_karya_kategori_capaian_foreign` (`kategori_capaian`);

--
-- Indexes for table `publikasi_karya_anggota_dosen`
--
ALTER TABLE `publikasi_karya_anggota_dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publikasi_karya_anggota_dosen_publikasi_karya_id_foreign` (`publikasi_karya_id`),
  ADD KEY `publikasi_karya_anggota_dosen_user_id_foreign` (`user_id`);

--
-- Indexes for table `publikasi_karya_anggota_eksternal`
--
ALTER TABLE `publikasi_karya_anggota_eksternal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publikasi_karya_anggota_eksternal_publikasi_karya_id_foreign` (`publikasi_karya_id`);

--
-- Indexes for table `publikasi_karya_anggota_mahasiswa`
--
ALTER TABLE `publikasi_karya_anggota_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publikasi_karya_anggota_mahasiswa_publikasi_karya_id_foreign` (`publikasi_karya_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_criteria`
--
ALTER TABLE `sub_criteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_criteria_criteria_id_foreign` (`criteria_id`);

--
-- Indexes for table `sub_sub_criteria`
--
ALTER TABLE `sub_sub_criteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_sub_criteria_sub_criteria_id_foreign` (`sub_criteria_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_jurusan_foreign` (`jurusan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `archive_pengajaran`
--
ALTER TABLE `archive_pengajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `credit_on_pos`
--
ALTER TABLE `credit_on_pos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `credit_pengajaran`
--
ALTER TABLE `credit_pengajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kredit_pengajaran_mata_kuliah`
--
ALTER TABLE `kredit_pengajaran_mata_kuliah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `pengabdian`
--
ALTER TABLE `pengabdian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengabdian_anggota_dosen`
--
ALTER TABLE `pengabdian_anggota_dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengabdian_anggota_eksternal`
--
ALTER TABLE `pengabdian_anggota_eksternal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengabdian_anggota_mahasiswa`
--
ALTER TABLE `pengabdian_anggota_mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pengabdian_dokumen`
--
ALTER TABLE `pengabdian_dokumen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `poin_credit_capaian`
--
ALTER TABLE `poin_credit_capaian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `poin_credit_jenis`
--
ALTER TABLE `poin_credit_jenis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `poin_credit_kegiatan`
--
ALTER TABLE `poin_credit_kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `poin_credit_umum`
--
ALTER TABLE `poin_credit_umum`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `publikasi_karya`
--
ALTER TABLE `publikasi_karya`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `publikasi_karya_anggota_dosen`
--
ALTER TABLE `publikasi_karya_anggota_dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `publikasi_karya_anggota_eksternal`
--
ALTER TABLE `publikasi_karya_anggota_eksternal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `publikasi_karya_anggota_mahasiswa`
--
ALTER TABLE `publikasi_karya_anggota_mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_criteria`
--
ALTER TABLE `sub_criteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_sub_criteria`
--
ALTER TABLE `sub_sub_criteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_commentator_id_foreign` FOREIGN KEY (`commentator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `archives_sub_sub_criteria_id_foreign` FOREIGN KEY (`sub_sub_criteria_id`) REFERENCES `sub_sub_criteria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `archives_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `archive_pengajaran`
--
ALTER TABLE `archive_pengajaran`
  ADD CONSTRAINT `archive_pengajaran_pengajaran_id_foreign` FOREIGN KEY (`pengajaran_id`) REFERENCES `credit_pengajaran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `credit`
--
ALTER TABLE `credit`
  ADD CONSTRAINT `credit_sub_sub_criteria_id_foreign` FOREIGN KEY (`sub_sub_criteria_id`) REFERENCES `sub_sub_criteria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `credit_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `credit_on_pos`
--
ALTER TABLE `credit_on_pos`
  ADD CONSTRAINT `credit_on_pos_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `credit_on_pos_sub_sub_criteria_id_foreign` FOREIGN KEY (`sub_sub_criteria_id`) REFERENCES `sub_sub_criteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `credit_pengajaran`
--
ALTER TABLE `credit_pengajaran`
  ADD CONSTRAINT `credit_pengajaran_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `program_studi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `credit_pengajaran_kredit_pengajaran_mata_kuliah_id_foreign` FOREIGN KEY (`kredit_pengajaran_mata_kuliah_id`) REFERENCES `kredit_pengajaran_mata_kuliah` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `credit_pengajaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kredit_pengajaran_mata_kuliah`
--
ALTER TABLE `kredit_pengajaran_mata_kuliah`
  ADD CONSTRAINT `kredit_pengajaran_mata_kuliah_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kredit_pengajaran_mata_kuliah_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `program_studi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengabdian`
--
ALTER TABLE `pengabdian`
  ADD CONSTRAINT `pengabdian_kategori_kegiatan_foreign` FOREIGN KEY (`kategori_kegiatan`) REFERENCES `poin_credit_kegiatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengabdian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengabdian_anggota_dosen`
--
ALTER TABLE `pengabdian_anggota_dosen`
  ADD CONSTRAINT `pengabdian_anggota_dosen_pengabdian_id_foreign` FOREIGN KEY (`pengabdian_id`) REFERENCES `pengabdian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengabdian_anggota_dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengabdian_anggota_eksternal`
--
ALTER TABLE `pengabdian_anggota_eksternal`
  ADD CONSTRAINT `pengabdian_anggota_eksternal_pengabdian_id_foreign` FOREIGN KEY (`pengabdian_id`) REFERENCES `pengabdian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengabdian_anggota_mahasiswa`
--
ALTER TABLE `pengabdian_anggota_mahasiswa`
  ADD CONSTRAINT `pengabdian_anggota_mahasiswa_pengabdian_id_foreign` FOREIGN KEY (`pengabdian_id`) REFERENCES `pengabdian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengabdian_dokumen`
--
ALTER TABLE `pengabdian_dokumen`
  ADD CONSTRAINT `pengabdian_dokumen_pengabdian_id_foreign` FOREIGN KEY (`pengabdian_id`) REFERENCES `pengabdian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `publikasi_karya`
--
ALTER TABLE `publikasi_karya`
  ADD CONSTRAINT `publikasi_karya_jenis_publikasi_foreign` FOREIGN KEY (`jenis_publikasi`) REFERENCES `poin_credit_jenis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `publikasi_karya_kategori_capaian_foreign` FOREIGN KEY (`kategori_capaian`) REFERENCES `poin_credit_capaian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `publikasi_karya_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `publikasi_karya_anggota_dosen`
--
ALTER TABLE `publikasi_karya_anggota_dosen`
  ADD CONSTRAINT `publikasi_karya_anggota_dosen_publikasi_karya_id_foreign` FOREIGN KEY (`publikasi_karya_id`) REFERENCES `publikasi_karya` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `publikasi_karya_anggota_dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `publikasi_karya_anggota_eksternal`
--
ALTER TABLE `publikasi_karya_anggota_eksternal`
  ADD CONSTRAINT `publikasi_karya_anggota_eksternal_publikasi_karya_id_foreign` FOREIGN KEY (`publikasi_karya_id`) REFERENCES `publikasi_karya` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `publikasi_karya_anggota_mahasiswa`
--
ALTER TABLE `publikasi_karya_anggota_mahasiswa`
  ADD CONSTRAINT `publikasi_karya_anggota_mahasiswa_publikasi_karya_id_foreign` FOREIGN KEY (`publikasi_karya_id`) REFERENCES `publikasi_karya` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_criteria`
--
ALTER TABLE `sub_criteria`
  ADD CONSTRAINT `sub_criteria_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_sub_criteria`
--
ALTER TABLE `sub_sub_criteria`
  ADD CONSTRAINT `sub_sub_criteria_sub_criteria_id_foreign` FOREIGN KEY (`sub_criteria_id`) REFERENCES `sub_criteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_jurusan_foreign` FOREIGN KEY (`jurusan`) REFERENCES `program_studi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
