-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2025 pada 14.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meatballbys`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `mie` enum('mie_kuning','bihun') DEFAULT NULL,
  `sayur` enum('dengan_sayur','tanpa_sayur') DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `transaksi_id`, `menu_id`, `qty`, `mie`, `sayur`, `harga`) VALUES
(1, 1, 7, 1, 'bihun', 'dengan_sayur', 10000),
(2, 2, 7, 1, 'mie_kuning', 'dengan_sayur', 10000),
(9, 5, 12, 1, 'bihun', '', 15000),
(10, 5, 8, 1, '', '', 15000),
(11, 5, 9, 1, NULL, NULL, 5000),
(12, 6, 8, 2, 'bihun', '', 15000),
(13, 6, 12, 1, '', '', 15000),
(14, 6, 12, 1, 'bihun', '', 15000),
(15, 6, 15, 1, NULL, NULL, 3000),
(16, 6, 10, 1, NULL, NULL, 7000),
(17, 6, 14, 2, NULL, NULL, 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` enum('makanan','minuman') NOT NULL,
  `harga` int(11) NOT NULL,
  `status` enum('active','coming_soon') DEFAULT 'active',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `nama`, `kategori`, `harga`, `status`, `foto`) VALUES
(7, 'Bakso Kecil', 'makanan', 10000, 'active', '1765414827_bakso kecil.jpg'),
(8, 'Bakso Urat', 'makanan', 15000, 'active', '1765414951_bakso urat.jpg'),
(9, 'Es Teh Manis', 'minuman', 5000, 'active', '1765414986_es_teh.jpg'),
(10, 'Es Jeruk', 'minuman', 7000, 'active', '1765415019_es_jeruk.jpg'),
(11, 'Es Teler', 'minuman', 10000, 'coming_soon', '1765415068_es_teler.jpg'),
(12, 'Bakso Mercon', 'makanan', 15000, 'active', '1765414752_bakso mercon.jpg'),
(13, 'Bakso Keju', 'makanan', 15000, 'active', '1765414712_bakso keju.jpg'),
(14, 'Teh Manis Hangat', 'minuman', 5000, 'active', '1765415281_teh_manis.jpg'),
(15, 'Teh Tawar', 'minuman', 3000, 'active', '1765415513_teh_tawar.jpg'),
(16, 'Es Teh Tawar', 'minuman', 3000, 'active', '1765415716_es_tawar.jpg'),
(17, 'Bakso Telur', 'makanan', 15000, 'active', '1765415873_bakso telur.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL,
  `kasir_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `total`, `kasir_id`) VALUES
(1, '2025-12-10 20:54:12', 10000, 4),
(2, '2025-12-10 21:12:27', 10000, 4),
(5, '2025-12-11 09:10:18', 35000, 5),
(6, '2025-12-11 15:38:49', 80000, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `role` enum('admin','kasir') DEFAULT 'kasir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `role`) VALUES
(4, 'cacmi', '55cb6ff218fd0c2d060a91c6740e0ebe', 'Cacmi', 'kasir'),
(5, 'abu', '09d0714edbfe6a5be5f51a8d706cefb6', 'abu mocha endut', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kasir_id` (`kasir_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kasir_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
