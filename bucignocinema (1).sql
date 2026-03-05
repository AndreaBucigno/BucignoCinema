-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 04, 2026 alle 23:03
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bucignocinema`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `casaproduttrice`
--

CREATE TABLE `casaproduttrice` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sede` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `casaproduttrice`
--

INSERT INTO `casaproduttrice` (`id`, `nome`, `sede`) VALUES
(1, 'Warner Bros', 'Los Angeles, USA'),
(2, 'Universal Pictures', 'Universal City, USA'),
(3, 'Medusa Film', 'Roma, Italia'),
(4, '20th Century Studios', 'Los Angeles, USA'),
(5, 'Lucasfilm', 'San Francisco, USA'),
(6, 'e', 'e'),
(7, 'e', 'e');

-- --------------------------------------------------------

--
-- Struttura della tabella `cinema`
--

CREATE TABLE `cinema` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `indirizzo` varchar(150) DEFAULT NULL,
  `citta` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `cinema`
--

INSERT INTO `cinema` (`id`, `nome`, `indirizzo`, `citta`) VALUES
(1, 'BucignoCinema Centro', 'Via Roma 14', 'Perugia'),
(2, 'BucignoCinema Nord', 'Via Adriatica 88', 'Perugia'),
(3, 'aNDREA', 'VIA TEST', 'TEST'),
(4, 'e', 'e', 'e');

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `data_nascita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cognome`, `data_nascita`) VALUES
(1, 'Marco', 'Rossi', '1990-04-15'),
(2, 'Giulia', 'Bianchi', '1995-08-22'),
(3, 'Luca', 'Verdi', '1988-12-01'),
(4, 'Anna', 'Neri', '2000-03-10'),
(5, 'Paolo', 'Gialli', '1975-07-19'),
(6, 'Sara', 'Blu', '1993-11-05'),
(7, 'Matteo', 'Ferrari', '1998-02-28'),
(8, 'Chiara', 'Romano', '1985-06-14');

-- --------------------------------------------------------

--
-- Struttura della tabella `parolachiave`
--

