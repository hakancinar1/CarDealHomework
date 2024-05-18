-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: sql208.infinityfree.com
-- Üretim Zamanı: 18 May 2024, 17:39:20
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `if0_36572271_dbcardeal`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `TBContacts`
--

CREATE TABLE `TBContacts` (
  `ID` int(11) NOT NULL,
  `ContactName` varchar(250) DEFAULT NULL,
  `ContactMessage` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `TBContacts`
--

INSERT INTO `TBContacts` (`ID`, `ContactName`, `ContactMessage`) VALUES
(25, 'User Name : Isa', 'Cool Services!'),
(26, 'User Name : Hakan', 'Proud to work with you. Thank you for attention.'),
(27, 'Guest : Jenica', 'I am happy to buy my first car from you brand. Thank you for your cooperation!'),
(28, 'Guest : Michael', 'Good Cars...'),
(29, 'User Name : Jason', 'I hope we can see each other soon!'),
(30, 'Guest : Adam', 'I love my car!'),
(31, 'User Name : Hakan', 'I got 5 cars from here');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `TBProducts`
--

CREATE TABLE `TBProducts` (
  `ID` int(11) NOT NULL,
  `CarName` varchar(250) DEFAULT NULL,
  `ImagePath` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `TBUsers`
--

CREATE TABLE `TBUsers` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(250) DEFAULT NULL,
  `UserPwd` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `TBUsers`
--

INSERT INTO `TBUsers` (`ID`, `UserName`, `UserPwd`) VALUES
(11, 'Isa', 'Baba'),
(14, 'Hakan', 'qaz'),
(15, 'Jason', '123'),
(16, 'Mert', 'qwer'),
(17, 'Derya', 'Cinar');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `TBContacts`
--
ALTER TABLE `TBContacts`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `TBProducts`
--
ALTER TABLE `TBProducts`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `TBUsers`
--
ALTER TABLE `TBUsers`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `TBContacts`
--
ALTER TABLE `TBContacts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `TBProducts`
--
ALTER TABLE `TBProducts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `TBUsers`
--
ALTER TABLE `TBUsers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
