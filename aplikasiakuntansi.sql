-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 08:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasiakuntansi`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_coa`
--

CREATE TABLE `table_coa` (
  `kode_coa` varchar(5) NOT NULL,
  `nama_coa` varchar(35) DEFAULT NULL,
  `jenis` varchar(25) DEFAULT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_coa`
--

INSERT INTO `table_coa` (`kode_coa`, `nama_coa`, `jenis`, `saldo`) VALUES
('1110', 'Kas Kecil', 'Asset', 0),
('1120', 'Kas', 'Asset', 8600000),
('1130', 'Bank', 'Asset', 0),
('1140', 'PPN Masukan', 'Asset', 0),
('1310', 'Perlengkapan Kantor', 'Asset', 200000),
('1320', 'Bahan Habis Pakai', 'Asset', 0),
('1330', 'Pembelian', 'Asset', 0),
('1340', 'Diskon Pembelian', 'Asset', 0),
('1350', 'Retur Pembelian', 'Asset', 0),
('1410', 'Asuransi Dibayar Di Muka', 'Asset', 0),
('1420', 'Sewa Dibayar Di Muka', 'Asset', 3000000),
('1430', 'PPN Dibayar Di Muka', 'Asset', 0),
('1440', 'PPH Dibayar DI Muka', 'Asset', 0),
('1510', 'Perangkat elektronik dan komputer', 'Asset', 0),
('1520', 'Peralatan', 'Asset', 4500000),
('1530', 'Furnitur', 'Asset', 0),
('1540', 'Mobil dan Motor', 'Asset', 0),
('1550', 'Leasehold Improvements', 'Asset', 0),
('1560', 'Perangkat Lain-Lain', 'Asset', 0),
('1610', 'Akumulasi Penyusutan Perangkat Komp', 'Asset', 0),
('1620', 'Akumulasi Penyusutan Mesin', 'Asset', 0),
('1630', 'Akumulasi Penyusutan Furnitur', 'Asset', 0),
('1640', 'Akumulasi Penyusutan Mobil dan Moto', 'Asset', 0),
('1710', 'Pendapatan Jasa Diterima di Muka', 'Asset', 0),
('2110', 'Hutang Dagang', 'Liabilitas', 2500000),
('2120', 'Hutang PPN', 'Liabilitas', 0),
('2130', 'Hutang PPH', 'Liabilitas', 0),
('2140', 'PPN Keluaran', 'Liabilitas', 0),
('2710', 'Hutang Bank Jangka Panjang', 'Liabilitas', 0),
('2720', 'Hutang Bank Jangka Pendek', 'Liabilitas', 0),
('2730', 'Hutang Institusi Jangka Panjang', 'Liabilitas', 0),
('2740', 'Hutang Institusi Jangka Pendek', 'Liabilitas', 0),
('3100', 'Modal', 'Ekuitas', 10000000),
('3200', 'Laba Sebelum Pajak', 'Ekuitas', 3800000),
('3300', 'Laba Periode Berjalan', 'Ekuitas', 0),
('3400', 'Prive', 'Ekuitas', 0),
('4101', 'Pendapatan Jasa', 'Pendapatan', 5000000),
('4102', 'Pendapatan - Jasa 2', 'Pendapatan', 0),
('4103', 'Pendapatan - Jasa 3', 'Pendapatan', 0),
('4200', 'Diskon Penjualan -  Semua Jasa', 'Pendapatan', 0),
('4201', 'Diskon Penjualan - Jasa 1', 'Pendapatan', 0),
('4202', 'Diskon Penjualan - Jasa 2', 'Pendapatan', 0),
('4203', 'Diskon Penjualan - Jasa 3', 'Pendapatan', 0),
('4301', 'Penjualan Batal - Jasa 1', 'Pendapatan', 0),
('4302', 'Penjualan Batal - Jasa 2', 'Pendapatan', 0),
('4303', 'Penjualan Batal - Jasa 3', 'Pendapatan', 0),
('6100', 'Beban Gaji Karyawan', 'Beban', 0),
('6110', 'Beban Administrasi', 'Beban', 0),
('6120', 'Beban Listrik, Air, Telpon', 'Beban', 700000),
('6130', 'Beban Sewa Kantor', 'Beban', 0),
('6140', 'Beban Asuransi', 'Beban', 0),
('6150', 'Beban Service dan Perawatan', 'Beban', 0),
('6160', 'Beban Perlengkapan Kantor', 'Beban', 0),
('6170', 'Beban Penyusutan Perangkat Elektron', 'Beban', 0),
('6180', 'Beban Penyusutan Mobil dan Motor', 'Beban', 0),
('6190', 'Beban Konsumsi', 'Beban', 500000),
('6200', 'Beban Alat Tulis Kantor', 'Beban', 0),
('6210', 'Beban Rumah Tangga Kantor', 'Beban', 0),
('6220', 'Beban Pemasaran/Iklan/Entertainment', 'Beban', 0),
('6230', 'Beban Training', 'Beban', 0),
('6240', 'Beban Iuran/Retribusi', 'Beban', 0),
('6250', 'Beban Penyusutan Furnitur', 'Beban', 0),
('6260', 'Beban Operasional Karyawan', 'Beban', 0),
('6270', 'Beban Lain-Lain', 'Beban', 0),
('6780', 'Beban Bunga', 'Beban', 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_transaksi`
--

CREATE TABLE `table_transaksi` (
  `no_transaksi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_transaksi` text NOT NULL,
  `akun_debet` varchar(30) NOT NULL,
  `akun_kredit` varchar(30) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_transaksi`
--

INSERT INTO `table_transaksi` (`no_transaksi`, `tanggal`, `nama_transaksi`, `akun_debet`, `akun_kredit`, `nominal`) VALUES
(1, '2023-02-01', 'Penerimaan modal awal', 'Kas', 'Modal', 10000000),
(2, '2023-02-02', 'Pembayaran sewa kantor untuk 1 tahun', 'Sewa Dibayar Di Muka', 'Kas', 3000000),
(3, '2023-02-05', 'Pembelian peralatan secara tunai', 'Peralatan', 'Kas', 2000000),
(4, '2023-02-06', 'Pembelian peralatan secara kredit', 'Peralatan', 'Hutang Dagang', 2500000),
(5, '2023-02-08', 'Penerimaan keuntungan dari jasa', 'Kas', 'Pendapatan Jasa', 5000000),
(6, '2023-02-09', 'Pembelian air minum galon', 'Beban Konsumsi', 'Kas', 500000),
(7, '2023-02-12', 'Pembayaran listrik', 'Beban Listrik, Air, Telpon', 'Kas', 700000),
(10, '2023-02-18', 'Pembelian perlengkapan secara kredit', 'Perlengkapan Kantor', 'Hutang Dagang', 200000),
(11, '2023-02-18', 'Pelunasan hutang pada tanggal 18 Februari 2023', 'Hutang Dagang', 'Kas', 200000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_coa`
--
ALTER TABLE `table_coa`
  ADD PRIMARY KEY (`kode_coa`);

--
-- Indexes for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  MODIFY `no_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
