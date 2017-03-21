-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05 Feb 2017 pada 07.19
-- Versi Server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ppg_malang_barat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akun`
--

CREATE TABLE IF NOT EXISTS `tb_akun` (
  `id_akun` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id_akun`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `username`, `password`, `level`) VALUES
(1, 'ale', 'ale', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajar`
--

CREATE TABLE IF NOT EXISTS `tb_pengajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tpq` int(11) DEFAULT NULL,
  `nama` varchar(105) DEFAULT NULL,
  `kelamin` enum('L','P') DEFAULT NULL COMMENT 'L : Laki Laki , P : Perempuan',
  `tmp_lahir` varchar(45) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `pdkn_terakhir` varchar(45) DEFAULT NULL,
  `pdkn_ket` varchar(45) DEFAULT NULL,
  `status` enum('MT','MS','PB') DEFAULT NULL COMMENT 'MT : Mubalegh Tugasan , MS : Mubalegh Setempat , PB : Pribumi',
  `perkawinan` enum('L','M') DEFAULT NULL COMMENT 'L : Lajang, M: Menikah',
  `kontak` varchar(45) DEFAULT NULL,
  `alamat` text,
  `email` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` datetime NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk Pengajar' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE IF NOT EXISTS `tb_siswa` (
  `id` int(11) NOT NULL,
  `id_tpq` int(11) NOT NULL,
  `level` enum('CBR','PRJ','RMJ','MDR') NOT NULL COMMENT 'CBR : Caberawit, PRJ : Praremaja , RMJ : Remaja , MDR : Mandiri',
  `nama` varchar(100) NOT NULL,
  `tmp_lhr` varchar(45) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `kelamin` enum('L','P') NOT NULL COMMENT 'L : Laki Laki, P : Perempuan',
  `kontak` varchar(45) DEFAULT NULL,
  `alamat` text,
  `foto` text,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` datetime NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk siswa';

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa_hobi`
--

CREATE TABLE IF NOT EXISTS `tb_siswa_hobi` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` datetime NOT NULL,
  `dibuat_oleh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table untuk hobi siswa';

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa_prestasi`
--

CREATE TABLE IF NOT EXISTS `tb_siswa_prestasi` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `prestasi` varchar(100) DEFAULT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` datetime NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tpq`
--

CREATE TABLE IF NOT EXISTS `tb_tpq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kepala` int(11) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `pembina` varchar(100) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `kontak` varchar(45) DEFAULT NULL,
  `alamat` text,
  `logo` text,
  `foto_cover` text,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` datetime NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data TPQ' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
