-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Eki 2022, 06:25:43
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `supportgappze`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `accounts`
--

INSERT INTO `accounts` (`id`, `firstName`, `lastName`, `email`, `password`, `permission`, `department`, `createdDate`) VALUES
(1, 'Admin', 'DOĞRU', 'admin@gappze.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, '2022-10-13 09:49:30'),
(2, 'Üye', 'DOĞRU', 'uye@gappze.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 0, '2022-10-13 10:00:39'),
(7, 'destek', 'DOĞRU', 'destek@gappze.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, '2022-10-13 10:40:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Teknik Destek'),
(2, 'Muhasabe'),
(4, 'Muhasabe');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `dropdown` int(11) NOT NULL,
  `isDropdown` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `isLogged` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pages`
--

INSERT INTO `pages` (`id`, `name`, `src`, `permission`, `location`, `dropdown`, `isDropdown`, `icon`, `isLogged`) VALUES
(1, 'Ana Sayfa', 'index.php', 0, 0, 0, 0, '', 0),
(2, 'Destek Taleplerim', 'mysupport.php', 0, 0, 0, 0, '', 1),
(3, 'Yeni Destek Bileti Oluştur', 'addsupport.php', 0, 0, 0, 0, '', 1),
(6, 'Gösterge Paneli', 'index.php', 0, 1, 0, 0, 'fa fa-dashboard', 0),
(7, ' Destekler', '#', 0, 1, 0, 1, 'fa fa-ticket', 0),
(8, 'Kullanıcılar', 'accounts.php', 0, 1, 0, 0, 'fa fa-user', 0),
(9, 'Roller', 'roles.php', 0, 1, 0, 0, 'fa fa-tag', 0),
(10, 'Sayfa', '', 1, 1, 0, 1, 'fa fa-columns', 0),
(11, 'Tümü', 'supports.php', 0, 1, 7, 0, '', 0),
(12, 'Yanıt Bekleyenler', 'support-wait.php', 0, 1, 7, 0, '', 0),
(15, 'Sayfa Ekle', '#', 0, 1, 10, 0, '', 0),
(16, 'Kapatılanlar', 'support-close.php', 0, 1, 7, 0, '', 0),
(17, 'Yanıtlananlar', 'support-answered.php', 0, 1, 7, 0, '', 0),
(18, 'Departmanlar', 'departments.php', 0, 1, 7, 0, '', 0),
(19, 'Departman Ekle', 'departman-add.php', 0, 1, 7, 0, '', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Yönetici'),
(2, 'Destek Ekibi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `supportdata`
--

CREATE TABLE `supportdata` (
  `id` int(11) NOT NULL,
  `supportId` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `returningPersonId` int(11) NOT NULL DEFAULT 0,
  `message` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `supportdata`
--

INSERT INTO `supportdata` (`id`, `supportId`, `ownerId`, `returningPersonId`, `message`, `date`) VALUES
(1, 1, 2, 1, 'sELAM ', '2022-10-12 09:52:39'),
(2, 1, 2, 0, 'Say my name !', '2022-10-12 09:52:58'),
(3, 1, 2, 1, 'Yusuf aleyhisalm', '2022-10-12 09:53:14'),
(4, 1, 2, 0, 'GOD DAMN RIGTH', '2022-10-12 09:53:54'),
(5, 1, 2, 1, 'saaa', '2022-10-12 09:54:45'),
(6, 1, 2, 0, 'whats your name', '2022-10-12 09:54:48'),
(7, 1, 2, 0, 'aaaas', '2022-10-12 09:55:14'),
(8, 1, 2, 0, 'aaaas', '2022-10-12 09:55:29'),
(9, 1, 2, 1, 'mamut', '2022-10-12 09:56:28'),
(10, 1, 2, 1, 'mamut', '2022-10-12 09:56:34'),
(11, 1, 2, 1, 'ahmet', '2022-10-12 10:09:31'),
(12, 1, 2, 1, 'ahmet', '2022-10-12 10:09:39'),
(13, 1, 2, 1, 'axaxa', '2022-10-12 10:10:50'),
(14, 1, 2, 0, 'PROJEYİ YAPMAM LAZIM AMA BURADA CHATTİNG YAPIOM SEKAM', '2022-10-12 10:18:44'),
(15, 1, 2, 1, 'anlıyorum uza', '2022-10-12 10:18:54'),
(16, 1, 2, 0, 'ZATTİRİ ZORT ZORT', '2022-10-12 10:19:01'),
(17, 1, 2, 1, 'anırma dayı', '2022-10-12 10:19:09'),
(18, 1, 2, 0, '& \'\'', '2022-10-12 10:20:11'),
(19, 1, 2, 0, 'MARİO RUN', '2022-10-12 10:20:35'),
(20, 1, 2, 0, 'MARİO RUN', '2022-10-12 10:20:46'),
(21, 1, 2, 1, 'aaaa', '2022-10-12 10:20:53'),
(22, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:04'),
(23, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:11'),
(24, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:11'),
(25, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:11'),
(26, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:12'),
(27, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:12'),
(28, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:12'),
(29, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:12'),
(30, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:12'),
(31, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:13'),
(32, 1, 2, 0, 'BSASWAASUSÖAAAAAAAAAA', '2022-10-12 10:21:13'),
(33, 1, 2, 1, 'babbbaaaa', '2022-10-12 10:21:33'),
(34, 1, 2, 1, 'xaxaxaxa', '2022-10-12 10:23:37'),
(35, 1, 2, 1, 'XAXAXA', '2022-10-12 10:23:57'),
(36, 1, 2, 1, 'AMİN', '2022-10-12 10:24:11'),
(37, 1, 2, 0, 'sekanaü', '2022-10-12 10:37:22'),
(38, 1, 2, 0, 'sekanaü', '2022-10-12 10:37:28'),
(39, 1, 2, 0, 'sekanaü', '2022-10-12 10:37:33'),
(40, 1, 2, 1, 'selamun aleykummm', '2022-10-12 10:38:05'),
(41, 1, 2, 1, 'aaaa', '2022-10-12 10:39:57'),
(42, 1, 2, 0, 'SUSSSS', '2022-10-12 10:39:59'),
(43, 1, 2, 1, 'madam ckocooc', '2022-10-12 10:40:08'),
(44, 1, 2, 1, 'aaxaxa', '2022-10-12 11:03:45'),
(45, 1, 2, 1, 'aaaaxax', '2022-10-12 11:05:25'),
(46, 1, 2, 1, 'aaa', '2022-10-12 11:06:01'),
(47, 1, 2, 1, 'aa', '2022-10-12 11:06:24'),
(48, 1, 2, 1, 'aaa', '2022-10-12 11:10:21'),
(49, 1, 2, 1, 'aaxa', '2022-10-12 11:11:50'),
(50, 1, 2, 1, 'xaaxa', '2022-10-12 11:11:55'),
(51, 1, 2, 1, 'xaxaxa', '2022-10-12 11:13:07'),
(52, 1, 2, 1, 'xaxaxa', '2022-10-12 11:13:15'),
(53, 1, 2, 0, 'aaa', '2022-10-12 11:37:23'),
(54, 1, 2, 0, 'aacac', '2022-10-12 11:38:46'),
(55, 1, 2, 0, 'aa', '2022-10-12 11:40:25'),
(56, 1, 2, 0, 'aa', '2022-10-12 11:41:21'),
(57, 1, 2, 0, 'ss', '2022-10-12 11:41:54'),
(58, 1, 2, 0, 'aaa', '2022-10-12 11:45:36'),
(59, 1, 2, 0, 'a', '2022-10-12 11:45:56'),
(60, 1, 2, 0, 'aaa', '2022-10-12 11:48:04'),
(61, 1, 2, 0, 'aaxaax', '2022-10-12 12:17:30'),
(62, 1, 2, 1, 'Evet anlıyorum', '2022-10-12 12:18:33'),
(63, 1, 2, 0, 'xaxa', '2022-10-12 12:19:10'),
(64, 1, 2, 0, 'xaxa', '2022-10-12 12:20:10'),
(65, 1, 2, 0, 'axaa', '2022-10-12 12:20:15'),
(66, 1, 2, 0, 'aa', '2022-10-12 12:20:28'),
(67, 1, 2, 0, '&lt;script&gt;', '2022-10-12 12:26:10'),
(68, 1, 2, 0, '&lt;script&gt;alert(&quot;aahmet&quot;)&lt;/script&gt;', '2022-10-12 12:26:33'),
(69, 1, 2, 0, 'mmm', '2022-10-12 12:30:10'),
(70, 2, 2, 1, 'xaaax', '2022-10-12 12:48:09'),
(71, 2, 2, 1, 'xaaaxsasas', '2022-10-12 12:48:16'),
(72, 2, 2, 0, 'a', '2022-10-12 12:48:50'),
(73, 2, 2, 0, 'aaaaa', '2022-10-12 12:49:08'),
(74, 2, 2, 1, 'xaxa', '2022-10-12 12:49:15'),
(75, 2, 2, 0, 'aa', '2022-10-12 13:03:03'),
(76, 4, 2, 0, 'Selamlar', '2022-10-12 13:45:52'),
(77, 4, 2, 1, 'Merhabalar size nasıl yardımcı olabiliriz', '2022-10-12 13:46:19'),
(78, 4, 2, 0, 'Valla bana bi baklava lazımdı', '2022-10-12 13:46:32'),
(79, 4, 2, 1, 'hemen gönderiyorum adres yollayın', '2022-10-12 14:08:40'),
(80, 2, 2, 0, 'abi nasılsın', '2022-10-12 19:07:39'),
(81, 4, 2, 0, 'abi nasılsın', '2022-10-12 19:08:19'),
(82, 4, 2, 1, 'iyiyim canım', '2022-10-12 19:08:30'),
(83, 4, 2, 1, 'abi ♥', '2022-10-12 19:10:13'),
(84, 4, 2, 0, 'evy', '2022-10-12 19:10:21'),
(85, 5, 1, 1, 'Merhaba', '2022-10-13 04:33:50'),
(86, 5, 1, 0, 'merhaba', '2022-10-13 04:33:57'),
(87, 2, 2, 1, 'Allaha şükürler olsun hamd olsun gardaş iyiyim', '2022-10-13 05:04:06'),
(88, 5, 1, 0, 'azxaxa', '2022-10-13 08:19:59'),
(89, 5, 1, 0, 'xa', '2022-10-13 09:07:15'),
(90, 6, 1, 0, 'aa', '2022-10-13 09:18:40'),
(91, 6, 1, 1, 'sea', '2022-10-13 09:19:58'),
(92, 13, 2, 0, 'deneme', '2022-10-13 10:22:59'),
(93, 4, 2, 7, 'a.s', '2022-10-13 10:26:28'),
(94, 13, 2, 0, 'deneme', '2022-10-12 10:21:11'),
(96, 14, 2, 0, 'a', '2022-10-13 15:59:54');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `supports`
--

CREATE TABLE `supports` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `department` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `supports`
--

INSERT INTO `supports` (`id`, `title`, `message`, `department`, `status`, `ownerId`, `date`) VALUES
(2, 'Yaşam', '<p>Nasıl yaşanır</p>\n', 1, 3, 2, '2022-10-13 09:25:55'),
(5, 'Deneme', '<p>Deneme</p>\n', 2, 1, 2, '2022-10-13 09:26:53'),
(13, 'bilgisayarım açılmıyor ', '<p><strong>mavi ekran hatası alıyorum</strong></p>\n', 2, 1, 2, '2022-10-13 10:25:53'),
(14, 'Merhaba', '<p>Maaşım hala yatmadı</p>\n', 2, 1, 2, '2022-10-13 15:59:54'),
(15, 'aaa', '<p>aa</p>\n', 1, 1, 1, '2022-10-13 15:59:15');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `supportdata`
--
ALTER TABLE `supportdata`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `supportdata`
--
ALTER TABLE `supportdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Tablo için AUTO_INCREMENT değeri `supports`
--
ALTER TABLE `supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
