-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Eki 2022, 06:23:02
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
(1, 'Ahmet Mücahit', 'DOĞRU', 'dogrumucahit@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, '2022-10-08 22:08:55'),
(2, 'Yusuf', 'Gül', 'yusuf@tufcode.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 0, '0000-00-00 00:00:00');

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
(1, 'Teknik Destek');

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
(10, 'Sayfa', '', 0, 1, 0, 1, 'fa fa-columns', 0),
(11, 'Tümü', 'supports.php', 0, 1, 7, 0, '', 0),
(12, 'Yanıt Bekleyenler', 'support-wait.php', 0, 1, 7, 0, '', 0),
(13, 'Ayarlar', '#', 0, 1, 0, 0, 'fa fa-gear', 0),
(15, 'Sayfa Ekle', '#', 0, 1, 10, 0, '', 0),
(16, 'Kapatılanlar', 'support-close.php', 0, 1, 7, 0, '', 0),
(17, 'Yanıtlananlar', 'support-answered.php', 0, 1, 7, 0, '', 0),
(18, 'Departmanlar', 'departments.php', 0, 1, 7, 0, '', 0),
(19, 'Departman Ekle', 'support-close.php', 0, 1, 7, 0, '', 0);

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
(1, 'Yönetici');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `supportdata`
--

CREATE TABLE `supportdata` (
  `id` int(11) NOT NULL,
  `supportId` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `returningPersonId` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `supportdata`
--

INSERT INTO `supportdata` (`id`, `supportId`, `ownerId`, `returningPersonId`, `message`, `date`) VALUES
(1, 15, 1, 1, 'mesaj', '0000-00-00'),
(2, 15, 1, 1, 'mesaj2', '0000-00-00'),
(3, 15, 1, 1, 'mesaj2', '0000-00-00');

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
(12, 'AhmetAhmetAhmetAhmetAhmetAhmetAhmetAhmetAhmetAhmetAhmetAhmet', '<p>a</p>\n', 1, 2, 1, '2022-10-10 18:13:15'),
(15, 'Kapalı mesaj2', '<h1>Selam</h1>', 1, 0, 1, '2022-10-10 20:11:28'),
(16, 'Nasıl Açıcağım', '<p>Merhaba nasıl bir sunucu kuracağım</p>\n', 1, 0, 2, '2022-10-09 20:46:37');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `supportdata`
--
ALTER TABLE `supportdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `supports`
--
ALTER TABLE `supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
