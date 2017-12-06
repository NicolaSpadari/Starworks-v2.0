-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 06, 2017 alle 11:30
-- Versione del server: 10.1.25-MariaDB
-- Versione PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `starworks`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `events`
--

CREATE TABLE `events` (
  `id` int(5) NOT NULL,
  `code` varchar(10) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`id`, `code`, `cover`, `title`, `date`, `time`) VALUES
(1, '9lvpbxew', 'Images/Events/1.jpg', 'Test title', '2017-10-11', '02:17:00'),
(3, 'oaf66amd', 'Images/Events/2.jpg', 'BASSJAM', '2017-11-28', '21:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8_bin NOT NULL,
  `answer` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'How do I get to Starworks?', 'Plane, train or car. It\'s your decision.'),
(2, 'Is there plenty of parking?', 'We have over 1000+ parking spaces available dotted around the venue.'),
(3, 'Do you provide wi-fi access?', 'Free visitor wi-fi across Starworks, no code required.'),
(4, 'Where do I book my tickets?', 'This changes from event to event. Head to our whats on page for the latest booking information.'),
(5, 'Where do I buy and collect my tickets?\r\n', 'Our box office is open 5 days a week between 10-6.'),
(6, 'Do you offer medical assistance?', 'We always have trained 1st aid staff available in event of accident or incident. Just ask the nearest member of staff for assistance.'),
(7, 'Wheres the nearest cash machine?', 'We have a portable cash machine onsite.'),
(8, 'Do you offer a cloakroom?', 'We offer cloak room facilities.'),
(9, 'Do you have a lost propery area?', 'If you lose something at Starworks head to our security office and well do our best to help. Alternatively,  call the main office on 01902 871444.'),
(10, 'Are there many places to eat and drink?', 'Depending on the event there will always be something on offer. Check out what\'s on for more details.'),
(11, 'Can I smoke at the Starworks?', 'Smoking is not allowed anywhere inside the venue aside from the designated smoking areas. This also applies to e-cigarettes and vaping.'),
(12, 'Is the Starworks accessible for disabled visitors?', 'We have worked very hard to make our venue fully accessible to all our guests.');

-- --------------------------------------------------------

--
-- Struttura della tabella `gallery`
--

CREATE TABLE `gallery` (
  `id` int(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `cover`, `date`) VALUES
(1, 'test1', 'Images/Albums/1.jpg', '2017-10-01'),
(2, 'test2', 'Images/Albums/2.jpg', '2017-10-01');

-- --------------------------------------------------------

--
-- Struttura della tabella `info`
--

CREATE TABLE `info` (
  `id` int(5) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `info`
--

INSERT INTO `info` (`id`, `address`, `phone`, `mail`) VALUES
(1, 'Frederick Street, Wolverhampton WV2', '07968 352428', 'ryan@starworkswarehouse.co.uk');

-- --------------------------------------------------------

--
-- Struttura della tabella `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'adminstarworks', '73cc8792cfc2b7a058ce55e5a2d981025a55b8ae749991cd287fa3560d33859f7cfe4980523562b03a0876a6468b2c41c43bdfecbb1a4c4ed23492c5d5b8d8d8');

-- --------------------------------------------------------

--
-- Struttura della tabella `photo`
--

CREATE TABLE `photo` (
  `id` int(5) NOT NULL,
  `albumId` int(5) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `photo`
--

INSERT INTO `photo` (`id`, `albumId`, `link`) VALUES
(1, 1, 'Images/Photos/1/1.jpg'),
(2, 1, 'Images/Photos/1/2.jpg'),
(3, 2, 'Images/Photos/2/1.jpg'),
(4, 2, 'Images/Photos/2/2.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_bin NOT NULL,
  `caption` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `slideshow`
--

INSERT INTO `slideshow` (`id`, `img`, `caption`) VALUES
(1, 'Images/Slideshow/1.jpg', 'Concert gigs'),
(2, 'Images/Slideshow/2.jpg', 'The third oldest car factory in the world'),
(3, 'Images/Slideshow/3.jpg', 'Concert events'),
(4, 'Images/Slideshow/4.jpg', 'Music events'),
(5, 'Images/Slideshow/5.jpg', 'Global artists');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indici per le tabelle `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albumId` (`albumId`);

--
-- Indici per le tabelle `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `events`
--
ALTER TABLE `events`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT per la tabella `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `info`
--
ALTER TABLE `info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`albumId`) REFERENCES `gallery` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
