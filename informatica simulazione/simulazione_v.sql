-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 24, 2024 alle 07:28
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simulazione`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin_cred`
--

CREATE TABLE `admin_cred` (
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `admin_cred`
--

INSERT INTO `admin_cred` (`email`, `password`) VALUES
('ciao@gmail', 'a');

-- --------------------------------------------------------

--
-- Struttura della tabella `bicicletta`
--

CREATE TABLE `bicicletta` (
  `codiceRFID` int(11) NOT NULL,
  `kmpercorsi` int(11) NOT NULL,
  `codiceGPS` int(11) NOT NULL,
  `longitudine` float NOT NULL,
  `latitudine` float NOT NULL,
  `manutenzione` enum('s','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `bicicletta`
--

INSERT INTO `bicicletta` (`codiceRFID`, `kmpercorsi`, `codiceGPS`, `longitudine`, `latitudine`, `manutenzione`) VALUES
(110, 0, 33, 0, 0, 's'),
(111, 299, 23, 2.4, 1.2, 'n');

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `codiceFiscale` varchar(18) NOT NULL,
  `dataNascita` date NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `numero` varchar(16) NOT NULL,
  `CVV` int(11) NOT NULL,
  `dataScadenza` date NOT NULL,
  `citta` varchar(32) NOT NULL,
  `via` varchar(32) NOT NULL,
  `numeroCivico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`ID`, `email`, `password`, `codiceFiscale`, `dataNascita`, `nome`, `cognome`, `numero`, `CVV`, `dataScadenza`, `citta`, `via`, `numeroCivico`) VALUES
(1, 'user@a', 'aa', 'aaa', '2024-05-18', 'Tommaso', 'Mardegan', '111', 1110, '2024-05-11', 'barlassina', 'dei cigni', 32),
(2, 'utente', 'password', 'MRDTMS05S30D286U', '2024-05-17', 'Tommaso', 'Mardegan', '2147483647', 772, '2024-06-02', 'barlassina', 'dei prati', 32),
(3, 'utente', 'password', 'MRDTMS05S30D286U', '2024-05-25', 'Tommaso', 'Mardegan', '2147483647', 772, '2024-05-28', 'barlassina', 'dei prati', 32),
(4, 'utente', 'password', 'MRDTMS05S30D286U', '2024-05-11', 'Tommaso', 'Mardegan', '2882827272112213', 772, '2024-05-12', 'barlassina', 'dei prati', 32);

-- --------------------------------------------------------

--
-- Struttura della tabella `operazione`
--

CREATE TABLE `operazione` (
  `id` int(11) NOT NULL,
  `distanzaPercorsa` int(11) NOT NULL,
  `tariffa` float NOT NULL,
  `tipo` varchar(32) NOT NULL,
  `codiceBicicletta` int(11) NOT NULL,
  `codiceStazione` int(11) NOT NULL,
  `codiceUtente` int(11) NOT NULL,
  `dataOra` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `operazione`
--

INSERT INTO `operazione` (`id`, `distanzaPercorsa`, `tariffa`, `tipo`, `codiceBicicletta`, `codiceStazione`, `codiceUtente`, `dataOra`) VALUES
(1, 0, 0, 'noleggia', 110, 10, 1, '2024-05-23 22:29:21'),
(2, 0, 0.0208333, 'consegna', 110, 10, 1, '2024-05-23 22:29:46'),
(3, 0, 0, 'noleggia', 111, 10, 1, '2024-05-23 22:31:05'),
(4, 0, 0.00583333, 'consegna', 111, 10, 1, '2024-05-23 22:31:12'),
(5, 0, 0, 'noleggia', 111, 10, 1, '2024-05-23 22:32:22'),
(6, 0, 0.00583333, 'consegna', 111, 10, 1, '2024-05-23 22:32:29'),
(7, 1000, 0, 'noleggia', 110, 10, 1, '2024-05-23 22:53:13'),
(8, 0, 0.00333333, 'consegna', 110, 10, 1, '2024-05-23 22:32:44');

-- --------------------------------------------------------

--
-- Struttura della tabella `stazione`
--

CREATE TABLE `stazione` (
  `codice` int(11) NOT NULL,
  `numeroSlot` int(11) NOT NULL,
  `citta` varchar(32) NOT NULL,
  `via` varchar(32) NOT NULL,
  `numeroCivico` int(11) NOT NULL,
  `provincia` varchar(32) NOT NULL,
  `regione` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `stazione`
--

INSERT INTO `stazione` (`codice`, `numeroSlot`, `citta`, `via`, `numeroCivico`, `provincia`, `regione`) VALUES
(10, 60, 'barlassina', 'dei prati', 42, 'monza brianza', 'lombardia'),
(11, 50, 'barlassina', 'dei prati', 10, 'monza brianza', 'lombardia');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `bicicletta`
--
ALTER TABLE `bicicletta`
  ADD PRIMARY KEY (`codiceRFID`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `operazione`
--
ALTER TABLE `operazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codiceUtente` (`codiceUtente`),
  ADD KEY `codiceBicicletta` (`codiceBicicletta`),
  ADD KEY `codiceStazione` (`codiceStazione`);

--
-- Indici per le tabelle `stazione`
--
ALTER TABLE `stazione`
  ADD PRIMARY KEY (`codice`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  MODIFY `codiceRFID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `operazione`
--
ALTER TABLE `operazione`
  ADD CONSTRAINT `operazione_ibfk_1` FOREIGN KEY (`codiceStazione`) REFERENCES `stazione` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operazione_ibfk_2` FOREIGN KEY (`codiceBicicletta`) REFERENCES `bicicletta` (`codiceRFID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operazione_ibfk_3` FOREIGN KEY (`codiceUtente`) REFERENCES `cliente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
