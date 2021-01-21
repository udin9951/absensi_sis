-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jul 2020 pada 11.57
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `nis` varchar(4) NOT NULL,
  `id_semester` int(1) NOT NULL,
  `wali_kelas` int(10) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `bulan` varchar(20) DEFAULT NULL,
  `jam_absen1` datetime DEFAULT NULL,
  `jam_absen2` datetime DEFAULT NULL,
  `jam_absen3` datetime DEFAULT NULL,
  `latitude1` varchar(50) DEFAULT NULL,
  `longitude1` varchar(50) DEFAULT NULL,
  `latitude2` varchar(50) DEFAULT NULL,
  `latitude3` varchar(50) DEFAULT NULL,
  `longitude2` varchar(50) DEFAULT NULL,
  `longitude3` varchar(50) DEFAULT NULL,
  `status_absen1` int(5) DEFAULT NULL,
  `status_absen2` int(5) DEFAULT NULL,
  `status_absen3` int(5) DEFAULT NULL,
  `cek_absen1` int(5) DEFAULT NULL,
  `cek_absen2` int(5) DEFAULT NULL,
  `cek_absen3` int(5) DEFAULT NULL,
  `konfirmasi` int(5) DEFAULT NULL,
  `absen` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id_absen`, `nis`, `id_semester`, `wali_kelas`, `tanggal`, `bulan`, `jam_absen1`, `jam_absen2`, `jam_absen3`, `latitude1`, `longitude1`, `latitude2`, `latitude3`, `longitude2`, `longitude3`, `status_absen1`, `status_absen2`, `status_absen3`, `cek_absen1`, `cek_absen2`, `cek_absen3`, `konfirmasi`, `absen`) VALUES
(22, '1001', 1, NULL, '2020-07-23', 'July', NULL, '2020-07-23 16:44:55', NULL, NULL, NULL, '-6.289019199999999', NULL, '106.82508229999999', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '1002', 1, NULL, '2020-07-23', 'July', '2020-07-23 16:53:10', NULL, NULL, '-6.2890555', '106.82503919999999', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(4) NOT NULL,
  `nopeg` varchar(15) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `wali_kelas` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nopeg`, `nama`, `wali_kelas`, `password`) VALUES
(7, '619022', 'Udin', '03', 'e172dd95f4feb21412a692e73929961e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(2) NOT NULL,
  `kelas` varchar(32) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`, `status`) VALUES
('03', 'XII IPA 1', NULL),
('04', 'XII IPS 10', NULL),
('05', 'XII TKJ 2', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(1) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `semester`
--

INSERT INTO `semester` (`id_semester`, `status`) VALUES
(1, 'Y'),
(2, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_kelas` varchar(2) NOT NULL,
  `wali_kelas` varchar(50) DEFAULT NULL,
  `latitude_rumah` varchar(50) DEFAULT NULL,
  `longitude_rumah` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `id_kelas`, `wali_kelas`, `latitude_rumah`, `longitude_rumah`) VALUES
('1001', 'ABIMANYU KURNIADI', '04', '619022', '-6.2890099', '106.8250984'),
('1002', 'Iksan Ahmad', '05', '619022', '-6.2890099', '106.8250984'),
('1231', 'Imam', '04', '619022', '-6.2314967999999995', '107.0677171');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(1) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `id_semester` (`id_semester`) USING BTREE,
  ADD KEY `nis` (`nis`) USING BTREE;

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `fk_absen_semester` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_absen_siswa` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_siswa_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
