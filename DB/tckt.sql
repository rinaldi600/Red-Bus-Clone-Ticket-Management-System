-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jan 2022 pada 07.26
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tckt`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `idAdmin` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `handphone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `idAdmin`, `nama`, `username`, `handphone`, `email`, `password`, `alamat`, `created_at`, `updated_at`) VALUES
(6, 'ADMIN-618a833023b3d', 'Rinaldi Hendrawan', 'rinaldi69', '085877500086', 'rinaldi@gmail.com', '$2y$10$SfY/7ijh.vlC704Ph9k3m.rB0N77ygyNMwbEy1LfUhAk2/JE25zt.', 'Jr. Baya Kali Bungur No. 890, Tangerang Selatan 31732, Riau', '2021-11-09 21:18:24', '2021-11-09 21:18:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga`
--

CREATE TABLE `harga` (
  `id` int(11) NOT NULL,
  `idHarga` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `fasilitas` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `harga`
--

INSERT INTO `harga` (`id`, `idHarga`, `category`, `harga`, `keterangan`, `fasilitas`, `created_at`, `updated_at`) VALUES
(7, 'Harga-1638801494', 'platinum', 3000000, 'Harga Bisa Berubah Sesuai Dengan Ketentuan Yang Berlaku', 'Include Kasur, Snack, Tv, Wi-Fi, Karaoke', '2021-12-06 21:38:14', '2021-12-08 10:57:14'),
(8, 'Harga-1640091845', 'standard', 1500000, 'Harga Bisa Berubah Sesuai Dengan Ketentuan Yang Berlaku', 'Fasilitas free smoking, free Wi-Fi', '2021-12-21 20:04:05', '2021-12-21 20:04:05'),
(9, 'Harga-1640186727', 'premium', 2500000, 'Harga Bisa Berubah Sesuai Dengan Ketentuan Yang Berlaku', 'LCD TV, Meja Makan, Toilter dan bahkan kursi elektrik', '2021-12-22 22:25:27', '2021-12-22 22:25:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `loginadmin`
--

CREATE TABLE `loginadmin` (
  `id` int(11) NOT NULL,
  `idAdmin` varchar(100) NOT NULL,
  `sessionID` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `loginadmin`
--

INSERT INTO `loginadmin` (`id`, `idAdmin`, `sessionID`, `created_at`, `updated_at`, `deleted_at`) VALUES
(25, 'ADMIN-618a833023b3d', 'ur8hd96lloidvme933lo39ag41dicb4v', '2021-11-11 14:07:14', '2021-11-11 14:07:21', '2021-11-11 14:07:21'),
(26, 'ADMIN-618a833023b3d', 'ku8vlvdovnls5pimcqfqatabt35h49dn', '2021-11-11 14:07:30', '2021-11-11 14:07:33', '2021-11-11 14:07:33'),
(28, 'ADMIN-618a833023b3d', 'd6qbpllptn9k7tsc6kv8ukr8otavi94m', '2021-11-11 20:39:26', '2021-11-11 20:39:28', '2021-11-11 20:39:28'),
(29, 'ADMIN-618a833023b3d', 'ufba4pi9onnj751vut6mcs3e0tk5ebmb', '2021-11-11 20:39:48', '2021-11-11 20:40:19', '2021-11-11 20:40:19'),
(30, 'ADMIN-618a833023b3d', 'qtpb9180s9kofd5j4a9lq6dnrf20vn9q', '2021-11-11 20:40:25', '2021-11-11 20:40:41', '2021-11-11 20:40:41'),
(31, 'ADMIN-618a833023b3d', 'vv8p5ofaol4j8pn4ko4jgdikmjc7qfpj', '2021-11-11 20:40:47', '2021-11-11 20:42:54', '2021-11-11 20:42:54'),
(32, 'ADMIN-618a833023b3d', 'tq25ee7dhgu0eca8lfe4fl88h195ijbl', '2021-11-11 20:43:00', '2021-11-11 20:44:19', '2021-11-11 20:44:19'),
(34, 'ADMIN-618a833023b3d', 'mb18eaivjtgp31kvi5qg53msself0lkm', '2021-11-11 21:00:57', '2021-11-11 21:09:45', '2021-11-11 21:09:45'),
(35, 'ADMIN-618a833023b3d', 'tpuvtam9rd6nodoi7qu3is5s6c5rm4cq', '2021-11-11 21:10:09', '2021-11-11 21:10:23', '2021-11-11 21:10:23'),
(36, 'ADMIN-618a833023b3d', 'md8hnou8l6qnfjjk7ghmr0lm1flefiug', '2021-11-11 21:10:36', '2021-11-11 21:12:47', '2021-11-11 21:12:47'),
(37, 'ADMIN-618a833023b3d', '24r6v98404p29c5sd4br5uclqteni2l0', '2021-11-11 21:12:57', '2021-11-11 21:14:15', '2021-11-11 21:14:15'),
(38, 'ADMIN-618a833023b3d', '84bc120gi9nqkd2l3dvnbicu480garrq', '2021-11-11 21:14:23', '2021-11-11 21:14:25', '2021-11-11 21:14:25'),
(39, 'ADMIN-618a833023b3d', 'isheh3lecoftepf56qmjbiinsnh8vfhu', '2021-11-11 21:14:33', '2021-11-11 21:15:47', '2021-11-11 21:15:47'),
(41, 'ADMIN-618a833023b3d', '3lgjm7rao8p5ml6bvndtb3q2h9p1qhbu', '2021-11-15 12:37:53', '2021-11-15 13:08:20', '2021-11-15 13:08:20'),
(42, 'ADMIN-618a833023b3d', 'kbmqd5ci1qal1sv62uvhnrta7som8ef7', '2021-11-15 13:08:35', '2021-11-15 13:39:45', '2021-11-15 13:39:45'),
(43, 'ADMIN-618a833023b3d', 'n5gteel36v5j36v2mebintqa7l8fn3ja', '2021-11-15 13:39:56', '2021-11-15 13:51:04', '2021-11-15 13:51:04'),
(44, 'ADMIN-618a833023b3d', 'khgqdsjs2fjd9drke6dgj788j4psstcv', '2021-11-15 13:51:25', '2021-11-15 14:05:22', '2021-11-15 14:05:22'),
(46, 'ADMIN-618a833023b3d', 'a4el39e4f4e32en0sv9vlshgpn17pt1e', '2021-11-17 09:28:06', '2021-11-17 10:34:12', '2021-11-17 10:34:12'),
(48, 'ADMIN-618a833023b3d', '1685j7166egi9962nku48u498jja4cri', '2021-11-22 20:22:01', '2021-11-22 20:42:04', '2021-11-22 20:42:04'),
(49, 'ADMIN-618a833023b3d', 'amaif7bl30lvhrnpsq19k0kvgt157nu7', '2021-11-22 20:42:57', '2021-11-22 22:13:10', '2021-11-22 22:13:10'),
(51, 'ADMIN-618a833023b3d', 'vomffbm33dkrb01ao9h5akbqe7t4rh1r', '2021-11-25 20:19:06', '2021-11-25 20:29:08', '2021-11-25 20:29:08'),
(52, 'ADMIN-618a833023b3d', 'p6pd654bogpv78m656lsq67jmu22emd6', '2021-11-25 20:29:16', '2021-11-25 21:23:17', '2021-11-25 21:23:17'),
(56, 'ADMIN-618a833023b3d', '96o9l3kudstnocsgah7g7l37tu7vjjug', '2021-11-29 20:26:14', '2021-11-29 20:26:34', '2021-11-29 20:26:34'),
(57, 'ADMIN-618a833023b3d', 'e5ppbae7bnrou6jm5iu9bq1nhueicevd', '2021-11-29 20:26:39', '2021-11-29 07:26:45', '2021-11-29 07:26:45'),
(58, 'ADMIN-618a833023b3d', 'nbopi19lpgqf4akesvbord7k4o6tj6s0', '2021-11-29 20:26:56', '2021-11-29 07:28:24', '2021-11-29 07:28:24'),
(60, 'ADMIN-618a833023b3d', 'u446cpsuh40hecfol5g9e2ctq06gudro', '2021-11-29 20:28:28', '2021-11-29 07:28:42', '2021-11-29 07:28:42'),
(61, 'ADMIN-618a833023b3d', 'ma62mpsnf92n3o2hke5lbph0hf80a1uh', '2021-11-29 20:30:15', '2021-11-29 21:03:52', '2021-11-29 21:03:52'),
(62, 'ADMIN-618a833023b3d', '0k1h86hg0n7u6t6l1jf515qhg12g8b4h', '2021-11-30 20:15:27', '2021-11-30 07:34:10', '2021-11-30 07:34:10'),
(63, 'ADMIN-618a833023b3d', 'b5o2j35op8iucf6ttivjheh01lm3me20', '2021-11-30 20:34:17', '2021-11-30 07:35:54', '2021-11-30 07:35:54'),
(64, 'ADMIN-618a833023b3d', 'q8cpklkd8ndbomfhrin2ddr9b0hrvibm', '2021-11-30 20:35:58', '2021-11-30 07:36:21', '2021-11-30 07:36:21'),
(65, 'ADMIN-618a833023b3d', 'u83seeg0du2ebi26srscoqqu4mqjbajl', '2021-11-30 20:36:57', '2021-11-30 07:38:13', '2021-11-30 07:38:13'),
(67, 'ADMIN-618a833023b3d', 'q3rfgv2pc074la0b97fd13uu08aub6s0', '2021-11-30 20:38:18', '2021-11-30 07:39:14', '2021-11-30 07:39:14'),
(68, 'ADMIN-618a833023b3d', 'g11btkbrv31aplegkqtvvrd0ntcrobvp', '2021-11-30 20:39:57', '2021-11-30 20:40:14', '2021-11-30 20:40:14'),
(69, 'ADMIN-618a833023b3d', 'ebppmfb09vse83dc854ps7cjjfvdr6fe', '2021-11-30 20:40:32', '2021-11-30 21:19:21', '2021-11-30 21:19:21'),
(70, 'ADMIN-618a833023b3d', 'k7v5b70rrc71hb8k3e1g3jea6vdvgtji', '2021-12-01 20:19:26', '2021-12-01 21:22:26', '2021-12-01 21:22:26'),
(71, 'ADMIN-618a833023b3d', '22n2haehj988r74c7pdnepspq21not3p', '2021-12-02 20:02:01', '2021-12-02 21:24:22', '2021-12-02 21:24:22'),
(72, 'ADMIN-618a833023b3d', 'hjb7m0vj0v0f469gh5sual50bbvnsjln', '2021-12-06 20:48:53', '2021-12-06 21:50:33', '2021-12-06 21:50:33'),
(73, 'ADMIN-618a833023b3d', '6646rmdir35nphu2mosot2tkljd86j66', '2021-12-07 20:30:35', '2021-12-07 21:52:47', '2021-12-07 21:52:47'),
(74, 'ADMIN-618a833023b3d', '0sgkkavn9662v496rtqovsfjivgepeh5', '2021-12-08 10:48:48', '2021-12-08 12:34:06', '2021-12-08 12:34:06'),
(75, 'ADMIN-618a833023b3d', '9oq7tk4jdjo58moh7pim3o5lnhs26p5v', '2021-12-13 20:24:02', '2021-12-13 21:27:16', '2021-12-13 21:27:16'),
(76, 'ADMIN-618a833023b3d', 'l2aqrjiq9egl9dahpn4hcbvime70c548', '2021-12-14 20:03:30', '2021-12-14 21:16:35', '2021-12-14 21:16:35'),
(77, 'ADMIN-618a833023b3d', 'lrdt1cgvidgh67rds46p0m13vodi95a2', '2021-12-15 20:13:33', '2021-12-15 21:04:06', '2021-12-15 21:04:06'),
(78, 'ADMIN-618a833023b3d', '1b1l8p5skjpgbs764ingmpjasmdrp7cj', '2021-12-15 21:04:12', '2021-12-15 21:18:54', '2021-12-15 21:18:54'),
(79, 'ADMIN-618a833023b3d', 'nq049mno5fmmjq4ofc5s77o48233508e', '2021-12-16 20:16:50', '2021-12-16 21:34:15', '2021-12-16 21:34:15'),
(80, 'ADMIN-618a833023b3d', '6fild2dv2oc75eetdv4q1iiusi7tq43i', '2021-12-20 21:08:28', '2021-12-20 22:10:28', '2021-12-20 22:10:28'),
(81, 'ADMIN-618a833023b3d', '2mlb7aoa9vmq6umkt73nrrct9bq86986', '2021-12-21 19:55:26', '2021-12-21 20:46:54', '2021-12-21 20:46:54'),
(82, 'ADMIN-618a833023b3d', 'stvv2hndtpkalqdjvbej04valvmkn2i4', '2021-12-21 20:47:00', '2021-12-21 20:47:58', '2021-12-21 20:47:58'),
(84, 'ADMIN-618a833023b3d', 'hec0u2tpm12eb1h00vs57g7i7ipcl2p0', '2021-12-21 20:51:53', '2021-12-21 21:09:32', '2021-12-21 21:09:32'),
(85, 'ADMIN-618a833023b3d', 'bcb9ko760c9591m6hhlucgk70353rngu', '2021-12-22 22:24:34', '2021-12-22 22:40:48', '2021-12-22 22:40:48'),
(86, 'ADMIN-618a833023b3d', 'bjqtbjbupkrs7o06r7q2gdpjpc9dms6m', '2021-12-23 21:47:33', '2021-12-23 21:47:50', '2021-12-23 21:47:50'),
(87, 'ADMIN-618a833023b3d', '04e0do5ea8s637d4nbvnvsto0bb0kd4t', '2021-12-25 12:01:33', '2021-12-25 12:09:12', '2021-12-25 12:09:12'),
(88, 'ADMIN-618a833023b3d', 'l5u9m2t9cc7pjuqn9nagd6jascajvr4t', '2021-12-25 12:09:40', '2021-12-25 12:10:06', '2021-12-25 12:10:06'),
(89, 'ADMIN-618a833023b3d', 'f4nrfvbdctjihvkn1r7s0052jjdsmpfi', '2021-12-28 15:11:09', '2021-12-28 15:11:47', '2021-12-28 15:11:47'),
(90, 'ADMIN-618a833023b3d', 'b01at3p0nn2v6jooahmtucr27vjqiukd', '2022-01-06 21:55:00', '2022-01-06 21:55:54', '2022-01-06 21:55:54'),
(91, 'ADMIN-618a833023b3d', '4s6s04kf2hce5qpm8iv8t9ncuj7gup7h', '2022-01-10 21:38:43', '2022-01-10 21:38:47', '2022-01-10 21:38:47'),
(92, 'ADMIN-618a833023b3d', 'mlfjic8907nk6p0cseda5ju1jq94shi8', '2022-01-13 21:10:38', '2022-01-13 21:11:14', '2022-01-13 21:11:14'),
(93, 'ADMIN-618a833023b3d', '7at39a5ovca6peu9veimato225do2dd1', '2022-01-19 09:48:40', '2022-01-19 09:51:13', '2022-01-19 09:51:13'),
(94, 'ADMIN-618a833023b3d', '8jnhj7vur45k026l3jemfre2n1g9t8t3', '2022-01-25 10:03:06', '2022-01-25 10:15:16', '2022-01-25 10:15:16'),
(96, 'ADMIN-618a833023b3d', 'eu0ua9sjrsujf6n94ras0ukd6b2noh13', '2022-01-26 10:17:35', '2022-01-26 12:22:07', '2022-01-26 12:22:07'),
(97, 'ADMIN-618a833023b3d', 'hj35k6rk7rivi72kfismh9rhq1spt60g', '2022-01-27 10:21:08', '2022-01-27 11:19:23', '2022-01-27 11:19:23'),
(98, 'ADMIN-618a833023b3d', 'g67rvaov5oa2dbn7fqnuj56r25qse0r8', '2022-01-27 11:20:09', '2022-01-27 11:20:50', '2022-01-27 11:20:50'),
(99, 'ADMIN-618a833023b3d', 'uej4la5qfoqn57ceble4rimajbgvc1j8', '2022-01-27 11:21:34', '2022-01-27 11:22:34', '2022-01-27 11:22:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderan`
--

CREATE TABLE `orderan` (
  `id` int(11) NOT NULL,
  `idOrder` varchar(100) NOT NULL,
  `noResi` varchar(100) NOT NULL,
  `idUser` varchar(100) DEFAULT NULL,
  `idTicket` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('Dibayar','Belum Dibayar') NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orderan`
--

INSERT INTO `orderan` (`id`, `idOrder`, `noResi`, `idUser`, `idTicket`, `jumlah`, `status`, `total`, `created_at`, `updated_at`) VALUES
(31, 'Order-196830520', '61E787675CA9A', 'USER-61d6fa3f39f60', 'Ticket-1642083069', 1, 'Dibayar', 3000000, '2022-01-19 10:37:11', '2022-01-20 21:13:25'),
(32, 'Order-253176844', '61E787A8A1BBF', 'USER-61d6fa3f39f60', 'Ticket-1642560617', 1, 'Dibayar', 1500000, '2022-01-19 10:38:16', '2022-01-20 21:23:37'),
(33, 'Order-1916964935', '61E787C9E49D5', 'USER-61d6fa3f39f60', 'Ticket-1642560634', 1, 'Dibayar', 1500000, '2022-01-19 10:38:49', '2022-01-19 10:44:45'),
(35, 'Order-1716969319', '61EE2793BFA3C', 'USER-61ee276f1712f', 'Ticket-1642083069', 2, 'Dibayar', 6000000, '2022-01-24 11:14:11', '2022-01-24 11:25:33'),
(36, 'Order-1543319720', '61EE27A7B8EEE', 'USER-61ee276f1712f', 'Ticket-1642560658', 1, 'Dibayar', 1500000, '2022-01-24 11:14:31', '2022-01-24 11:14:39'),
(37, 'Order-1568899967', '61EE2A4B9EEE4', 'USER-61ee276f1712f', 'Ticket-1642083069', 2, 'Dibayar', 6000000, '2022-01-24 11:25:47', '2022-01-24 12:38:13'),
(38, 'Order-457057358', '61EE3B8BED2DD', 'USER-61ee276f1712f', 'Ticket-1642560634', 1, 'Dibayar', 1500000, '2022-01-24 12:39:23', '2022-01-24 12:39:39'),
(40, 'Order-115924387', '61F229B7CE4E7', 'USER-61d6fa3f39f60', 'Ticket-1642083069', 2, 'Belum Dibayar', 6000000, '2022-01-27 12:12:23', '2022-01-27 12:12:23'),
(41, 'Order-48362720', '61F2317DD8D17', 'USER-61d6fa3f39f60', 'Ticket-1642560617', 4, 'Dibayar', 6000000, '2022-01-27 12:45:33', '2022-01-27 12:46:28'),
(42, 'Order-1424321432', '61F2339EE7686', 'USER-61d6fa3f39f60', 'Ticket-1642560658', 1, 'Belum Dibayar', 1500000, '2022-01-27 12:54:38', '2022-01-27 12:54:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `place`
--

CREATE TABLE `place` (
  `id` int(11) NOT NULL,
  `idPlace` varchar(100) NOT NULL,
  `asal` text NOT NULL,
  `tujuan` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `place`
--

INSERT INTO `place` (`id`, `idPlace`, `asal`, `tujuan`, `created_at`, `updated_at`) VALUES
(6, 'Place-1638191856', 'Gg. Gambang No. 228, Kendari 66251, KepR', 'Psr. Nakula No. 94, Administrasi Jakarta Timur 87501, SulSel', '2021-11-29 20:17:36', '2021-11-30 20:45:09'),
(8, 'Place-1638191931', 'Dk. Raden No. 207, Gunungsitoli 46320, Lampung', 'Dk. Fajar No. 756, Mojokerto 99995, NTB', '2021-11-29 20:18:51', '2021-11-29 20:18:51'),
(9, 'Place-1638191946', 'Ds. Mahakam No. 2, Tidore Kepulauan 19636, Gorontalo', 'Ki. Rajawali Timur No. 105, Sabang 16872, KalSel', '2021-11-29 20:19:06', '2021-11-29 20:19:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supir`
--

CREATE TABLE `supir` (
  `id` int(11) NOT NULL,
  `idSupir` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `handphone` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supir`
--

INSERT INTO `supir` (`id`, `idSupir`, `nama`, `handphone`, `alamat`, `created_at`, `updated_at`) VALUES
(2, 'Supir-1637033424', 'Kalim Hardiansyah', '091702257462', 'Ds. Batako No. 333, Bau-Bau 39258, DKI', '2021-11-16 10:30:24', '2021-11-23 10:07:20'),
(3, 'Supir-1637033483', 'Hari Hidayat', '06371685047', 'Jln. Dahlia No. 617, Lhokseumawe 65031, KalTim', '2021-11-16 10:31:23', '2021-11-22 20:59:55'),
(4, 'Supir-1637116215', 'Jamal Prasasta', '030237538246', 'Ki. BKR No. 758, Singkawang 56106, SulUt', '2021-11-17 09:30:15', '2021-11-17 09:30:15'),
(5, 'Supir-1637119126', 'Irsad Budiman', '060867407639', 'Ds. Moch. Ramdan No. 439, Bau-Bau 32831, SulUt', '2021-11-17 10:18:46', '2021-11-17 10:18:46'),
(6, 'Supir-1637589219', 'Mumpuni Iswahyudi', '626554667429', 'Dk. Suharso No. 195, Dumai 49441, JaTim', '2021-11-22 20:53:39', '2021-11-22 20:53:39'),
(10, 'Supir-1640094509', 'Adi Pratama', '085877500089', 'Jetak Kembang', '2021-12-21 20:48:29', '2021-12-21 20:48:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `idTicket` varchar(100) NOT NULL,
  `namaBus` varchar(100) NOT NULL,
  `idSupir` varchar(100) NOT NULL,
  `idPlace` varchar(100) NOT NULL,
  `idHarga` varchar(100) NOT NULL,
  `tanggalBerangkat` datetime NOT NULL,
  `jumlahPenumpang` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ticket`
--

INSERT INTO `ticket` (`id`, `idTicket`, `namaBus`, `idSupir`, `idPlace`, `idHarga`, `tanggalBerangkat`, `jumlahPenumpang`, `created_at`, `updated_at`) VALUES
(34, 'Ticket-1642083069', 'PO Bus Juragan99', 'Supir-1637033424', 'Place-1638191856', 'Harga-1638801494', '2022-04-13 21:10:00', 50, '2022-01-13 21:11:09', '2022-01-13 21:11:09'),
(35, 'Ticket-1642560599', 'PO Bus Haryanto', 'Supir-1637033424', 'Place-1638191856', 'Harga-1638801494', '2022-04-28 09:49:00', 50, '2022-01-19 09:49:59', '2022-01-19 09:49:59'),
(36, 'Ticket-1642560617', 'PO Bus Juragan99', 'Supir-1637116215', 'Place-1638191856', 'Harga-1640091845', '2022-07-19 09:50:00', 50, '2022-01-19 09:50:17', '2022-01-19 09:50:17'),
(37, 'Ticket-1642560634', 'PO Bus Subur Jaya', 'Supir-1637116215', 'Place-1638191946', 'Harga-1640091845', '2022-11-30 09:50:00', 50, '2022-01-19 09:50:34', '2022-01-19 09:50:34'),
(38, 'Ticket-1642560658', 'AM Trans Luxurious dari PO AM Trans', 'Supir-1637119126', 'Place-1638191931', 'Harga-1640091845', '2022-01-29 09:50:00', 50, '2022-01-19 09:50:58', '2022-01-19 09:50:58'),
(39, 'Ticket-1643257339', 'AM Trans Luxurious dari PO AM Trans', 'Supir-1637033424', 'Place-1638191856', 'Harga-1638801494', '2022-01-26 11:22:00', 50, '2022-01-27 11:22:19', '2022-01-27 11:22:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `idUser` varchar(100) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `handphone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `idUser`, `nama`, `username`, `handphone`, `email`, `password`, `alamat`, `created_at`, `updated_at`) VALUES
(5, 'USER-61d6fa3f39f60', 'Rinaldi Hendrawan', 'Rinaldi007', '085877500088', 'rinaldihendrawan84@gmail.com', '$2y$10$feh4cAmU0n9.TYAksxDe6O3h4jWVeI5IJltjWF3ukWgt6.sHDHvcC', 'Jr. Flora No. 491, Jayapura 33225, Papua', '2022-01-06 21:18:39', '2022-01-06 21:18:39'),
(7, 'USER-61ee276f1712f', 'Dewi Astuti', 'hendra007', '08970025992', 'susanti.malika@gmail.com', '$2y$10$n5TI7qCpASHaA28H7hqo...hhfrBnL9kQZh577nCUve8fRDi1lFm2', 'Ki. Elang No. 103, Administrasi Jakarta Pusat 61037, SumBar', '2022-01-24 11:13:35', '2022-01-24 11:13:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idAdmin` (`idAdmin`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idHarga` (`idHarga`);

--
-- Indeks untuk tabel `loginadmin`
--
ALTER TABLE `loginadmin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sessionId` (`sessionID`),
  ADD KEY `fk_idAdmin` (`idAdmin`);

--
-- Indeks untuk tabel `orderan`
--
ALTER TABLE `orderan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idOrder` (`idOrder`),
  ADD UNIQUE KEY `noResi` (`noResi`),
  ADD KEY `fk_idUser` (`idUser`),
  ADD KEY `fk_idTicket` (`idTicket`);

--
-- Indeks untuk tabel `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idPlace` (`idPlace`);

--
-- Indeks untuk tabel `supir`
--
ALTER TABLE `supir`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idSupir` (`idSupir`);

--
-- Indeks untuk tabel `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idTicket` (`idTicket`),
  ADD KEY `fk_tabel_supir` (`idSupir`),
  ADD KEY `fk_table_place` (`idPlace`),
  ADD KEY `fk_table_harga` (`idHarga`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `harga`
--
ALTER TABLE `harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `loginadmin`
--
ALTER TABLE `loginadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT untuk tabel `orderan`
--
ALTER TABLE `orderan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `place`
--
ALTER TABLE `place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `supir`
--
ALTER TABLE `supir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `loginadmin`
--
ALTER TABLE `loginadmin`
  ADD CONSTRAINT `fk_idAdmin` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`idAdmin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orderan`
--
ALTER TABLE `orderan`
  ADD CONSTRAINT `fk_idTicket` FOREIGN KEY (`idTicket`) REFERENCES `ticket` (`idTicket`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_tabel_supir` FOREIGN KEY (`idSupir`) REFERENCES `supir` (`idSupir`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_table_harga` FOREIGN KEY (`idHarga`) REFERENCES `harga` (`idHarga`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_table_place` FOREIGN KEY (`idPlace`) REFERENCES `place` (`idPlace`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
