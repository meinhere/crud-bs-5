-- phpMyAdmin SQL Dump
-- version 5.2.2-dev+20230411.85fa45ca32
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Apr 2023 pada 00.58
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xii_tkj1_31`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'sabil', 'password123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `nama_siswa` varchar(150) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `foto_siswa` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `aksi_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nisn`, `nama_siswa`, `jenis_kelamin`, `foto_siswa`, `alamat`, `aksi_id`) VALUES
(35, '120101', 'Sabil Ahmad', 'Laki-Laki', '6149e8a7dac37.jpg', 'Kec. Tanjunganom Kab. Nganjuk', 5),
(37, '120103', 'Charlie Gordan', 'Laki-Laki', '61a35e8868a82.jpg', 'Kec. Tanjunganom Kab. Nganjuk', 1),
(38, '120133', 'Berlian Dirga', 'Perempuan', '6149f2185b064.png', 'Kec. Prambon Kab. Nganjuk', 1),
(41, '120203', 'Ahmad Ersa', 'Perempuan', '6149e6756e27b.jpg', 'Kec. Prambon Kab. Nganjuk', 3),
(42, '120401', 'Jean Rosseld', 'Laki-Laki', 'boy.svg', 'Kec. Sawahan Kab. Sawahan\r\n', 1),
(44, '120403', 'Firda Urban', 'Perempuan', 'girl.svg', 'Kec. Jogomerto Kab. Nganjuk', 1),
(45, '129921', 'Polius Tusian', 'Laki-Laki', '6149f2cad0c1c.jpg', 'Kec. Baron Kab. Nganjuk', 1),
(48, '120789', 'Louis Pens', 'Laki-Laki', 'boy.svg', 'Kec. Ngadirejo Kab. Nganjuk', 1),
(86, '99876', 'Souie Reiloa', 'Laki-Laki', 'boy.svg', 'Jl. Bromo Ds. Warujayeng', 1),
(96, '9987645', 'Perlina Dewi', 'Perempuan', 'girl.svg', 'Kec. Sanggrahan Kab. Nganjuk', 1),
(101, '098872', 'Tira Belia', 'Perempuan', 'girl.svg', 'Kec. Ngalir Kato Kediri', 1),
(103, '123123', 'Dita Leni Kabel', 'Perempuan', 'girl.svg', 'Nganjuk', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
