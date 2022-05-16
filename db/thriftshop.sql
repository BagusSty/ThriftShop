-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2022 pada 03.37
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thriftshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_pokok` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `id_kategori`, `nama_barang`, `gambar`, `stok`, `harga_pokok`, `harga_jual`) VALUES
(11, 5, 'Sepatu Sneakers', 'sepatu.jpg', 42, 120000, 132000),
(12, 1, 'Jaket Merah', 'hoodie merah.jpg', 12, 120000, 132000),
(13, 0, 'T-Shirt Hijau', 'tshirt hijau.jpg', 25, 80000, 88000),
(14, 3, 'T-Shirt Hijau', 'tshirt hijau.jpg', 20, 75000, 82500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_masuk`
--

CREATE TABLE `tb_barang_masuk` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `jumlah_harga_pokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang_masuk`
--

INSERT INTO `tb_barang_masuk` (`id`, `id_barang`, `tanggal`, `id_supplier`, `jumlah_barang`, `jumlah_harga_pokok`) VALUES
(9, 10, '2022-04-17', 2, 40, 5800000),
(10, 10, '2022-04-19', 1, 4, 480000),
(11, 10, '2022-04-19', 1, 1, 120000),
(12, 10, '2022-04-19', 1, 1, 120000),
(13, 10, '2022-04-19', 2, 10, 1200000),
(14, 11, '2022-04-19', 1, 10, 1000000),
(15, 10, '2022-04-19', 1, 2, 200000),
(16, 12, '2022-04-19', 1, 1, 120000),
(17, 13, '2022-04-20', 2, 30, 2400000),
(18, 14, '2022-05-09', 1, 20, 1500000),
(20, 12, '2022-05-16', 1, 2, 240000),
(21, 11, '2022-05-16', 1, 15, 1800000),
(22, 11, '2022-05-16', 1, 15, 1800000),
(26, 11, '2022-05-16', 2, 13, 1560000),
(27, 12, '2022-05-16', 1, 10, 1200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Jaket'),
(3, 'T-Shirt'),
(5, 'Sepatu'),
(6, 'Celana'),
(7, 'Kemeja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `no_hp_supplier` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `no_hp_supplier`) VALUES
(1, 'Toko Jaya Abadi', 'Blora, Jawa Tengah', '085708953614'),
(2, 'PT Feng Shou', 'Dusun Made RT 03 RW 01', '085721231312');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tipe_user`
--

CREATE TABLE `tb_tipe_user` (
  `tipe_user` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tipe_user`
--

INSERT INTO `tb_tipe_user` (`tipe_user`, `jabatan`) VALUES
(1, 'Pemilik'),
(2, 'Karyawan'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `no_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `pembayaran` enum('Mandiri','BCA','BRI') NOT NULL,
  `waktu_pesan` datetime NOT NULL,
  `batas_bayar` datetime NOT NULL,
  `waktu_bayar` date NOT NULL,
  `total_barang` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status` enum('Belum Dibayar','Sudah Dibayar','Kadaluarsa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_transaksi`, `id_user`, `kode`, `alamat`, `pembayaran`, `waktu_pesan`, `batas_bayar`, `waktu_bayar`, `total_barang`, `total_bayar`, `status`) VALUES
(20, 10, 'TRS-250422660725', 'Dusun Made RT 03 RW 01', 'BCA', '2022-04-25 09:10:35', '2022-05-02 09:10:35', '2022-04-30', 1, 110000, 'Sudah Dibayar'),
(21, 10, 'TRS-25042281067', 'Dusun Made RT 03 RW 01', 'Mandiri', '2022-04-25 09:11:02', '2022-05-02 09:11:02', '1970-01-01', 3, 286000, 'Belum Dibayar'),
(22, 10, 'TRS-250422978549', 'Madiun Jawa Timur', '', '2022-04-25 09:14:21', '2022-05-02 09:14:21', '1970-01-01', 3, 264000, 'Belum Dibayar'),
(23, 10, 'TRS-160522628286', 'Dusun Made RT 03 RW 01', 'Mandiri', '2022-05-16 03:17:26', '2022-05-23 03:17:26', '2022-05-16', 1, 132000, 'Sudah Dibayar'),
(24, 12, 'TRS-160522929853', 'Ngawi', 'BCA', '2022-05-16 03:30:23', '2022-05-23 03:30:23', '0000-00-00', 1, 132000, 'Belum Dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi_detail`
--

CREATE TABLE `tb_transaksi_detail` (
  `id` int(11) NOT NULL,
  `no_transaksi` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi_detail`
--

INSERT INTO `tb_transaksi_detail` (`id`, `no_transaksi`, `id_barang`, `pembelian`) VALUES
(33, 20, '11', 1),
(34, 21, '11', 1),
(35, 21, '13', 2),
(36, 22, '13', 3),
(37, 23, '12', 1),
(38, 24, '11', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `tipe_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `no_hp`, `tipe_user`) VALUES
(1, 'Joko', 'karyawan01', '20f4a0c5b3875afa8bb11a0df146e1f0', '089762392921', 2),
(3, 'Bagus Setyo', 'admin', 'ddf7cfe9c7381a6cb22d17c16febb5cc', '085708953614', 1),
(10, 'zahra', 'user1', '24c9e15e52afc47c225b757e7bee1f9d', '085721231312', 3),
(11, 'tango123', 'tango123', '3d7e81d265b22bc69746ae91cb1adb87', '081459115072', 3),
(12, 'Maulana', 'maulana15', '8f59d9db7aa4a90d5dacef89259b73ba', '085821949311', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_barang_masuk`
--
ALTER TABLE `tb_barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `tb_tipe_user`
--
ALTER TABLE `tb_tipe_user`
  ADD PRIMARY KEY (`tipe_user`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- Indeks untuk tabel `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_barang_masuk`
--
ALTER TABLE `tb_barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `no_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