CREATE TABLE `parolachiave` (
  `id` int(11) NOT NULL,
  `parola` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `parolachiave`
--

INSERT INTO `parolachiave` (`id`, `parola`) VALUES
(1, 'guerra'),
(2, 'storia'),
(3, 'commedia'),
(4, 'sogno'),
(5, 'vendetta'),
(6, 'futuro'),
(7, 'amore'),
(8, 'italia'),
(9, 'hollywood'),
(10, 'bomba');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `id` int(11) NOT NULL,
  `data_operazione` datetime DEFAULT NULL,
  `numero_biglietti` int(11) NOT NULL,
  `costo` decimal(6,2) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_proiezione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prenotazione`
--

INSERT INTO `prenotazione` (`id`, `data_operazione`, `numero_biglietti`, `costo`, `id_cliente`, `id_proiezione`) VALUES
(1, '2026-03-01 10:00:00', 2, 16.00, 1, 1),
(2, '2026-03-01 11:30:00', 1, 8.00, 2, 2),
(3, '2026-03-02 09:00:00', 4, 32.00, 3, 3),
(4, '2026-03-02 14:00:00', 2, 16.00, 4, 4),
(5, '2026-03-03 16:00:00', 3, 24.00, 5, 5),
(6, '2026-03-03 17:00:00', 1, 8.00, 6, 6),
(7, '2026-03-04 10:00:00', 2, 16.00, 7, 7),
(8, '2026-03-04 12:00:00', 5, 40.00, 8, 8),
(9, '2026-03-04 15:00:00', 2, 16.00, 1, 9),
(10, '2026-03-04 18:00:00', 3, 24.00, 3, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `proiezione`
--

CREATE TABLE `proiezione` (
  `id` int(11) NOT NULL,
  `data_ora` datetime NOT NULL,
  `id_spettacolo` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `proiezione`
--

INSERT INTO `proiezione` (`id`, `data_ora`, `id_spettacolo`, `id_sala`) VALUES
(1, '2026-03-05 15:00:00', 1, 1),
(2, '2026-03-05 18:00:00', 2, 2),
(3, '2026-03-05 21:00:00', 3, 3),
(4, '2026-03-06 15:30:00', 4, 4),
(5, '2026-03-06 18:30:00', 5, 5),
(6, '2026-03-06 21:00:00', 6, 1),
(7, '2026-03-07 16:00:00', 7, 2),
(8, '2026-03-07 20:00:00', 8, 3),
(9, '2026-03-08 15:00:00', 1, 4),
(10, '2026-03-08 20:30:00', 3, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `regista`
--

CREATE TABLE `regista` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `regista`
--

INSERT INTO `regista` (`id`, `nome`, `cognome`, `data_nascita`) VALUES
(1, 'Christopher', 'Nolan', '1970-07-30'),
(2, 'Quentin', 'Tarantino', '1963-03-27'),
(3, 'Greta', 'Gerwig', '1983-08-04'),
(4, 'Steven', 'Spielberg', '1946-12-18'),
(5, 'Paolo', 'Sorrentino', '1970-05-31');

-- --------------------------------------------------------

--
-- Struttura della tabella `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `capienza` int(11) NOT NULL,
  `id_cinema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `sala`
--

INSERT INTO `sala` (`id`, `nome`, `capienza`, `id_cinema`) VALUES
(1, 'Sala 1', 120, 1),
(2, 'Sala 2', 80, 1),
(3, 'Sala IMAX', 200, 1),
(4, 'Sala A', 100, 2),
(5, 'Sala B', 60, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `spettacolo`
--

CREATE TABLE `spettacolo` (
  `id` int(11) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `trama` text DEFAULT NULL,
  `id_tematica` int(11) DEFAULT NULL,
  `id_regista` int(11) DEFAULT NULL,
  `id_casa_produttrice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `spettacolo`
--

INSERT INTO `spettacolo` (`id`, `titolo`, `trama`, `id_tematica`, `id_regista`, `id_casa_produttrice`) VALUES
(1, 'Oppenheimer', 'La storia del padre della bomba atomica e del Progetto Manhattan.', 3, 1, 1),
(2, 'C era una volta a Hollywood', 'Los Angeles 1969: un attore western e il suo stuntman cercano gloria.', 2, 2, 2),
(3, 'Barbie', 'Barbie lascia Barbieland e scopre il mondo reale.', 2, 3, 1),
(4, 'Schindler s List', 'Un industriale tedesco salva oltre mille ebrei durante l Olocausto.', 3, 4, 2),
(5, 'La Grande Bellezza', 'Un giornalista romano riflette sulla sua vita tra feste e solitudine.', 3, 5, 3),
(6, 'Tenet', 'Un agente segreto impara a manipolare il flusso del tempo per salvare il mondo.', 6, 1, 4),
(7, 'Inception', 'Un ladro che ruba segreti attraverso i sogni viene incaricato di piantare un idea.', 6, 1, 1),
(8, 'Django Unchained', 'Uno schiavo liberato cerca di salvare sua moglie con l aiuto di un cacciatore di taglie.', 1, 2, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `spettacoloparola`
--

CREATE TABLE `spettacoloparola` (
  `id_spettacolo` int(11) NOT NULL,
  `id_parola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `spettacoloparola`
--

INSERT INTO `spettacoloparola` (`id_spettacolo`, `id_parola`) VALUES
(1, 1),
(1, 2),
(1, 10),
(2, 3),
(2, 9),
(3, 3),
(3, 7),
(4, 1),
(4, 2),
(5, 7),
(5, 8),
(6, 4),
(6, 6),
(7, 4),
(7, 6),
(8, 1),
(8, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `tematica`
--

CREATE TABLE `tematica` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tematica`
--

INSERT INTO `tematica` (`id`, `nome`, `descrizione`) VALUES
(1, 'Azione', 'Film ricchi di adrenalina, inseguimenti e combattimenti'),
(2, 'Commedia', 'Film leggeri pensati per far ridere il pubblico'),
(3, 'Dramma', 'Storie intense con forte impatto emotivo'),
(4, 'Horror', 'Film pensati per spaventare e creare tensione'),
(5, 'Romantico', 'Storie d amore e sentimenti'),
(6, 'Fantascienza', 'Ambientazioni futuristiche e tecnologia avanzata');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ruolo` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `nome`, `email`, `password`, `ruolo`, `created_at`) VALUES
(1, 'Admin', 'bucignoandrea@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin', '2026-03-04 22:59:35');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `casaproduttrice`
--
ALTER TABLE `casaproduttrice`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `parolachiave`
--
ALTER TABLE `parolachiave`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_proiezione` (`id_proiezione`);

--
-- Indici per le tabelle `proiezione`
--
ALTER TABLE `proiezione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_spettacolo` (`id_spettacolo`),
  ADD KEY `id_sala` (`id_sala`);

--
-- Indici per le tabelle `regista`
--
ALTER TABLE `regista`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cinema` (`id_cinema`);

--
-- Indici per le tabelle `spettacolo`
--
ALTER TABLE `spettacolo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tematica` (`id_tematica`),
  ADD KEY `id_regista` (`id_regista`),
  ADD KEY `id_casa_produttrice` (`id_casa_produttrice`);

--
-- Indici per le tabelle `spettacoloparola`
--
ALTER TABLE `spettacoloparola`
  ADD PRIMARY KEY (`id_spettacolo`,`id_parola`),
  ADD KEY `id_parola` (`id_parola`);

--
-- Indici per le tabelle `tematica`
--
ALTER TABLE `tematica`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `casaproduttrice`
--
ALTER TABLE `casaproduttrice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `cinema`
--
ALTER TABLE `cinema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `parolachiave`
--
ALTER TABLE `parolachiave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `proiezione`
--
ALTER TABLE `proiezione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `regista`
--
ALTER TABLE `regista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `spettacolo`
--
ALTER TABLE `spettacolo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `tematica`
--
ALTER TABLE `tematica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `prenotazione_ibfk_2` FOREIGN KEY (`id_proiezione`) REFERENCES `proiezione` (`id`);

--
-- Limiti per la tabella `proiezione`
--
ALTER TABLE `proiezione`
  ADD CONSTRAINT `proiezione_ibfk_1` FOREIGN KEY (`id_spettacolo`) REFERENCES `spettacolo` (`id`),
  ADD CONSTRAINT `proiezione_ibfk_2` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id`);

--
-- Limiti per la tabella `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `sala_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id`);

--
-- Limiti per la tabella `spettacolo`
--
ALTER TABLE `spettacolo`
  ADD CONSTRAINT `spettacolo_ibfk_1` FOREIGN KEY (`id_tematica`) REFERENCES `tematica` (`id`),
  ADD CONSTRAINT `spettacolo_ibfk_2` FOREIGN KEY (`id_regista`) REFERENCES `regista` (`id`),
  ADD CONSTRAINT `spettacolo_ibfk_3` FOREIGN KEY (`id_casa_produttrice`) REFERENCES `casaproduttrice` (`id`);

--
-- Limiti per la tabella `spettacoloparola`
--
ALTER TABLE `spettacoloparola`
  ADD CONSTRAINT `spettacoloparola_ibfk_1` FOREIGN KEY (`id_spettacolo`) REFERENCES `spettacolo` (`id`),
  ADD CONSTRAINT `spettacoloparola_ibfk_2` FOREIGN KEY (`id_parola`) REFERENCES `parolachiave` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
