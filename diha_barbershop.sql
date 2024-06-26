-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 03:08 AM
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
-- Database: `diha_barbershop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(10) UNSIGNED NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `pembeli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_product`, `jumlah`, `pembeli`) VALUES
(9, 1, 5, 1),
(10, 3, 2, 1),
(11, 2, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_order` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status_pembayaran` int(11) NOT NULL,
  `status_pesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` int(13) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jam` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `service` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `nama`, `no_hp`, `alamat`, `jam`, `tanggal`, `service`) VALUES
(1, '', 0, '', NULL, NULL, NULL),
(10, 'koko', 1213342445, 'sariasih no.54', '14:00:00', NULL, NULL),
(11, 'raihan', 209838101, 'dago atas dekat borma', '15:00:00', NULL, NULL),
(12, 'adi', 2147483647, 'cimahi dekat unjani', '16:30:00', NULL, NULL),
(13, 'adiy', 98121726, 'jl sukasari', '15:10:00', NULL, NULL),
(14, 'dimas', 8886622, 'htdkukugf', '16:18:00', NULL, NULL),
(15, 'Vito', 2147483647, 'sarijadi', '19:50:00', NULL, NULL),
(16, 'Anam', 812319331, 'madura', '20:50:00', NULL, NULL),
(17, 'Endi', 2147483647, 'sumbawa besar', '19:50:00', '2024-06-13', 'coloring');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `deskripsi_produk` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `deskripsi_produk`, `gambar`) VALUES
(1, 'Hair Paste', 30000, 'ini adalah hair paste untuk rambut', 'hair paste.jpeg'),
(2, 'Hair Paste + Sisir', 35000, 'ini adalah hair pastetuk rambdan ekstra sisir', 'hair paste sisir.jpeg'),
(3, 'Anti Dandruff', 40000, 'ini adalah produk untuk anti dandruff ', 'anti dandruff.jpeg'),
(4, 'Water Based', 25000, 'ini adalah produk water based yang sangat cocok untuk segala jenis rambut', 'water based.jpeg'),
(5, 'Powder + Sisir', 40000, 'ini adalah powder dan ekstra sisir untuk rambut anda', 'powder sisir.jpeg'),
(6, 'Powder', 37000, 'ini powder nya aja', 'powder.jpeg'),
(7, 'Ocean Spray', 50000, 'spray laut ini mah', 'ocean spray.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `email`, `password`, `id_roles`) VALUES
(1, 'bismillah', 'bismillah@tuhan.com', '00ebcfe827b16d84a67e8c94db08f4a3', 1),
(2, 'dimas', 'dimas@gmail.com', '5623db013dfa6f5bfaba3fb8ac42f304', 1),
(3, 'anam', 'anamptk@gmail.com', '594b070406f312c530bf996d1868f158', 1),
(4, 'koko', 'koko@koko.com', '4ba7932748915137f69f0011255a008d', 1),
(5, 'dimdar', 'dimdar@gamil.com', '0a806f604554204ad17a69d5c4d5d760', 1),
(6, 'haris12', 'haris@gmail.com', '98d75113b5295fa03645734ec66975da', 1),
(7, 'adi', 'adi@Gmail.com', 'b3ec5ca48563a6e533163445ba7093a3', 1),
(8, 'ilyas', '', 'e0b5dbfeb49673d1657ebdddf915aa18', 1),
(9, 'ilyas', 'ilyas@gmail.com', 'cfd603e38c70589c344e8573f81f19d8', 1),
(10, 'nanda', 'nanda@gmail.com', '044d8569ae2afc22664ae21721e71c84', 1),
(11, 'hikam', 'hikam@gmail.com', '5481fdabab6dda7f6a594d39955e6fad', 1),
(12, 'koko', 'koko@gmail.com', 'b5d72aed410290041f35d48cb8bdb0a8', 1),
(13, 'dimas21', 'dimas@gmail.com', 'f0c9407837551b93b656b40babb94aad', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
