-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Sty 2019, 00:31
-- Wersja serwera: 10.1.37-MariaDB-2.cba
-- Wersja PHP: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `jakubadamus`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `base`
--

CREATE TABLE `base` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `defence` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `base`
--

INSERT INTO `base` (`ID`, `name`, `price`, `defence`, `thumbnail`) VALUES
(1, 'inzynier', 0, 0, 'assets/bases/base_engineer.png'),
(2, 'snajper', 0, 0, 'assets/bases/base_sniper.png'),
(3, 'szturmowiec', 0, 0, 'assets/bases/base_sturm.png'),
(4, 'szpieg', 0, 0, 'assets/bases/base_sturm.png'),
(5, 'saper', 0, 0, 'assets/bases/base_engineer.png'),
(6, 'commander', 0, 0, 'assets/bases/base_sniper.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `boots`
--

CREATE TABLE `boots` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `defence` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `boots`
--

INSERT INTO `boots` (`ID`, `name`, `price`, `defence`, `thumbnail`) VALUES
(1, 'Basic Leather Boots', 10, 2, 'assets/boots/boots_basicleather.png'),
(2, 'Basic Cotton', 20, 4, 'assets/boots/boots_basiccotton.png'),
(3, 'Basic Reinforced Boots', 100, 10, 'assets/boots/boots_basicreinforced.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gloves`
--

CREATE TABLE `gloves` (
  `ID` tinyint(4) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(4) NOT NULL,
  `defence` int(4) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `gloves`
--

INSERT INTO `gloves` (`ID`, `name`, `price`, `defence`, `thumbnail`) VALUES
(1, 'Basic DIY Gloves', 10, 2, 'assets/gloves/gloves_diy.png'),
(2, 'Basic Leather Gloves', 100, 5, 'assets/gloves/gloves_leather.png'),
(3, 'Basic Reinforced Gloves', 120, 10, 'assets/gloves/gloves_reinforced.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `helmet`
--

CREATE TABLE `helmet` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `defence` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `helmet`
--

INSERT INTO `helmet` (`ID`, `name`, `price`, `defence`, `thumbnail`) VALUES
(1, 'Basic Green', 50, 5, 'assets/helmets/helmets_basicgreen.png'),
(2, 'Basic Black', 150, 10, 'assets/helmets/helmets_basicblack.png'),
(3, 'Basic Pink', 200, 20, 'assets/helmets/helmets_basicpink.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `ID` int(11) NOT NULL,
  `uczen_ID` int(11) NOT NULL,
  `przedmiot` enum('mat','fiz','pl') COLLATE latin1_general_ci NOT NULL,
  `ocena` float NOT NULL,
  `komentarz` text COLLATE latin1_general_ci NOT NULL,
  `data` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `oceny`
--

INSERT INTO `oceny` (`ID`, `uczen_ID`, `przedmiot`, `ocena`, `komentarz`, `data`) VALUES
(1, 1, 'mat', 4, 'sprawdzian 1', '2018-12-01'),
(2, 1, 'mat', 2, 'sprawdzian 2', '2018-12-14'),
(3, 1, 'fiz', 1, 'aaaaa', '2018-11-01'),
(4, 1, 'mat', 3.5, 'kartkowka', '2018-12-20'),
(5, 1, 'mat', 6, 'spyrek', '2018-12-22'),
(6, 1, 'fiz', 3, 'aa', '2018-12-01'),
(7, 1, 'fiz', 4, 'aa', '2018-12-11'),
(8, 1, 'pl', 3, '', '2018-10-01'),
(9, 1, 'pl', 5, 's', '2018-12-01'),
(10, 1, 'pl', 2, 'sdfsf', '2018-12-01'),
(11, 1, 'pl', 4, 'fdsdsf', '2018-12-21'),
(12, 1, 'pl', 1, 'fdsdsf', '2018-12-21'),
(13, 1, 'pl', 5, 'ssssfdsf', '2018-12-22'),
(14, 1, 'pl', 2, 'ssssfdsf', '2018-12-22'),
(15, 1, 'fiz', 6, 'heh', '2018-12-05'),
(16, 4, 'mat', 5, 'lelXDpawel', '2019-01-05');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pants`
--

CREATE TABLE `pants` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `defence` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `pants`
--

INSERT INTO `pants` (`ID`, `name`, `price`, `defence`, `thumbnail`) VALUES
(1, 'Baisc Leather Pants', 10, 5, 'assets/pants/pants_basicleather.png\r\n'),
(2, 'Basic Cotton Pants', 100, 10, 'assets/pants/pants_basiccotton.png'),
(3, 'Basic Reinforced Pants', 150, 20, 'assets/pants/pants_basicreinforced.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `perk1`
--

CREATE TABLE `perk1` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `perk1`
--

INSERT INTO `perk1` (`ID`, `name`, `price`, `attack`, `thumbnail`) VALUES
(1, 'melee', 0, 1, 'assets/perks/perk1_melee.png'),
(2, 'Fork', 10, 5, 'assets/perks/perk1_fork.png'),
(3, 'Basic Sword', 50, 10, 'assets/perks/perk1_basicsword.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `perk2`
--

CREATE TABLE `perk2` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `perk2`
--

INSERT INTO `perk2` (`ID`, `name`, `price`, `attack`, `thumbnail`) VALUES
(1, 'melee', 0, 1, 'assets/perks/perk2_melee.png'),
(2, 'Fork', 10, 5, 'assets/perks/perk2_fork.png'),
(3, 'Basic Sword', 50, 10, 'assets/perks/perk2_basicsword.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `perk3`
--

CREATE TABLE `perk3` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `perk3`
--

INSERT INTO `perk3` (`ID`, `name`, `price`, `attack`, `thumbnail`) VALUES
(1, 'melee', 0, 1, 'assets/perks/perk3_melee.png'),
(2, 'Fork', 10, 5, 'assets/perks/perk3_fork.png'),
(3, 'Basic Sword', 50, 10, 'assets/perks/perk3_basicsword.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `torso`
--

CREATE TABLE `torso` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `defence` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `torso`
--

INSERT INTO `torso` (`ID`, `name`, `price`, `defence`, `thumbnail`) VALUES
(1, 'Basic Torso Green', 10, 20, 'assets/torsos/torso_basicgreen.png'),
(2, 'Basic Torso Camo', 100, 50, 'assets/torsos/torso_basiccamo.png'),
(3, 'Basic Reinforced Torso', 150, 60, 'assets/torsos/torso_basicreinforced.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczniowie`
--

CREATE TABLE `uczniowie` (
  `uczen_ID` int(11) NOT NULL,
  `nazwa_szkoly` enum('technikum_kreatywne','lo3_szczecin') COLLATE latin1_general_ci NOT NULL,
  `imie` text COLLATE latin1_general_ci NOT NULL,
  `nazwisko` text COLLATE latin1_general_ci NOT NULL,
  `klasa` tinyint(4) NOT NULL,
  `coins` float DEFAULT NULL,
  `uczen_object` text COLLATE latin1_general_ci,
  `wartosc_postaci` float DEFAULT NULL,
  `spendable_coins` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `uczniowie`
--

INSERT INTO `uczniowie` (`uczen_ID`, `nazwa_szkoly`, `imie`, `nazwisko`, `klasa`, `coins`, `uczen_object`, `wartosc_postaci`, `spendable_coins`) VALUES
(1, 'technikum_kreatywne', 'Jakub', 'Adamus', 2, 163.5, '{\"base\":\"1\",\"helmet\":\"1\",\"torso\":\"1\",\"gloves\":\"1\",\"pants\":\"1\",\"boots\":\"1\",\"weapon\":\"1\",\"weapon2\":\"1\",\"weapon3\":\"1\",\"weapon4\":\"1\",\"weapon5\":\"1\",\"perk1\":\"1\",\"perk2\":\"1\",\"perk3\":\"1\"}', 90, 73.5),
(2, 'lo3_szczecin', 'Adam', 'Siekawa', 2, 0, '', 0, 0),
(3, 'technikum_kreatywne', 'Kacper', 'Random', 2, 0, '', 0, 0),
(4, 'lo3_szczecin', 'Pawel', 'Adamus', 1, 25, '{\"base\":\"1\",\"helmet\":0,\"torso\":\"1\",\"gloves\":0,\"pants\":0,\"boots\":0,\"weapon\":0,\"weapon2\":0,\"weapon5\":0,\"weapon3\":0,\"weapon4\":0,\"perk1\":0,\"perk3\":0,\"perk2\":0}', 0, 25);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `visit_counter`
--

CREATE TABLE `visit_counter` (
  `date` datetime NOT NULL,
  `ip` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `visit_counter`
--

INSERT INTO `visit_counter` (`date`, `ip`) VALUES
('2018-10-16 11:06:27', '89.229.95.152'),
('2018-10-16 11:21:29', '89.229.95.152'),
('2018-10-16 11:26:08', '89.229.95.152'),
('2018-10-16 11:26:28', '89.229.95.152'),
('2018-10-16 11:27:14', '89.229.95.152'),
('2018-10-16 11:28:51', '89.229.95.152'),
('2018-10-16 11:30:10', '89.229.95.152'),
('2018-10-16 11:30:46', '89.229.95.152'),
('2018-10-16 15:10:30', '89.229.95.152'),
('2018-10-16 15:10:38', '89.229.95.152'),
('2018-10-16 15:10:40', '89.229.95.152'),
('2018-10-16 16:51:28', '178.235.183.63'),
('2018-10-16 20:59:51', '89.229.95.152'),
('2018-10-17 06:56:02', '89.229.95.152'),
('2018-10-17 19:39:35', '89.229.95.152'),
('2018-10-17 21:38:40', '89.229.95.152'),
('2018-10-17 21:52:56', '178.235.183.41'),
('2018-10-17 21:58:53', '178.235.183.41'),
('2018-10-17 22:02:17', '69.171.251.17'),
('2018-10-17 22:12:01', '89.229.95.152'),
('2018-10-17 22:12:45', '89.229.95.152'),
('2018-10-17 22:12:49', '89.229.95.152'),
('2018-10-17 22:12:57', '89.229.95.152'),
('2018-10-17 22:12:57', '89.229.95.152'),
('2018-10-17 22:12:57', '89.229.95.152'),
('2018-10-17 22:12:57', '89.229.95.152'),
('2018-10-17 22:13:06', '89.229.95.152'),
('2018-10-17 22:16:39', '89.229.95.152'),
('2018-10-17 22:16:45', '89.229.95.152'),
('2018-10-17 22:17:45', '89.229.95.152'),
('2018-10-17 22:17:52', '89.229.95.152'),
('2018-10-17 22:34:00', '89.229.95.152'),
('2018-10-17 22:34:55', '89.229.95.152'),
('2018-10-18 13:01:20', '46.105.92.122'),
('2018-10-18 16:25:58', '89.229.95.152'),
('2018-10-18 19:41:45', '178.235.183.194'),
('2018-10-18 20:34:39', '178.235.183.194'),
('2018-10-18 20:36:19', '178.235.183.194'),
('2018-10-19 11:10:36', '188.146.132.204'),
('2018-10-19 14:37:15', '89.229.95.152'),
('2018-10-19 15:14:13', '89.229.95.152'),
('2018-10-19 16:11:04', '178.235.183.136'),
('2018-10-19 16:59:25', '178.235.183.136'),
('2018-10-19 17:19:16', '178.235.183.136'),
('2018-10-19 17:19:34', '178.235.183.136'),
('2018-10-19 18:40:11', '178.235.183.136'),
('2018-10-19 19:07:21', '178.235.183.136'),
('2018-10-19 19:12:38', '178.235.183.136'),
('2018-10-19 20:26:30', '188.147.38.13'),
('2018-10-19 20:53:05', '178.235.183.136'),
('2018-10-19 21:27:26', '178.235.183.136'),
('2018-10-20 09:18:55', '178.235.183.136'),
('2018-10-20 14:52:33', '89.229.95.152'),
('2018-10-20 18:32:38', '178.235.183.142'),
('2018-10-20 22:30:40', '178.235.183.142'),
('2018-10-21 09:53:44', '173.252.95.13'),
('2018-10-22 08:40:12', '89.229.95.152'),
('2018-10-22 08:42:53', '89.229.95.152'),
('2018-10-22 08:42:57', '89.229.95.152'),
('2018-10-22 08:42:58', '89.229.95.152'),
('2018-10-22 08:42:59', '89.229.95.152'),
('2018-10-22 08:42:59', '89.229.95.152'),
('2018-10-22 08:43:00', '89.229.95.152'),
('2018-10-22 08:43:00', '89.229.95.152'),
('2018-10-22 08:43:01', '89.229.95.152'),
('2018-10-22 08:43:01', '89.229.95.152'),
('2018-10-22 08:43:01', '89.229.95.152'),
('2018-10-22 08:43:02', '89.229.95.152'),
('2018-10-22 08:43:03', '89.229.95.152'),
('2018-10-22 08:43:04', '89.229.95.152'),
('2018-10-22 08:43:05', '89.229.95.152'),
('2018-10-22 08:43:13', '89.229.95.152'),
('2018-10-22 08:44:14', '89.229.95.152'),
('2018-10-22 16:12:29', '178.235.183.133'),
('2018-10-22 19:47:32', '178.235.183.20'),
('2018-10-22 21:15:23', '178.235.183.20'),
('2018-10-23 10:55:43', '89.229.95.152'),
('2018-10-23 10:55:53', '89.229.95.152'),
('2018-10-23 10:55:56', '89.229.95.152'),
('2018-10-23 10:56:24', '89.229.95.152'),
('2018-10-23 10:57:09', '89.229.95.152'),
('2018-10-23 10:57:55', '89.229.95.152'),
('2018-10-23 11:41:20', '89.229.95.152'),
('2018-10-23 11:41:34', '89.229.95.152'),
('2018-10-23 11:42:52', '89.229.95.152'),
('2018-10-23 11:42:53', '89.229.95.152'),
('2018-10-23 11:42:53', '89.229.95.152'),
('2018-10-23 11:42:53', '89.229.95.152'),
('2018-10-23 11:42:54', '89.229.95.152'),
('2018-10-23 11:42:54', '89.229.95.152'),
('2018-10-23 11:44:03', '89.229.95.152'),
('2018-10-23 11:44:10', '89.229.95.152'),
('2018-10-23 11:44:14', '89.229.95.152'),
('2018-10-23 11:44:21', '89.229.95.152'),
('2018-10-23 11:44:34', '89.229.95.152'),
('2018-10-23 11:44:57', '89.229.95.152'),
('2018-10-23 11:45:13', '89.229.95.152'),
('2018-10-23 11:46:36', '89.229.95.152'),
('2018-10-23 11:47:32', '89.229.95.152'),
('2018-10-23 11:47:46', '89.229.95.152'),
('2018-10-23 11:48:36', '89.229.95.152'),
('2018-10-23 11:49:16', '89.229.95.152'),
('2018-10-23 11:49:48', '89.229.95.152'),
('2018-10-23 11:49:54', '89.229.95.152'),
('2018-10-23 11:50:20', '89.229.95.152'),
('2018-10-23 11:51:03', '89.229.95.152'),
('2018-10-23 12:23:50', '89.229.95.152'),
('2018-10-23 15:13:59', '89.229.95.152'),
('2018-10-23 17:05:54', '89.229.95.152'),
('2018-10-23 17:32:04', '89.229.95.152'),
('2018-10-23 18:47:13', '89.229.95.152'),
('2018-10-23 18:47:37', '89.229.95.152'),
('2018-10-23 18:49:29', '89.229.95.152'),
('2018-10-23 18:49:32', '89.229.95.152'),
('2018-10-23 18:49:39', '89.229.95.152'),
('2018-10-23 20:46:44', '91.231.92.2'),
('2018-10-23 20:53:43', '91.231.92.2'),
('2018-10-23 21:00:23', '91.231.92.2'),
('2018-10-23 22:24:02', '89.229.95.152'),
('2018-10-23 22:27:06', '89.229.95.152'),
('2018-10-23 22:27:42', '89.229.95.152'),
('2018-10-23 22:39:11', '89.229.95.152'),
('2018-10-24 00:54:14', '89.229.95.152'),
('2018-10-24 03:21:06', '216.145.5.42'),
('2018-10-24 18:15:47', '89.229.95.152'),
('2018-10-24 21:19:31', '91.231.92.2'),
('2018-10-24 21:26:49', '91.231.92.2'),
('2018-10-25 19:47:38', '178.235.183.137'),
('2018-10-26 03:31:55', '188.146.165.126'),
('2018-10-26 19:52:01', '178.235.183.166'),
('2018-10-26 21:45:20', '188.147.105.103'),
('2018-10-26 23:14:32', '188.147.105.103'),
('2018-10-27 21:00:37', '188.147.96.131'),
('2018-10-28 11:54:23', '89.229.95.152'),
('2018-10-28 19:39:00', '188.146.96.169'),
('2018-10-28 20:17:10', '188.146.96.169'),
('2018-10-28 20:40:09', '188.146.96.169'),
('2018-10-28 21:55:24', '188.146.105.179'),
('2018-10-29 16:56:13', '188.146.65.126'),
('2018-10-29 17:11:16', '188.146.65.126'),
('2018-10-29 22:13:53', '188.146.105.179'),
('2018-10-29 23:27:09', '188.146.105.179'),
('2018-10-30 20:34:34', '188.146.96.169'),
('2018-10-31 16:47:07', '188.146.105.179'),
('2018-10-31 17:59:00', '188.146.105.179'),
('2018-10-31 18:08:21', '188.146.105.179'),
('2018-11-01 10:30:59', '188.146.105.179'),
('2018-11-01 10:49:15', '89.229.95.152'),
('2018-11-01 11:48:26', '69.171.251.29'),
('2018-11-01 11:48:35', '89.229.95.152'),
('2018-11-02 15:46:17', '188.146.67.198'),
('2018-11-02 21:35:57', '188.146.69.112'),
('2018-11-02 21:42:07', '188.146.69.112'),
('2018-11-02 22:14:23', '188.146.69.112'),
('2018-11-02 22:29:28', '188.146.69.112'),
('2018-11-04 17:34:49', '188.146.224.135'),
('2018-11-04 22:00:56', '188.146.224.135'),
('2018-11-04 22:06:03', '188.146.224.135'),
('2018-11-05 19:33:32', '188.146.225.89'),
('2018-11-05 19:56:29', '188.146.225.89'),
('2018-11-05 22:32:13', '188.146.225.89'),
('2018-11-05 22:34:04', '66.249.83.76'),
('2018-11-05 22:34:05', '66.249.83.76'),
('2018-11-05 23:05:16', '188.146.225.89'),
('2018-11-07 17:41:21', '188.146.230.86'),
('2018-11-07 18:06:06', '188.146.230.86'),
('2018-11-07 21:08:35', '188.146.230.86'),
('2018-11-07 21:44:43', '188.146.230.86'),
('2018-11-07 21:44:56', '188.146.230.86'),
('2018-11-08 17:33:19', '188.146.230.86'),
('2018-11-08 17:56:10', '188.146.230.86'),
('2018-11-08 21:28:01', '188.146.230.86'),
('2018-11-09 16:12:42', '178.235.191.214'),
('2018-11-10 17:54:15', '178.235.191.190'),
('2018-11-12 18:48:02', '178.235.191.91'),
('2018-11-12 20:29:27', '178.235.191.91'),
('2018-11-12 20:58:12', '178.235.191.91'),
('2018-11-12 21:07:24', '178.235.191.91'),
('2018-11-12 22:00:22', '178.235.191.91'),
('2018-11-12 22:03:13', '216.145.17.190'),
('2018-11-12 22:09:25', '178.235.191.91'),
('2018-11-12 23:04:49', '89.229.95.152'),
('2018-11-13 14:37:18', '37.128.104.66'),
('2018-11-13 18:11:07', '178.235.191.98'),
('2018-11-13 21:58:26', '178.235.191.123'),
('2018-11-13 22:33:33', '178.235.191.123'),
('2018-11-13 22:35:07', '178.235.191.123'),
('2018-11-14 05:45:00', '18.234.116.10'),
('2018-11-14 05:45:00', '18.234.116.10'),
('2018-11-14 19:22:27', '178.235.191.116'),
('2018-11-14 21:19:56', '178.235.191.116'),
('2018-11-14 23:08:32', '94.180.217.92'),
('2018-11-15 19:50:30', '178.235.191.205'),
('2018-11-15 20:51:48', '178.235.191.205'),
('2018-11-16 08:50:10', '178.235.191.205'),
('2018-11-16 20:09:34', '178.235.191.62'),
('2018-11-17 21:03:10', '178.235.191.217'),
('2018-11-18 12:23:12', '178.235.191.214'),
('2018-11-18 17:12:35', '178.235.191.214'),
('2018-11-19 08:59:33', '89.229.95.152'),
('2018-11-19 20:22:05', '178.235.191.207'),
('2018-11-19 20:32:45', '178.235.191.207'),
('2018-11-21 19:38:49', '89.64.6.213'),
('2018-11-22 16:27:28', '178.235.191.140'),
('2018-11-23 20:56:57', '178.235.191.5'),
('2018-11-24 12:52:06', '178.235.191.179'),
('2018-11-24 20:40:52', '178.235.191.213'),
('2018-11-26 16:47:13', '188.146.36.67'),
('2018-11-26 17:07:35', '188.146.36.67'),
('2018-11-26 21:46:22', '178.235.191.5'),
('2018-11-26 22:48:46', '178.235.191.5'),
('2018-11-27 12:56:25', '91.231.92.2'),
('2018-11-27 15:00:28', '91.231.92.2'),
('2018-11-27 21:12:42', '178.235.191.135'),
('2018-11-27 23:00:06', '89.229.95.152'),
('2018-11-27 23:04:30', '89.229.95.152'),
('2018-11-28 22:09:27', '188.146.44.143'),
('2018-11-28 23:04:13', '188.146.44.143'),
('2018-11-29 14:26:21', '5.173.184.6'),
('2018-11-29 21:44:03', '178.235.191.24'),
('2018-11-29 22:02:51', '178.235.191.24'),
('2018-11-30 07:57:23', '178.235.191.72'),
('2018-11-30 08:17:26', '178.235.191.72'),
('2018-11-30 09:53:41', '91.231.92.2'),
('2018-11-30 09:53:41', '91.231.92.2'),
('2018-11-30 18:23:53', '178.235.191.72'),
('2018-12-01 11:33:50', '178.235.191.72'),
('2018-12-01 13:00:52', '93.105.125.192'),
('2018-12-02 10:38:03', '178.235.191.18'),
('2018-12-02 13:21:12', '173.252.87.15'),
('2018-12-02 18:52:25', '178.235.191.13'),
('2018-12-02 18:59:54', '178.235.191.13'),
('2018-12-02 19:00:17', '178.235.191.13'),
('2018-12-02 19:49:31', '178.235.191.13'),
('2018-12-02 20:50:55', '178.235.191.13'),
('2018-12-03 01:31:11', '64.246.187.42'),
('2018-12-03 14:52:08', '178.235.191.79'),
('2018-12-03 18:29:28', '178.235.191.79'),
('2018-12-04 07:11:03', '178.235.191.137'),
('2018-12-04 19:08:56', '178.235.191.91'),
('2018-12-05 21:02:14', '178.235.191.181'),
('2018-12-05 22:01:53', '178.235.191.181'),
('2018-12-05 22:06:35', '178.235.191.181'),
('2018-12-06 09:11:30', '188.146.78.107'),
('2018-12-07 08:56:58', '188.146.165.74'),
('2018-12-07 16:15:11', '188.146.165.74'),
('2018-12-09 10:59:52', '178.235.191.129'),
('2018-12-09 11:23:38', '178.235.191.129'),
('2018-12-09 19:34:22', '178.235.191.129'),
('2018-12-09 20:06:44', '178.235.191.129'),
('2018-12-09 20:55:25', '178.235.191.129'),
('2018-12-10 12:11:53', '188.146.130.238'),
('2018-12-10 17:03:03', '178.235.191.29'),
('2018-12-10 20:39:43', '178.235.191.29'),
('2018-12-10 21:48:41', '178.235.191.29'),
('2018-12-10 22:03:14', '188.147.36.215'),
('2018-12-11 18:12:03', '52.53.201.78'),
('2018-12-12 09:57:14', '69.171.251.17'),
('2018-12-12 16:50:47', '178.235.191.53'),
('2018-12-12 18:49:48', '89.229.64.83'),
('2018-12-13 12:21:49', '178.235.191.9'),
('2018-12-13 12:53:27', '188.147.35.118'),
('2018-12-13 20:30:55', '178.235.191.162'),
('2018-12-14 01:52:31', '52.53.201.78'),
('2018-12-14 08:13:33', '209.17.97.42'),
('2018-12-16 11:13:43', '52.53.201.78'),
('2018-12-16 19:11:32', '178.235.191.3'),
('2018-12-16 20:09:37', '178.235.191.3'),
('2018-12-17 20:31:04', '178.235.191.20'),
('2018-12-17 20:40:30', '188.146.225.26'),
('2018-12-18 09:54:08', '209.17.96.50'),
('2018-12-18 19:41:52', '52.53.201.78'),
('2018-12-18 20:46:32', '178.235.191.20'),
('2018-12-18 21:33:31', '188.146.228.120'),
('2018-12-18 22:56:41', '188.146.228.120'),
('2018-12-18 23:15:44', '188.146.228.120'),
('2018-12-19 10:12:59', '91.231.92.2'),
('2018-12-19 10:17:52', '91.231.92.2'),
('2018-12-19 10:45:38', '5.173.192.99'),
('2018-12-19 20:29:23', '178.235.191.27'),
('2018-12-20 10:28:21', '91.231.92.2'),
('2018-12-20 16:50:45', '178.235.191.32'),
('2018-12-21 03:54:05', '52.53.201.78'),
('2018-12-21 16:10:16', '188.146.46.114'),
('2018-12-22 18:45:29', '178.235.191.127'),
('2018-12-22 21:12:02', '178.235.191.127'),
('2018-12-22 22:19:08', '34.217.108.221'),
('2018-12-23 10:10:10', '178.235.191.127'),
('2018-12-23 11:25:13', '52.53.201.78'),
('2018-12-23 13:50:38', '188.146.224.127'),
('2018-12-23 18:55:59', '178.235.191.127'),
('2018-12-24 03:22:07', '216.145.14.142'),
('2018-12-24 22:07:16', '178.235.191.48'),
('2018-12-25 19:36:56', '52.53.201.78'),
('2018-12-26 14:10:17', '209.17.96.250'),
('2018-12-26 20:57:58', '188.147.102.69'),
('2018-12-26 20:59:04', '188.147.102.69'),
('2018-12-26 23:06:39', '188.147.102.69'),
('2018-12-27 16:07:49', '188.147.102.52'),
('2018-12-27 17:14:13', '188.147.102.52'),
('2018-12-27 20:41:02', '188.147.102.15'),
('2018-12-27 22:32:27', '188.147.102.52'),
('2018-12-27 22:36:59', '188.147.102.52'),
('2018-12-27 23:45:54', '188.147.102.52'),
('2018-12-28 04:45:51', '52.53.201.78'),
('2018-12-30 12:59:40', '52.53.201.78'),
('2018-12-31 16:01:10', '188.146.107.184'),
('2018-12-31 16:27:01', '188.146.107.184'),
('2018-12-31 16:27:36', '188.146.107.184'),
('2019-01-01 15:06:07', '188.146.113.39'),
('2019-01-01 20:43:15', '52.53.201.78'),
('2019-01-02 21:27:24', '188.146.107.184'),
('2019-01-02 22:43:53', '188.146.107.184'),
('2019-01-02 23:33:31', '188.146.107.184'),
('2019-01-02 23:48:53', '188.146.107.184'),
('2019-01-03 10:34:05', '89.229.64.83'),
('2019-01-03 13:15:21', '54.188.91.36'),
('2019-01-03 18:55:53', '188.146.108.170'),
('2019-01-04 04:28:42', '52.53.201.78'),
('2019-01-04 19:53:19', '188.146.106.247'),
('2019-01-04 21:35:23', '188.146.106.247'),
('2019-01-04 23:00:52', '188.146.106.247'),
('2019-01-05 00:02:26', '188.146.106.247'),
('2019-01-05 18:39:45', '89.229.64.83'),
('2019-01-05 18:39:46', '89.229.64.83'),
('2019-01-05 18:39:46', '89.229.64.83');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `weapon`
--

CREATE TABLE `weapon` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `weapon`
--

INSERT INTO `weapon` (`ID`, `name`, `price`, `attack`, `thumbnail`) VALUES
(1, 'melee', 0, 1, 'assets/weapons/weapons_melee.png'),
(2, 'Fork', 10, 5, 'assets/weapons/weapons_fork.png'),
(3, 'Basic Sword', 50, 10, 'assets/weapons/weapons_basicsword.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `weapon2`
--

CREATE TABLE `weapon2` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `weapon2`
--

INSERT INTO `weapon2` (`ID`, `name`, `price`, `attack`, `thumbnail`) VALUES
(1, 'melee', 0, 1, 'assets/weapons/weapons_melee.png'),
(2, 'Fork', 10, 5, 'assets/weapons/weapons_fork.png'),
(3, 'Basic Sword', 50, 10, 'assets/weapons/weapons_basicsword.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `weapon3`
--

CREATE TABLE `weapon3` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `weapon3`
--

INSERT INTO `weapon3` (`ID`, `name`, `price`, `attack`, `thumbnail`) VALUES
(1, 'melee', 0, 1, 'assets/weapons/weapons_melee.png'),
(2, 'Fork', 10, 5, 'assets/weapons/weapons_fork.png'),
(3, 'Basic Sword', 50, 10, 'assets/weapons/weapons_basicsword.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `weapon4`
--

CREATE TABLE `weapon4` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `weapon4`
--

INSERT INTO `weapon4` (`ID`, `name`, `price`, `attack`, `thumbnail`) VALUES
(1, 'melee', 0, 1, 'assets/weapons/weapons_melee.png'),
(2, 'Fork', 10, 5, 'assets/weapons/weapons_fork.png'),
(3, 'Basic Sword', 50, 10, 'assets/weapons/weapons_basicsword.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `weapon5`
--

CREATE TABLE `weapon5` (
  `ID` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `thumbnail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Zrzut danych tabeli `weapon5`
--

INSERT INTO `weapon5` (`ID`, `name`, `price`, `attack`, `thumbnail`) VALUES
(1, 'melee', 0, 1, 'assets/weapons/weapons_melee.png'),
(2, 'Fork', 10, 5, 'assets/weapons/weapons_fork.png'),
(3, 'Basic Sword', 50, 10, 'assets/weapons/weapons_basicsword.png');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `boots`
--
ALTER TABLE `boots`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gloves`
--
ALTER TABLE `gloves`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `helmet`
--
ALTER TABLE `helmet`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pants`
--
ALTER TABLE `pants`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `perk1`
--
ALTER TABLE `perk1`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `perk2`
--
ALTER TABLE `perk2`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `perk3`
--
ALTER TABLE `perk3`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `torso`
--
ALTER TABLE `torso`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `uczniowie`
--
ALTER TABLE `uczniowie`
  ADD PRIMARY KEY (`uczen_ID`),
  ADD UNIQUE KEY `uczen_ID` (`uczen_ID`),
  ADD KEY `uczen_ID_2` (`uczen_ID`);

--
-- Indexes for table `weapon`
--
ALTER TABLE `weapon`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `weapon2`
--
ALTER TABLE `weapon2`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `weapon3`
--
ALTER TABLE `weapon3`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `weapon4`
--
ALTER TABLE `weapon4`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `weapon5`
--
ALTER TABLE `weapon5`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `base`
--
ALTER TABLE `base`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `boots`
--
ALTER TABLE `boots`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `gloves`
--
ALTER TABLE `gloves`
  MODIFY `ID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `helmet`
--
ALTER TABLE `helmet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `oceny`
--
ALTER TABLE `oceny`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `pants`
--
ALTER TABLE `pants`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `perk1`
--
ALTER TABLE `perk1`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `perk2`
--
ALTER TABLE `perk2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `perk3`
--
ALTER TABLE `perk3`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `torso`
--
ALTER TABLE `torso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `uczniowie`
--
ALTER TABLE `uczniowie`
  MODIFY `uczen_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `weapon`
--
ALTER TABLE `weapon`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `weapon2`
--
ALTER TABLE `weapon2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `weapon3`
--
ALTER TABLE `weapon3`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `weapon4`
--
ALTER TABLE `weapon4`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `weapon5`
--
ALTER TABLE `weapon5`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
