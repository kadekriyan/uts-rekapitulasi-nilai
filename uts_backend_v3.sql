-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2024 pada 21.37
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts_backend_v3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `nik`, `password`, `nama`) VALUES
(1, '2023015056', '6cb1601ac0fa87d27e1d8ea9a9cab161', 'Riyan M.Kom'),
(2, '1234567890', '6cb1601ac0fa87d27e1d8ea9a9cab161', 'Kadek M.Kom');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `jeni_kelamin` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `prodi`, `jeni_kelamin`) VALUES
(1, '23.01.5056', 'Kadek Riyan Kusuma Putra', 'D3-Teknik Informatika', 'L'),
(2, '23.01.3948', 'Shenya Kartika', 'D3-Teknik Informatika', 'P'),
(3, '23.01.5059', 'Bara sabaraba', 'S1-Informatika', 'L'),
(4, '23.02.3978', 'Dindin Abadin', 'S1-Informatika', 'L'),
(5, '23.01.5311', 'Kiku kaki', 'D3-Teknik Informatika', 'L'),
(6, '22.24.2242', 'Gagat Destiaji', 'S1-Informatika', 'L');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `jml_diskusi` int(10) DEFAULT NULL,
  `persentase_diskusi` double DEFAULT NULL,
  `jml_praktikum` int(25) DEFAULT NULL,
  `persentase_praktikum` double DEFAULT NULL,
  `jml_responsi` int(25) DEFAULT NULL,
  `persentase_responsi` float DEFAULT NULL,
  `jml_uts` int(25) DEFAULT NULL,
  `persentase_uts` double DEFAULT NULL,
  `jml_uas` int(25) DEFAULT NULL,
  `persentase_uas` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `nama`, `dosen_id`, `jml_diskusi`, `persentase_diskusi`, `jml_praktikum`, `persentase_praktikum`, `jml_responsi`, `persentase_responsi`, `jml_uts`, `persentase_uts`, `jml_uas`, `persentase_uas`) VALUES
(1, 'Backend', 1, 14, 1, 13, 2, 2, 7.5, 1, 20, 1, 25),
(2, 'Struktur Data', 2, 14, 1, 13, 2, 2, 7.5, 1, 20, 1, 25),
(3, 'Statistika', 1, 14, 1, 13, 2, 2, 7.5, 1, 20, 1, 25),
(4, 'Desain grafis', 2, 14, 1, 13, 2, 2, 7.5, 1, 20, 1, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah_mahasiswa`
--

CREATE TABLE `mata_kuliah_mahasiswa` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `mata_kuliah_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mata_kuliah_mahasiswa`
--

INSERT INTO `mata_kuliah_mahasiswa` (`id`, `mahasiswa_id`, `mata_kuliah_id`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 3),
(4, 1, 2),
(5, 2, 1),
(6, 2, 4),
(7, 2, 3),
(8, 2, 2),
(9, 3, 1),
(10, 3, 4),
(11, 3, 3),
(12, 3, 2),
(13, 5, 1),
(14, 5, 2),
(15, 6, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_mata_kuliah_mahasiswa`
--

CREATE TABLE `nilai_mata_kuliah_mahasiswa` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_mata_kuliah` int(11) NOT NULL,
  `nilai` int(20) NOT NULL,
  `keterangan` text NOT NULL,
  `type` enum('diskusi','praktikum','responsi','uts','uas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_mata_kuliah_mahasiswa`
--

INSERT INTO `nilai_mata_kuliah_mahasiswa` (`id`, `id_mahasiswa`, `id_mata_kuliah`, `nilai`, `keterangan`, `type`) VALUES
(2, 2, 1, 78, 'diskusi 1', 'diskusi'),
(3, 3, 1, 98, 'dikusi 4', 'diskusi'),
(4, 4, 1, 70, 'diskusi 1', 'diskusi'),
(6, 1, 1, 89, 'Diskusi Studi kasus OOP', 'diskusi'),
(7, 1, 1, 89, 'Responsi backend', 'responsi'),
(8, 1, 1, 80, 'diskusi', 'diskusi'),
(9, 1, 1, 100, 'praktikum 1', 'praktikum'),
(10, 1, 1, 96, 'praktikum 2', 'praktikum'),
(23, 1, 1, 100, 'uas', 'uas'),
(24, 1, 1, 98, 'uts backend', 'uts'),
(25, 3, 1, 50, 'diskusi ke 2', 'diskusi'),
(26, 3, 1, 60, 'responsi', 'responsi'),
(27, 3, 1, 100, 'praktikum ke 1', 'praktikum');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indeks untuk tabel `mata_kuliah_mahasiswa`
--
ALTER TABLE `mata_kuliah_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `mata_kuliah_id` (`mata_kuliah_id`);

--
-- Indeks untuk tabel `nilai_mata_kuliah_mahasiswa`
--
ALTER TABLE `nilai_mata_kuliah_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_mata_kuliah` (`id_mata_kuliah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `mata_kuliah_mahasiswa`
--
ALTER TABLE `mata_kuliah_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `nilai_mata_kuliah_mahasiswa`
--
ALTER TABLE `nilai_mata_kuliah_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`);

--
-- Ketidakleluasaan untuk tabel `mata_kuliah_mahasiswa`
--
ALTER TABLE `mata_kuliah_mahasiswa`
  ADD CONSTRAINT `mata_kuliah_mahasiswa_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `mata_kuliah_mahasiswa_ibfk_2` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`);

--
-- Ketidakleluasaan untuk tabel `nilai_mata_kuliah_mahasiswa`
--
ALTER TABLE `nilai_mata_kuliah_mahasiswa`
  ADD CONSTRAINT `nilai_mata_kuliah_mahasiswa_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_mata_kuliah_mahasiswa_ibfk_2` FOREIGN KEY (`id_mata_kuliah`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
