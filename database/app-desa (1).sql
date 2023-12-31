-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 31 Des 2023 pada 08.25
-- Versi server: 8.0.30
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app-desa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id_admin` int NOT NULL,
  `username` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL COMMENT '1:admin 2:kur 3:kades',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  `status_aktif` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `email`, `password`, `role`, `created_at`, `last_login`, `status_aktif`) VALUES
(1, 'Administrator', 'admins@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-12-07 19:56:57', '2023-12-07 19:56:57', 1),
(2, 'Kaur Pelayanan', 'kaur@mail.com', '123456', 2, '2023-12-07 21:03:43', NULL, 1),
(3, 'Kepala Desa', 'kades@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, '2023-12-07 21:05:04', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita_kategori`
--

CREATE TABLE `berita_kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita_kategori`
--

INSERT INTO `berita_kategori` (`id_kategori`, `nama_kategori`, `status`) VALUES
(1, 'Artikel', 'Y'),
(2, 'Pengumuman', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_berita`
--

CREATE TABLE `data_berita` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('active','suspend') NOT NULL DEFAULT 'active',
  `thumbnail` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `kategori_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `data_berita`
--

INSERT INTO `data_berita` (`id`, `title`, `slug`, `content`, `status`, `thumbnail`, `updated_at`, `created_at`, `kategori_id`) VALUES
(5, 'teee', 'teee', '<table style=\"margin-left:5.4pt;border-collapse:collapse;border:none;\">\n    <tbody>\n        <tr>\n            <td rowspan=\"4\" style=\"width: 73.8pt;padding: 0mm 5.4pt;vertical-align: top;\">\n                <p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'>&nbsp;<img src=\"data:image/jpeg;base64,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\" style=\"width: 61.5pt; height: 73.5pt;\" alt=\"image\"></p>\n            </td>\n            <td style=\"width:464.85pt;padding:0mm 5.4pt 0mm 5.4pt;\">\n                <p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><span style=\'font-size:19px;font-family:  \"Times New Roman\",serif;\'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PEMERINTAH KABUPATEN KAMPAR</span></strong></p>\n            </td>\n        </tr>\n        <tr>\n            <td style=\"width:464.85pt;padding:0mm 5.4pt 0mm 5.4pt;\">\n                <p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:1.7pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><span style=\'font-size:19px;font-family:\"Times New Roman\",serif;\'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;KECAMATAN BANGKINANG KOTA</span></strong></p>\n            </td>\n        </tr>\n        <tr>\n            <td style=\"width:464.85pt;padding:0mm 5.4pt 0mm 5.4pt;\">\n                <p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:1.7pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><span style=\'font-size:37px;font-family:\"Times New Roman\",serif;\'>&nbsp; KEPALA DESA KUMANTAN</span></strong></p>\n            </td>\n        </tr>\n        <tr>\n            <td style=\"width:464.85pt;padding:0mm 5.4pt 0mm 5.4pt;\">\n                <p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:-94.2pt;line-height:115%;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:92.15pt;\'><span style=\'font-family:\"Times New Roman\",serif;\'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Alamat &nbsp; &nbsp;: Jl. Mahmud Marzuki No. &nbsp; &nbsp; &nbsp; Kumantan &nbsp; &nbsp; &nbsp; &nbsp; Kode &nbsp; &nbsp; Pos &nbsp;: 2845</span><span style=\'font-family:\"Times New Roman\",serif;\'>1</span></p>\n            </td>\n        </tr>\n    </tbody>\n</table>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><br></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><u><span style=\'font-size:19px;font-family:\"Arial\",sans-serif;\'><span style=\"text-decoration:none;\">&nbsp;</span></span></u></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:center;\'><strong><u><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>SURAT KETERANGAN TIDAK MAMPU</span></u></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:center;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>NOMOR :</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp; &nbsp;</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;&nbsp;</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;&nbsp;</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;&nbsp;</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>/SK-TM/KMT/20…</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:18.0pt;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:18.0pt;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Yang bertanda tangan dibawah &nbsp;ini:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:18.0pt;margin-bottom:0mm;margin-left:27.0pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:18.0pt;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;N a m a &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;: &nbsp;&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:18.0pt;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;\'><strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Jabatan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: &nbsp; &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:18.0pt;margin-bottom:0mm;margin-left:36.0pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:18.0pt;margin-bottom:10.0pt;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Dengan ini menerangkan bahwa</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>:</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:49.65pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>N a m a&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;</span><strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:49.65pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Jenis Kelamin&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;</span><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:49.65pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Tempat / Tgl lahir&nbsp; &nbsp;: &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:49.65pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Bangsa / Agama&nbsp; &nbsp; &nbsp;: &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:13.65pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Pekerjaan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:13.65pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Alamat&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;: &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:36.0pt;line-height:115%;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:13.65pt;\'><span style=\'font-size:16px;line-height:115%;font-family:\"Times New Roman\",serif;\'>No.KTP/NIK&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;:&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:13.65pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:18.0pt;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Adalah benar suami/istri/anak dari :</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:49.65pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:36.0pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:13.65pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;: &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:36.0pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:13.65pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Jenis Kelamin &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;: &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:13.65pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Tempat/Tgl Lahir&nbsp; &nbsp;: &nbsp;&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:13.65pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Bangsa / Agama&nbsp; &nbsp; &nbsp;: &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:13.65pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Pekerjaan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:13.65pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Alamat&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;: &nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:34.9pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:13.65pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>No.KTP/NIK&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;:&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:115%;font-size:15px;font-family:\"Calibri\",sans-serif;\'><span style=\'font-size:16px;line-height:115%;font-family:\"Times New Roman\",serif;color:black;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:13.65pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:7.1pt;margin-bottom:0mm;margin-left:0mm;line-height:150%;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:35.45pt;\'><span style=\'font-size:16px;line-height:150%;font-family:\"Times New Roman\",serif;\'>Nama yang tersebut di atas adalah Penduduk Desa Kumantan Kecamatan Bangkinang Kota Kabupaten Kampar menurut keterangan yang bersangkutan serta data – data yang diperdapat ianya benar <strong><em>tergolong kepada&nbsp;</em></strong></span><strong><em><span style=\'font-size:16px;line-height:150%;font-family:\"Times New Roman\",serif;\'>tidak mampu</span></em></strong><strong><span style=\'font-size:16px;line-height:150%;font-family:\"Times New Roman\",serif;\'>.</span></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:35.45pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Surat keterangan ini dipergunakan &nbsp;untuk :</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:72.0pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:36.0pt;\'><strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:center;text-indent:21.3pt;\'><strong><u><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>“ ……………………………………..’’</span></u></strong></p>\n<p style=\'margin-top:0mm;margin-right:18.0pt;margin-bottom:0mm;margin-left:36.0pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:21.25pt;margin-bottom:0mm;margin-left:0mm;line-height:150%;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:35.45pt;\'><span style=\'font-size:16px;line-height:150%;font-family:\"Times New Roman\",serif;\'>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat di pergunakan seperlunya .</span></p>\n<p style=\'margin-top:0mm;margin-right:18.0pt;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-align:justify;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:216.0pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:36.0pt;\'><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Di Keluarkan di : Kumantan</span></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:216.0pt;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;text-indent:36.0pt;\'><u><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>Pada tanggal&nbsp; &nbsp;&nbsp;&nbsp; : …………………</span></u></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; KEPALA DESA KUMANTA</span></strong><strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>N</span></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp;</span></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><u><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'><span style=\"text-decoration: none;\">&nbsp;</span></span></u></strong></p>\n<p style=\'margin-top:0mm;margin-right:0mm;margin-bottom:0mm;margin-left:0mm;line-height:normal;font-size:15px;font-family:\"Calibri\",sans-serif;\'><strong><span style=\'font-size:16px;font-family:\"Times New Roman\",serif;\'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <u>………………………</u></span></strong></p>', 'suspend', 'pexels-eberhard-grossgasteiger-1367192.jpg', '2023-12-18 18:53:53', '2023-12-18 18:10:20', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `halaman`
--

CREATE TABLE `halaman` (
  `id_halaman` int NOT NULL,
  `id_menu` int NOT NULL,
  `title_halaman` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `isi_halaman` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `is_statics` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug_name` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `template` set('row_text','card_profile','news') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link_redirect` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `halaman`
--

INSERT INTO `halaman` (`id_halaman`, `id_menu`, `title_halaman`, `isi_halaman`, `is_statics`, `slug_name`, `template`, `link_redirect`) VALUES
(1, 2, 'Visi Misi', '<p style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); margin-top: calc(1rem * calc(1 - var(--tw-space-y-reverse))); margin-right: 0px; margin-bottom: calc(1rem * var(--tw-space-y-reverse)); margin-left: 0px; --tw-space-y-reverse: 0; color: rgb(51, 65, 85); font-family: Inter, sans-serif; font-size: 16px;\"><span style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); font-weight: bolder;\">VISI</span></p><p style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); margin-top: calc(1rem * calc(1 - var(--tw-space-y-reverse))); margin-right: 0px; margin-bottom: calc(1rem * var(--tw-space-y-reverse)); margin-left: 0px; --tw-space-y-reverse: 0; color: rgb(51, 65, 85); font-family: Inter, sans-serif; font-size: 16px;\"><span style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); font-weight: bolder;\">BASIC BERBUSANA</span></p><p style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); margin-top: calc(1rem * calc(1 - var(--tw-space-y-reverse))); margin-right: 0px; margin-bottom: calc(1rem * var(--tw-space-y-reverse)); margin-left: 0px; --tw-space-y-reverse: 0; color: rgb(51, 65, 85); font-family: Inter, sans-serif; font-size: 16px;\">Barurejo, Aman, Sehat, Indah, Cerdas, Ber Budaya, Ber Saing, Ber Akhlaq Mulia dan Nasionalis</p><p style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); margin-top: calc(1rem * calc(1 - var(--tw-space-y-reverse))); margin-right: 0px; margin-bottom: calc(1rem * var(--tw-space-y-reverse)); margin-left: 0px; --tw-space-y-reverse: 0; color: rgb(51, 65, 85); font-family: Inter, sans-serif; font-size: 16px;\"><span style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); font-weight: bolder;\">MISI</span></p><ol><li style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); padding-top: 0.125rem; padding-bottom: 0.125rem;\">Meningkatkan kehidupan yang harmonis, toleran, saling menghormati dalam kehidupan beragama dan berbudaya di desa Barurejo</li><li style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); padding-top: 0.125rem; padding-bottom: 0.125rem;\">Mewujudkan keamanan dan ketertiban dilingkungan desa Barurejo</li><li style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); padding-top: 0.125rem; padding-bottom: 0.125rem;\">Meningkatkan kesehatan, kebersihan desa serta mengusahakan Jaminan Kesehatan Masyarakat melalui program pemerintah.</li><li style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); padding-top: 0.125rem; padding-bottom: 0.125rem;\">Mewujudkan dan meningkatkan serta meneruskan tata kelola pemerintahan Desa yang telah berjalan baik.</li><li style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); padding-top: 0.125rem; padding-bottom: 0.125rem;\">Meningkatkan pelayanan yang maksimal ( Administrasi Kependudukan, Perizinan sampai Sertifikasi Pertanahan ) kepada masyarakat desa dan meningkatkan daya saing desa.</li><li style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); padding-top: 0.125rem; padding-bottom: 0.125rem;\">Meningkatkan kesejahteraan masyarakat desa dengan mengoptimalkan Badan Usaha Milik Desa (BUMDes) dan program lain untuk membuka lapangan kerja bagi masyarakat desa, serta meningkatkan produksi rumahtangga kecil dan Peningkatan Kapasitas Keluarga Miskin.</li><li style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); padding-top: 0.125rem; padding-bottom: 0.125rem;\">Meningkatkan sarana dan prasarana baik dari segi fisik maupun non fisik pada bidang pertanian, pendidikan, kesehatan, perekonomian, olahraga dan kebudayaan di desa.</li><li style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); padding-top: 0.125rem; padding-bottom: 0.125rem;\">Berupaya mengedepankan kejujuran, keadilan, transparansi dalam kehidupan sehari – hari baik dalam pemerintahan maupun dengan masyarakat desa.</li><li style=\"border-width: 0px; border-style: solid; border-color: rgb(229 231 235 / var(--tw-border-opacity)); --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); --tw-border-opacity: 1; --tw-ring-inset: var(--tw-empty, ); --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: var(--tw-empty, ); --tw-brightness: var(--tw-empty, ); --tw-contrast: var(--tw-empty, ); --tw-grayscale: var(--tw-empty, ); --tw-hue-rotate: var(--tw-empty, ); --tw-invert: var(--tw-empty, ); --tw-saturate: var(--tw-empty, ); --tw-sepia: var(--tw-empty, ); --tw-drop-shadow: var(--tw-empty, ); --tw-filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); padding-top: 0.125rem; padding-bottom: 0.125rem;\">Meningkatkan peran serta dan peran aktif lembaga-lembaga desa ( PKK, LPMD, KPMD, Karang Tanura dan lembaga lainnya)</li></ol>', 'N', 'visi-misi', 'row_text', ''),
(2, 2, 'Sejarah Desa', '<h2 style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; line-height: 42px; color: rgb(29, 33, 39); margin-right: 0px; margin-bottom: 32px; margin-left: 0px; font-size: 2.2em; letter-spacing: -1px;\">Sejarah Desa</h2><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; color: rgb(119, 119, 119); line-height: 24px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><span style=\"font-weight: 700;\">Menu Sejarah Desa,&nbsp;</span><span style=\"font-size: 13px;\">&nbsp;adalah menu yang berisi content informasi terkait sejarah desa, dimana didalamnya terdapat informasi bagaimana awal desa itu terbentuk,&nbsp;</span><em>Desa adalah desa dan desa adat atau yang disebut dengan nama lain, selanjutnya disebut Desa, adalah kesatuan masyarakat hukum yang memiliki batas wilayah yang berwenang untuk mengatur dan mengurus urusan pemerintahan, kepentingan masyarakat setempat berdasarkan prakarsa masyarakat, hak asal usul, dan/atau hak tradisional yang diakui dan dihormati dalam sistem pemerintahan Negara Kesatuan Republik Indonesia</em><span style=\"font-size: 13px;\">&nbsp;</span></p><h2 style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; line-height: 42px; color: rgb(29, 33, 39); margin-right: 0px; margin-bottom: 32px; margin-left: 0px; font-size: 2.2em; letter-spacing: -1px;\">Pembentukan Desa&nbsp;</h2><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; color: rgb(119, 119, 119); line-height: 24px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Desa dibentuk atas prakarsa masyarakat dengan memperhatikan asal usul desa dan kondisi sosial budaya masyarakat setempat. Pembentukan desa dapat berupa penggabungan beberapa desa, atau bagian desa yang bersandingan, atau pemekaran dari satu desa menjadi dua desa atau lebih, atau pembentukan desa di luar desa yang telah ada.</p><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; color: rgb(119, 119, 119); line-height: 24px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Desa dapat diubah atau disesuaikan statusnya menjadi kelurahan berdasarkan prakarsa Pemerintah Desa bersama BPD dengan memperhatikan saran dan pendapat masyarakat setempat. Desa yang berubah menjadi Kelurahan, Lurah dan Perangkatnya diisi dari pegawai negeri sipil.</p><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; color: rgb(119, 119, 119); line-height: 24px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Desa yang berubah statusnya menjadi Kelurahan, kekayaannya menjadi kekayaan daerah dan dikelola oleh kelurahan yang bersangkutan untuk kepentingan masyarakat setempat.</p><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; color: rgb(119, 119, 119); line-height: 24px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Desa mempunyai ciri budaya khas atau adat istiadat lokal yang sangat urgen,</p>', 'N', 'sejarah-desa', 'row_text', ''),
(3, 3, 'Perangkat Desa', '', 'Y', 'perangkat-desa', 'card_profile', ''),
(4, 4, 'Berita', '', 'Y', 'berita', 'news', ''),
(6, 3, 'Struktur Organinsasi', '<p><img src=\"http://localhost:8800/assets/uploads/halaman/image.png\" style=\"width: 100%;\"><br></p>', 'N', 'struktur-organisasi', 'row_text', ''),
(10, 0, 'tess', '', 'Y', 'tess', 'row_text', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak_sites`
--

CREATE TABLE `kontak_sites` (
  `id_kontak` int NOT NULL,
  `jenis_media` enum('facebook','instagram','telepon','alamat','youtube','email','twitter') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_kontak` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kontak_sites`
--

INSERT INTO `kontak_sites` (`id_kontak`, `jenis_media`, `link`, `nama_kontak`, `keterangan`) VALUES
(1, 'alamat', '', 'Alamat', '82VP+GQG, Kumantan, Kec. Bangkinang, Kabupaten Kampar, Riau 28463'),
(2, 'telepon', '', 'Telepon', '082297256177'),
(3, 'instagram', 'oiusafjlasf', 'Instagram', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_sites`
--

CREATE TABLE `menu_sites` (
  `id_menu` int NOT NULL,
  `nama_menu` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `dinamic_pages` enum('Y','N') COLLATE utf8mb4_general_ci NOT NULL,
  `link_menu` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu_sites`
--

INSERT INTO `menu_sites` (`id_menu`, `nama_menu`, `dinamic_pages`, `link_menu`, `urut`) VALUES
(1, 'Beranda', 'N', '', 1),
(2, 'Profile Desa', 'Y', '-', 2),
(3, 'Pemerintahan', 'Y', '-', 3),
(4, 'Layanan Publik', 'Y', '-', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `metadata_surat`
--

CREATE TABLE `metadata_surat` (
  `id_metadata` int NOT NULL,
  `id_jenis_surat` int NOT NULL,
  `fields` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `metadata_surat`
--

INSERT INTO `metadata_surat` (`id_metadata`, `id_jenis_surat`, `fields`) VALUES
(1, 1, '[{\"name\": \"namausaha\", \"type\": \"text\", \"label\": \"Nama Usaha\", \"options\": false, \"required\": true}, {\"name\": \"alamatusaha\", \"type\": \"textarea\", \"label\": \"Alamat Usaha\", \"options\": false, \"required\": true}, {\"name\": \"kepentingansurat\", \"type\": \"textarea\", \"label\": \"Kepentingan Surat\", \"options\": false, \"required\": true}]'),
(5, 2, '[{\"name\": \"nama\", \"type\": \"text\", \"label\": \"Nama\", \"options\": false, \"required\": true}, {\"name\": \"jeniskelamin\", \"type\": \"radio\", \"label\": \"Jenis Kelamin\", \"options\": [\"Laki-laki\", \"Perempuan\"], \"required\": true}, {\"name\": \"tempatlahir\", \"type\": \"text\", \"label\": \"Tempat Lahir\", \"options\": false, \"required\": true}, {\"name\": \"tanggallahir\", \"type\": \"date\", \"label\": \"Tanggal Lahir\", \"options\": false, \"required\": true}, {\"name\": \"bangsa\", \"type\": \"text\", \"label\": \"Bangsa\", \"options\": false, \"required\": true}, {\"name\": \"agama\", \"type\": \"select\", \"label\": \"Agama\", \"options\": [\"Islam\", \"kristen\", \"Budha\"], \"required\": true}, {\"name\": \"alamatterakhir\", \"type\": \"textarea\", \"label\": \"Alamat Terakhir\", \"options\": false, \"required\": true}, {\"name\": \"pekerjaan\", \"type\": \"text\", \"label\": \"Pekerjaan\", \"options\": false, \"required\": true}, {\"name\": \"nonik\", \"type\": \"text\", \"label\": \"No NIK\", \"options\": false, \"required\": true}, {\"name\": \"tanggalmeninggal\", \"type\": \"date\", \"label\": \"Tanggal Meninggal\", \"options\": false, \"required\": true}, {\"name\": \"penyebabmeninggal\", \"type\": \"textarea\", \"label\": \"Penyebab Meninggal\", \"options\": false, \"required\": true}, {\"name\": \"lokasimeninggal\", \"type\": \"text\", \"label\": \"lokasi meninggal\", \"options\": false, \"required\": true}]'),
(6, 3, '[{\"name\": \"tangallahir\", \"type\": \"date\", \"label\": \"Tangal Lahir\", \"options\": false, \"required\": true}, {\"name\": \"tempatlahir\", \"type\": \"text\", \"label\": \"Tempat Lahir\", \"options\": false, \"required\": true}, {\"name\": \"jeniskelamin\", \"type\": \"radio\", \"label\": \"Jenis Kelamin\", \"options\": [\"Laki-Laki\", \"Perempuan\"], \"required\": true}, {\"name\": \"namaanak\", \"type\": \"text\", \"label\": \"Nama Anak\", \"options\": false, \"required\": true}, {\"name\": \"alamat\", \"type\": \"textarea\", \"label\": \"Alamat\", \"options\": false, \"required\": true}, {\"name\": \"noktpnik\", \"type\": \"text\", \"label\": \"No KTPNIK\", \"options\": false, \"required\": true}, {\"name\": \"namaortupria\", \"type\": \"text\", \"label\": \"Nama Ortu Pria\", \"options\": false, \"required\": true}, {\"name\": \"tempatlahirortupria\", \"type\": \"text\", \"label\": \"Tempat Lahir Ortu Pria\", \"options\": false, \"required\": true}, {\"name\": \"tanggallahirortupria\", \"type\": \"date\", \"label\": \"Tanggal Lahir Ortu Pria\", \"options\": false, \"required\": true}, {\"name\": \"bangsaortupria\", \"type\": \"text\", \"label\": \"Bangsa Ortu Pria\", \"options\": false, \"required\": true}, {\"name\": \"agamaortupria\", \"type\": \"select\", \"label\": \"Agama Ortu Pria\", \"options\": [\"Islam\", \"Kristen\", \"Budha\", \"Hindu\"], \"required\": true}, {\"name\": \"pekerjaanortupria\", \"type\": \"text\", \"label\": \"Pekerjaan Ortu Pria\", \"options\": false, \"required\": true}, {\"name\": \"alamatortupria\", \"type\": \"text\", \"label\": \"Alamat Ortu Pria\", \"options\": false, \"required\": true}, {\"name\": \"nonikortupria\", \"type\": \"text\", \"label\": \"No NIK Ortu Pria\", \"options\": false, \"required\": true}, {\"name\": \"namaortuwanita\", \"type\": \"text\", \"label\": \"Nama Ortu Wanita\", \"options\": false, \"required\": true}, {\"name\": \"tempatlahirortuwanita\", \"type\": \"text\", \"label\": \"Tempat Lahir Ortu Wanita\", \"options\": false, \"required\": true}, {\"name\": \"tangallahirortuwanita\", \"type\": \"date\", \"label\": \"Tangal Lahir Ortu Wanita\", \"options\": false, \"required\": true}, {\"name\": \"bangsaortuwanita\", \"type\": \"text\", \"label\": \"Bangsa Ortu Wanita\", \"options\": false, \"required\": true}, {\"name\": \"agamaortuwanita\", \"type\": \"select\", \"label\": \"Agama Ortu Wanita\", \"options\": [\"Islam\", \"Kristen\", \"Budha\", \"Hindu\"], \"required\": true}, {\"name\": \"alamatortuwanita\", \"type\": \"text\", \"label\": \"Alamat Ortu Wanita\", \"options\": false, \"required\": true}, {\"name\": \"nonikortuwanita\", \"type\": \"text\", \"label\": \"No NIK Ortu Wanita\", \"options\": false, \"required\": true}, {\"name\": \"pekerjaanortuwanita\", \"type\": \"text\", \"label\": \"pekerjaan Ortu Wanita\", \"options\": false, \"required\": true}]'),
(7, 5, '[{\"name\": \"nama\", \"type\": \"text\", \"label\": \"Nama\", \"options\": false, \"required\": true}, {\"name\": \"jeniskelamin\", \"type\": \"radio\", \"label\": \"Jenis Kelamin\", \"options\": [\"Laki-Laki\", \"Perempuan\"], \"required\": true}, {\"name\": \"tempatlahir\", \"type\": \"text\", \"label\": \"Tempat Lahir\", \"options\": false, \"required\": true}, {\"name\": \"tanggallahir\", \"type\": \"date\", \"label\": \"Tanggal Lahir\", \"options\": false, \"required\": true}, {\"name\": \"bangsa\", \"type\": \"text\", \"label\": \"Bangsa\", \"options\": false, \"required\": true}, {\"name\": \"agama\", \"type\": \"select\", \"label\": \"Agama\", \"options\": [\"Islam\", \"Kristen\", \"Budha\", \"Hindu\"], \"required\": true}, {\"name\": \"alamat\", \"type\": \"textarea\", \"label\": \"Alamat\", \"options\": false, \"required\": true}, {\"name\": \"nonik\", \"type\": \"text\", \"label\": \"No NIK\", \"options\": false, \"required\": true}, {\"name\": \"kegunaansurat\", \"type\": \"textarea\", \"label\": \"Kegunaan Surat\", \"options\": false, \"required\": true}, {\"name\": \"pekerjaan\", \"type\": \"text\", \"label\": \"pekerjaan\", \"options\": false, \"required\": true}]'),
(8, 6, '[{\"name\": \"nama\", \"type\": \"text\", \"label\": \"Nama\", \"options\": false, \"required\": true}, {\"name\": \"jeniskelamin\", \"type\": \"radio\", \"label\": \"Jenis Kelamin\", \"options\": [\"Laki-Laki\", \"Perempuan\"], \"required\": true}, {\"name\": \"tempatlahir\", \"type\": \"text\", \"label\": \"Tempat Lahir\", \"options\": false, \"required\": true}, {\"name\": \"tanggallahir\", \"type\": \"date\", \"label\": \"Tanggal Lahir\", \"options\": false, \"required\": true}, {\"name\": \"bangsa\", \"type\": \"text\", \"label\": \"Bangsa\", \"options\": false, \"required\": true}, {\"name\": \"agama\", \"type\": \"select\", \"label\": \"Agama\", \"options\": [\"Islam\", \"Kristen\", \"Budha\", \"Hindu\"], \"required\": true}, {\"name\": \"alamat\", \"type\": \"textarea\", \"label\": \"Alamat\", \"options\": false, \"required\": true}, {\"name\": \"nonik\", \"type\": \"text\", \"label\": \"No NIK\", \"options\": false, \"required\": true}, {\"name\": \"kegunaansurat\", \"type\": \"textarea\", \"label\": \"Kegunaan Surat\", \"options\": false, \"required\": true}, {\"name\": \"pekerjaan\", \"type\": \"text\", \"label\": \"pekerjaan\", \"options\": false, \"required\": true}]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20231118035244);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `bangsa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pekerjaan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `no_ktp_nik` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hapus` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `bangsa`, `pekerjaan`, `alamat`, `no_ktp_nik`, `agama`, `hapus`) VALUES
(1, 'Alexa-a', 'P', 'Bangkinang', '2022-01-12', 'Indonesia', 'Wiraswasta', 'Bangkinang', '44453324423', 'Islam', 0),
(2, 'Alexa-2', 'P', 'Bangkinang', '2022-01-13', 'Indonesia', 'Wiraswasta', 'Bangkinang', '44453324555', 'Islam', 0),
(3, 'Alexa-3', 'P', 'Bangkinang', '2022-01-14', 'Indonesia', 'Wiraswasta', 'Bangkinang', '44453325435', 'Islam', 0),
(4, 'Alexa-4', 'P', 'Bangkinang', '2022-01-15', 'Indonesia', 'Wiraswasta', 'Bangkinang', '44453326785', 'Islam', 0),
(5, 'Alexa-5', 'P', 'Bangkinang', '2022-01-16', 'Indonesia', 'Wiraswasta', 'Bangkinang', '44453326654', 'Islam', 0),
(6, 'Mahdiawan Nurkholifah', 'P', 'Tess', '2023-12-06', 'indonesia', 'Frelance', 'tessss', '34534453445', 'Islam', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id_pengajuan` int NOT NULL,
  `id_penduduk` int DEFAULT NULL,
  `id_surat` int NOT NULL,
  `id_metadata` int DEFAULT NULL,
  `data_surat` json DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Prosess' COMMENT 'Prosess,Pending,Tolak,Selesai',
  `keterangan` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `validasi_kades` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Prosess' COMMENT 'Prosess,Pending,Tolak,Terima',
  `signatur_kode` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_signatur` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id_pengajuan`, `id_penduduk`, `id_surat`, `id_metadata`, `data_surat`, `tanggal_pengajuan`, `status`, `keterangan`, `validasi_kades`, `signatur_kode`, `tanggal_signatur`) VALUES
(1, 1, 1, 1, '{\"namausaha\": \"sfasd\", \"alamatusaha\": \"dasdfa\", \"kepentingansurat\": \"sdfasd\"}', '2023-12-07', 'Prosess', ' Permohonan Anda Sudah Di Setujui dan selesai, Silahkan Download File untuk dipergunakan\r\n                            ', 'Pending', '00930439090392148010380194', '2023-12-07'),
(2, 1, 2, 5, '{\"nama\": \"Reprehenderit recusandae illum.\", \"agama\": \"Budha\", \"nonik\": \"546\", \"bangsa\": \"Pariatur expedita necessitatibus.\", \"pekerjaan\": \"Beatae minima voluptatum neque aspernatur.\", \"tempatlahir\": \"Et dolorem repudiandae nulla.\", \"jeniskelamin\": \"Perempuan\", \"tanggallahir\": \"Debitis blanditiis optio.\", \"alamatterakhir\": \"dgsdfsgf\", \"lokasimeninggal\": \"Bangkinang\", \"tanggalmeninggal\": \"2023-12-04\", \"penyebabmeninggal\": \"Odio eum voluptatibus ad voluptatem laborum expedita corrupti ad.\"}', '2023-12-07', 'Selesai', 'Permohonan Anda Di tolak Dikaranekan Persyartan Tidak sesuai atau tidak lengkap Mohon Untuk Mengajukan Ulang Kembali\r\n          ', 'Terima', '988374590-23945-345', '2023-12-08'),
(4, 1, 3, 6, '{\"alamat\": \"Maiores numquam architecto at nulla explicabo.\", \"namaanak\": \"Quasi eum laborum.\", \"noktpnik\": \"636\", \"tangallahir\": \"2022-12-19\", \"tempatlahir\": \"Magnam iusto omnis eaque iste.\", \"jeniskelamin\": \"Perempuan\", \"namaortupria\": \"Laudantium dolorum\", \"agamaortupria\": \"Budha\", \"nonikortupria\": \"463456\", \"alamatortupria\": \"Eaque numquam voluptatum\", \"bangsaortupria\": \"Alias voluptates\", \"namaortuwanita\": \"Odit voluptatum \", \"agamaortuwanita\": \"Hindu\", \"nonikortuwanita\": \"456456\", \"alamatortuwanita\": \"Rerum adipisci veniam.\", \"bangsaortuwanita\": \"Quos\", \"pekerjaanortupria\": \"Minus ipsa sunt\", \"pekerjaanortuwanita\": \"Autem dsfaf\", \"tempatlahirortupria\": \"Tenetur similique quas id.\", \"tanggallahirortupria\": \"2023-02-28\", \"tangallahirortuwanita\": \"2023-04-25\", \"tempatlahirortuwanita\": \"Facilis corporis \"}', '2023-12-09', 'Selesai', 'Permohonan Anda Sudah Di Setujui dan selesai, Silahkan Download File untuk dipergunakan\r\n                            ', 'Terima', '6129824279699607', '2023-12-09'),
(5, 1, 5, 7, '{\"nama\": \"Parlin Siregar, SE\", \"agama\": \"Islam\", \"nonik\": \"12344123243\", \"alamat\": \"tesssss\", \"bangsa\": \"indonesia\", \"pekerjaan\": \"Beatae minima voluptatum neque aspernatur.\", \"tempatlahir\": \"Et dolorem repudiandae nulla.\", \"jeniskelamin\": \"Laki-Laki\", \"tanggallahir\": \"2023-12-28\", \"kegunaansurat\": \"tesssss\"}', '2023-12-28', 'Prosess', NULL, 'Prosess', NULL, NULL),
(6, 1, 6, 8, '{\"nama\": \"Parlin Siregar, SE\", \"agama\": \"Islam\", \"nonik\": \"098878768689\", \"alamat\": \"tess\", \"bangsa\": \"indonesia\", \"pekerjaan\": \"tessss\", \"tempatlahir\": \"Et dolorem repudiandae nulla.\", \"jeniskelamin\": \"Laki-Laki\", \"tanggallahir\": \"2023-12-31\", \"kegunaansurat\": \"tessss\"}', '2023-12-31', 'Prosess', NULL, 'Prosess', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_surat_file`
--

CREATE TABLE `pengajuan_surat_file` (
  `id_file_surat` int NOT NULL,
  `id_pengajuan` int NOT NULL,
  `id_syarat_surat` int NOT NULL,
  `file` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengajuan_surat_file`
--

INSERT INTO `pengajuan_surat_file` (`id_file_surat`, `id_pengajuan`, `id_syarat_surat`, `file`) VALUES
(1, 1, 1, '7416acb306852c0c640ad6b94288c83d.pdf'),
(2, 1, 2, NULL),
(3, 1, 3, NULL),
(4, 1, 4, NULL),
(5, 1, 5, NULL),
(6, 1, 6, NULL),
(7, 1, 7, NULL),
(8, 1, 8, NULL),
(9, 1, 9, NULL),
(10, 1, 10, 'df94c137ba3120aa136a982dde89b5e9.pdf'),
(11, 2, 12, 'a95fed65d7600ddb89e2edd08640196b.pdf'),
(12, 2, 13, NULL),
(13, 2, 14, NULL),
(14, 2, 15, 'c48eeff1c007d6c1967f9a786bdf07e8.pdf'),
(15, 2, 16, NULL),
(16, 2, 17, NULL),
(17, 2, 18, NULL),
(23, 4, 19, 'f2f074988ecd9e8206d9d288c44d15c1.pdf'),
(24, 4, 20, '57cf7671d225c530a78898926779d767.pdf'),
(25, 4, 21, NULL),
(26, 4, 22, NULL),
(27, 4, 23, NULL),
(28, 5, 24, 'b56244fad1fb38dac6518258c4594c5b.PNG'),
(29, 5, 25, NULL),
(30, 5, 26, NULL),
(31, 5, 27, NULL),
(32, 6, 28, '6f75bc02d10174dc0c8d87ee7ce5dec7.pdf'),
(33, 6, 29, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perangkat_desa`
--

CREATE TABLE `perangkat_desa` (
  `id_perangkat` int NOT NULL,
  `nama_lengkap` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `nipd` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perangkat_desa`
--

INSERT INTO `perangkat_desa` (`id_perangkat`, `nama_lengkap`, `jabatan`, `nipd`, `foto`) VALUES
(1, 'sfsdf', 'sdfasd', '34221', '1.png'),
(2, 'sfsdf', 'sdfab sdaf', '342213232453', '7.png'),
(3, 'sfasdafd', 'afdsafsaf', '235434', '61.png'),
(4, 'cari aja sendiri namanya', 'Resepsionis', '345234678u53442345', '5.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_sites`
--

CREATE TABLE `setting_sites` (
  `id_sites` int NOT NULL,
  `title_situs` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_situs` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `logo_situs` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `is_logo` enum('yes','no') COLLATE utf8mb4_general_ci NOT NULL,
  `is_text_logo` enum('yes','no') COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `setting_sites`
--

INSERT INTO `setting_sites` (`id_sites`, `title_situs`, `nama_situs`, `logo_situs`, `is_logo`, `is_text_logo`, `deskripsi`) VALUES
(1, 'Desa Kumantan', 'Desa Kumantan', '-', 'no', 'yes', 'Kumantan merupakan salah satu desa yang ada di kecamatan Bangkinang Kota, Kabupaten Kampar, provinsi Riau, Indonesia.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_jenis`
--

CREATE TABLE `surat_jenis` (
  `id_surat_jenis` int NOT NULL,
  `nama_surat` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8mb4_general_ci NOT NULL,
  `format_penomoran` varchar(25) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_jenis`
--

INSERT INTO `surat_jenis` (`id_surat_jenis`, `nama_surat`, `slug`, `deskripsi`, `status`, `format_penomoran`) VALUES
(1, 'Surat Keterangan Usaha', 'surat-keterangan-usaha', '<p style=\"box-sizing: inherit; border: 0px; font-family: Roboto, sans-serif; font-size: 16px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; color: rgb(81, 86, 94);\">Terdapat beberapa dokumen yang dijadikan sebagai persyaratan membuat SKU desa yaitu:</p><ul style=\"box-sizing: inherit; border: 0px; font-family: Roboto, sans-serif; font-size: 16px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px; padding: 0px; vertical-align: baseline; list-style-position: inside; list-style-image: initial; color: rgb(81, 86, 94);\"><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">Surat permohonan yang menyatakan kebenaran data</li><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">Surat permohonan yang bermaterai</li><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">Identitas pemohon berupa KTP. KK dan&nbsp;<a href=\"https://kledo.com/blog/cara-mudah-membuat-npwp-pribadi/\" style=\"box-sizing: inherit; border: 0px; font-family: inherit; font-style: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; color: rgb(254, 102, 25);\">NPWP</a></li><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">Surat pengantar RT dan RW</li><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">KTP asli pihak yang diberi kuasa</li><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">Surat kuasa apabila pengajuan SKU diwakilken pihak ketiga</li><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">Surat pernyataan bahwa pemohon tidak berjualan di trotoar dan badan jalan</li><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">Surat pernyataan dari pemohon bahwa bisnisnya tidak akan mengganggu kegiatan lain</li><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">Foto lokasi bisnis</li><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">Surat perjanjian sewa lokasi usaha (bangunan dan tanah)</li><li style=\"box-sizing: inherit; border: 0px; font-style: inherit; margin: 0px 0px 10px 14px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 26px; list-style: disc;\">Surat pernyataan bahwa pemilik asli lokasi tidak keberatan asetnya dijadikan sebagai tempat usaha</li></ul>', 'Y', '/SK-U/KMT/'),
(2, 'Surat Keterangan Kematian', 'surat-keterangan-kematian', 'tfsd', 'Y', '/SK-K/KMT/'),
(3, 'Surat Keterangan Kelahiran', 'surat-keterangan-kelahiran', 'fsdfad', 'Y', '/SK-L/KMT/'),
(5, 'Surat Keteranga Tidak Mampu', 'Surat-Keteranga-Tidak-Mampu', '<p>-</p>', 'Y', '/SK-TM/KMT/'),
(6, 'Surat Keterangan', 'Surat-Keterangan', '<p>-</p>', 'Y', '/SK/KMT/ ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_jenis_syarat`
--

CREATE TABLE `surat_jenis_syarat` (
  `id_syarat_surat` int NOT NULL,
  `id_surat` int NOT NULL,
  `nama_syarat` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_jenis_syarat`
--

INSERT INTO `surat_jenis_syarat` (`id_syarat_surat`, `id_surat`, `nama_syarat`) VALUES
(1, 1, 'Identitas pemohon berupa KTP. KK dan NPWP'),
(2, 1, 'Surat pengantar RT dan RW'),
(3, 1, 'KTP asli pihak yang diberi kuasa'),
(4, 1, 'Surat kuasa apabila pengajuan SKU diwakilken pihak ketiga'),
(5, 1, 'Surat pernyataan bahwa pemohon tidak berjualan di trotoar dan badan jalan'),
(6, 1, 'Surat pernyataan dari pemohon bahwa bisnisnya tidak akan mengganggu kegiatan lain'),
(7, 1, 'Foto lokasi bisnis'),
(8, 1, 'Surat perjanjian sewa lokasi usaha (bangunan dan tanah)'),
(9, 1, 'Surat pernyataan bahwa pemilik asli lokasi tidak keberatan asetnya dijadikan sebagai tempat usaha'),
(10, 1, 'Surat permohonan yang bermaterai'),
(12, 2, 'Surat Pengantar RT diketahui RW'),
(13, 2, 'KTP Asli Yang Meninggal'),
(14, 2, 'KK Dimana Yang Meninggal Terdaftar'),
(15, 2, 'Surat Keterangan Kematian dari Dokter/Rumah Sakit/Kepolisian'),
(16, 2, 'Fotocopy KTP Elektronik Pelapor/Pemohon'),
(17, 2, 'Surat Tanda Melapor diri (STMD) dari Kepolisian Bagi Warga Negara Asing (WNA)'),
(18, 2, 'Rekomendasi dari Kantor Kesbangpolinmas Bagi Warga Negara Asing (WNA)'),
(19, 3, 'Surat Keterangan Lahir dari Dokter/Bidan/Penolong Kelahiran (asli)'),
(20, 3, 'KK asli'),
(21, 3, 'Fotokopi KTP-El orang tua (Pelapor adalah ayah atau ibu kandung)'),
(22, 3, 'Fotokopi KTP-El dua orang saksi'),
(23, 3, 'Surat Kuasa dari orang tua kandung apabila pelapor dikuasakan, disertai fokopi KTP-El penerima kuasa'),
(24, 5, 'Surat Pengantar RT/RW.'),
(25, 5, 'Foto Copy E-ktp elektronik (KTP)'),
(26, 5, 'Foto Copy Kartu Keluarga (KK)'),
(27, 5, 'Kartu identitas warga miskin dan formulir verifikasi warga miskin.'),
(28, 6, 'Pengantar RT dan RW'),
(29, 6, 'Fotocopy KTP dan KK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_layout`
--

CREATE TABLE `surat_layout` (
  `id_layout` int NOT NULL,
  `id_surat` int NOT NULL,
  `data_layout` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_layout`
--

INSERT INTO `surat_layout` (`id_layout`, `id_surat`, `data_layout`) VALUES
(1, 1, '[[{\"h\": 5, \"w\": 0, \"ln\": 1, \"txt\": \"Yang bertandatangan dibawah ini\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"L\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}], [{\"h\": 2, \"type\": \"ln\"}], [{\"h\": 5, \"w\": 15, \"ln\": 0, \"txt\": \"\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}, {\"h\": 5, \"w\": 35, \"ln\": 0, \"txt\": \"Nama\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}, {\"h\": 5, \"w\": 0, \"ln\": 1, \"txt\": \": Masri Dalmi, S.Sos\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}], [{\"h\": 5, \"w\": 15, \"ln\": 0, \"txt\": \"\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}, {\"h\": 5, \"w\": 35, \"ln\": 0, \"txt\": \"Jabatan\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}, {\"h\": 5, \"w\": 0, \"ln\": 1, \"txt\": \": Kepala Desa Kumantan\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}], [{\"h\": 2, \"type\": \"ln\"}], [{\"h\": 5, \"w\": 0, \"ln\": 1, \"txt\": \"Dengan ini menerangkan bahwa :\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"L\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}], [{\"h\": 2, \"type\": \"ln\"}], [{\"h\": 5, \"w\": 15, \"ln\": 0, \"txt\": \"\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}, {\"h\": 5, \"w\": 35, \"ln\": 0, \"txt\": \"Nama\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}, {\"h\": 5, \"w\": 0, \"ln\": 1, \"txt\": \": Masri Dalmi, S.Sos\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}], [{\"h\": 5, \"w\": 15, \"ln\": 0, \"txt\": \"\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}, {\"h\": 5, \"w\": 35, \"ln\": 0, \"txt\": \"Jenis Kelamin\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}, {\"h\": 5, \"w\": 0, \"ln\": 1, \"txt\": \": Kepala Desa Kumantan\", \"fill\": false, \"link\": \"\", \"type\": \"cell\", \"align\": \"\", \"border\": 0, \"calign\": \"T\", \"valign\": \"M\", \"stretch\": 0, \"ignore_min_height\": false}]]');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_permohonan_surat`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_permohonan_surat` (
`id_pengajuan` int
,`id_penduduk` int
,`id_surat` int
,`id_metadata` int
,`data_surat` json
,`tanggal_pengajuan` date
,`status` varchar(50)
,`vkades` varchar(128)
,`keterangan` varchar(128)
,`nama` varchar(100)
,`no_ktp_nik` varchar(20)
,`nama_surat` varchar(128)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_permohonan_surat`
--
DROP TABLE IF EXISTS `v_permohonan_surat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_permohonan_surat`  AS SELECT `a`.`id_pengajuan` AS `id_pengajuan`, `a`.`id_penduduk` AS `id_penduduk`, `a`.`id_surat` AS `id_surat`, `a`.`id_metadata` AS `id_metadata`, `a`.`data_surat` AS `data_surat`, `a`.`tanggal_pengajuan` AS `tanggal_pengajuan`, `a`.`status` AS `status`, `a`.`validasi_kades` AS `vkades`, `a`.`keterangan` AS `keterangan`, `b`.`nama` AS `nama`, `b`.`no_ktp_nik` AS `no_ktp_nik`, `c`.`nama_surat` AS `nama_surat` FROM ((`pengajuan_surat` `a` join `penduduk` `b` on((`a`.`id_penduduk` = `b`.`id_penduduk`))) join `surat_jenis` `c` on((`a`.`id_surat` = `c`.`id_surat_jenis`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `berita_kategori`
--
ALTER TABLE `berita_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `data_berita`
--
ALTER TABLE `data_berita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `halaman`
--
ALTER TABLE `halaman`
  ADD PRIMARY KEY (`id_halaman`);

--
-- Indeks untuk tabel `kontak_sites`
--
ALTER TABLE `kontak_sites`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indeks untuk tabel `menu_sites`
--
ALTER TABLE `menu_sites`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `metadata_surat`
--
ALTER TABLE `metadata_surat`
  ADD PRIMARY KEY (`id_metadata`);

--
-- Indeks untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`);

--
-- Indeks untuk tabel `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `id_penduduk` (`id_penduduk`,`id_metadata`);

--
-- Indeks untuk tabel `pengajuan_surat_file`
--
ALTER TABLE `pengajuan_surat_file`
  ADD PRIMARY KEY (`id_file_surat`);

--
-- Indeks untuk tabel `perangkat_desa`
--
ALTER TABLE `perangkat_desa`
  ADD PRIMARY KEY (`id_perangkat`);

--
-- Indeks untuk tabel `setting_sites`
--
ALTER TABLE `setting_sites`
  ADD PRIMARY KEY (`id_sites`);

--
-- Indeks untuk tabel `surat_jenis`
--
ALTER TABLE `surat_jenis`
  ADD PRIMARY KEY (`id_surat_jenis`);

--
-- Indeks untuk tabel `surat_jenis_syarat`
--
ALTER TABLE `surat_jenis_syarat`
  ADD PRIMARY KEY (`id_syarat_surat`);

--
-- Indeks untuk tabel `surat_layout`
--
ALTER TABLE `surat_layout`
  ADD PRIMARY KEY (`id_layout`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `berita_kategori`
--
ALTER TABLE `berita_kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_berita`
--
ALTER TABLE `data_berita`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `halaman`
--
ALTER TABLE `halaman`
  MODIFY `id_halaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kontak_sites`
--
ALTER TABLE `kontak_sites`
  MODIFY `id_kontak` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `menu_sites`
--
ALTER TABLE `menu_sites`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `metadata_surat`
--
ALTER TABLE `metadata_surat`
  MODIFY `id_metadata` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id_pengajuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_surat_file`
--
ALTER TABLE `pengajuan_surat_file`
  MODIFY `id_file_surat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `perangkat_desa`
--
ALTER TABLE `perangkat_desa`
  MODIFY `id_perangkat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `setting_sites`
--
ALTER TABLE `setting_sites`
  MODIFY `id_sites` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_jenis`
--
ALTER TABLE `surat_jenis`
  MODIFY `id_surat_jenis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `surat_jenis_syarat`
--
ALTER TABLE `surat_jenis_syarat`
  MODIFY `id_syarat_surat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `surat_layout`
--
ALTER TABLE `surat_layout`
  MODIFY `id_layout` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
