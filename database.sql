-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Cze 2016, 00:21
-- Wersja serwera: 10.1.8-MariaDB
-- Wersja PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `database`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kolejka`
--

CREATE TABLE `kolejka` (
  `idKolejka` int(5) NOT NULL,
  `dataRozp` datetime NOT NULL,
  `dataZak` datetime NOT NULL,
  `idPrac` int(5) NOT NULL,
  `numer` int(5) NOT NULL,
  `idTyp` int(5) DEFAULT NULL,
  `obslugiwany` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kolejkatyp`
--

CREATE TABLE `kolejkatyp` (
  `idTyp` int(5) NOT NULL,
  `priorytet` int(5) NOT NULL,
  `nazwa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `kolejkatyp`
--

INSERT INTO `kolejkatyp` (`idTyp`, `priorytet`, `nazwa`) VALUES
(1, 1, 'zwykly'),
(2, 2, 'priorytetowy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownik`
--

CREATE TABLE `pracownik` (
  `idPrac` int(5) NOT NULL,
  `imie` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nazwisko` varchar(50) CHARACTER SET latin1 NOT NULL,
  `login` varchar(50) CHARACTER SET latin1 NOT NULL,
  `haslo` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `pracownik`
--

INSERT INTO `pracownik` (`idPrac`, `imie`, `nazwisko`, `login`, `haslo`) VALUES
(1, 'Radek', 'Jachymiak', 'admin', 'admin'),
(2, 'Piotr', 'Dziekonski', 'user', 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `kolejka`
--
ALTER TABLE `kolejka`
  ADD PRIMARY KEY (`idKolejka`);

--
-- Indexes for table `kolejkatyp`
--
ALTER TABLE `kolejkatyp`
  ADD PRIMARY KEY (`idTyp`);

--
-- Indexes for table `pracownik`
--
ALTER TABLE `pracownik`
  ADD PRIMARY KEY (`idPrac`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `kolejka`
--
ALTER TABLE `kolejka`
  MODIFY `idKolejka` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `kolejkatyp`
--
ALTER TABLE `kolejkatyp`
  MODIFY `idTyp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `pracownik`
--
ALTER TABLE `pracownik`
  MODIFY `idPrac` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
