-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Paź 2021, 03:26
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `task`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `client`
--

CREATE TABLE `client` (
  `id` int(10) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` int(9) NOT NULL,
  `newsletter` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `delivery`
--

INSERT INTO `delivery` (`id`, `type`) VALUES
(1, 'Paczkomaty'),
(2, 'DPD'),
(3, 'DPD Pobranie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `different_address`
--

CREATE TABLE `different_address` (
  `id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `discount`
--

CREATE TABLE `discount` (
  `id` int(10) NOT NULL,
  `code` varchar(50) NOT NULL,
  `percent` float NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `discount`
--

INSERT INTO `discount` (`id`, `code`, `percent`, `active`) VALUES
(1, '20promo', 0.2, 1),
(2, '50promo', 0.5, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order`
--

CREATE TABLE `order` (
  `id` int(10) NOT NULL,
  `id_client` int(10) NOT NULL,
  `price` float NOT NULL,
  `product` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `id_delivery` int(10) NOT NULL,
  `id_payment` int(10) NOT NULL,
  `id_discount` int(10) NOT NULL,
  `comment` varchar(150) NOT NULL,
  `id_different_address` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment`
--

CREATE TABLE `payment` (
  `id` int(10) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `payment`
--

INSERT INTO `payment` (`id`, `type`) VALUES
(1, 'PayU'),
(2, 'Platnosc przy odbiorze'),
(3, 'Przelew bankowy');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `different_address`
--
ALTER TABLE `different_address`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_payment_key` (`id_payment`),
  ADD KEY `id_delivery_key` (`id_delivery`),
  ADD KEY `id_discount_key` (`id_discount`),
  ADD KEY `id_client_key` (`id_client`),
  ADD KEY `id_different_address` (`id_different_address`);

--
-- Indeksy dla tabeli `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `different_address`
--
ALTER TABLE `different_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `id_client_key` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `id_delivery_key` FOREIGN KEY (`id_delivery`) REFERENCES `delivery` (`id`),
  ADD CONSTRAINT `id_different_address_key` FOREIGN KEY (`id_different_address`) REFERENCES `different_address` (`id`),
  ADD CONSTRAINT `id_discount_key` FOREIGN KEY (`id_discount`) REFERENCES `discount` (`id`),
  ADD CONSTRAINT `id_payment_key` FOREIGN KEY (`id_payment`) REFERENCES `payment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
