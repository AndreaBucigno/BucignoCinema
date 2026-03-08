-- phpMyAdmin SQL Dump
-- Database: `bucignocinema`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

-- --------------------------------------------------------
-- Tabella `casaproduttrice`
-- --------------------------------------------------------
CREATE TABLE `casaproduttrice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `sede` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `casaproduttrice` (`id`, `nome`, `sede`) VALUES
(1, 'Warner Bros', 'Los Angeles, USA'),
(2, 'Universal Pictures', 'Universal City, USA'),
(3, 'Medusa Film', 'Roma, Italia'),
(4, '20th Century Studios', 'Los Angeles, USA'),
(5, 'Lucasfilm', 'San Francisco, USA');

-- --------------------------------------------------------
-- Tabella `cinema`
-- --------------------------------------------------------
CREATE TABLE `cinema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `indirizzo` varchar(150) DEFAULT NULL,
  `citta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cinema` (`id`, `nome`, `indirizzo`, `citta`) VALUES
(1, 'BucignoCinema Centro', 'Via Roma 14', 'Perugia'),
(2, 'BucignoCinema Nord', 'Via Adriatica 88', 'Perugia');

-- --------------------------------------------------------
-- Tabella `parolachiave`
-- --------------------------------------------------------
CREATE TABLE `parolachiave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parola` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Tabella `utenti` (unione di utenti + cliente)
-- --------------------------------------------------------
CREATE TABLE `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ruolo` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `utenti` (`id`, `nome`, `cognome`, `data_nascita`, `email`, `password`, `ruolo`) VALUES
(1, 'Admin', NULL, NULL, 'bucignoandrea@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'Marco', 'Rossi', '1990-04-15', 'marco.rossi@cinema.it', MD5('Password123'), 'user'),
(3, 'Giulia', 'Bianchi', '1995-08-22', 'giulia.bianchi@cinema.it', MD5('Password123'), 'user'),
(4, 'Luca', 'Verdi', '1988-12-01', 'luca.verdi@cinema.it', MD5('Password123'), 'user'),
(5, 'Anna', 'Neri', '2000-03-10', 'anna.neri@cinema.it', MD5('Password123'), 'user'),
(6, 'Paolo', 'Gialli', '1975-07-19', 'paolo.gialli@cinema.it', MD5('Password123'), 'user'),
(7, 'Sara', 'Blu', '1993-11-05', 'sara.blu@cinema.it', MD5('Password123'), 'user'),
(8, 'Matteo', 'Ferrari', '1998-02-28', 'matteo.ferrari@cinema.it', MD5('Password123'), 'user'),
(9, 'Chiara', 'Romano', '1985-06-14', 'chiara.romano@cinema.it', MD5('Password123'), 'user');

-- --------------------------------------------------------
-- Tabella `regista`
-- --------------------------------------------------------
CREATE TABLE `regista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `regista` (`id`, `nome`, `cognome`, `data_nascita`) VALUES
(1, 'Christopher', 'Nolan', '1970-07-30'),
(2, 'Quentin', 'Tarantino', '1963-03-27'),
(3, 'Greta', 'Gerwig', '1983-08-04'),
(4, 'Steven', 'Spielberg', '1946-12-18'),
(5, 'Paolo', 'Sorrentino', '1970-05-31');

-- --------------------------------------------------------
-- Tabella `sala`
-- --------------------------------------------------------
CREATE TABLE `sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `capienza` int(11) NOT NULL,
  `id_cinema` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cinema` (`id_cinema`),
  CONSTRAINT `sala_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sala` (`id`, `nome`, `capienza`, `id_cinema`) VALUES
(1, 'Sala 1', 120, 1),
(2, 'Sala 2', 80, 1),
(3, 'Sala IMAX', 200, 1),
(4, 'Sala A', 100, 2),
(5, 'Sala B', 60, 2);

-- --------------------------------------------------------
-- Tabella `tematica`
-- --------------------------------------------------------
CREATE TABLE `tematica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tematica` (`id`, `nome`, `descrizione`) VALUES
(1, 'Azione', 'Film ricchi di adrenalina, inseguimenti e combattimenti'),
(2, 'Commedia', 'Film leggeri pensati per far ridere il pubblico'),
(3, 'Dramma', 'Storie intense con forte impatto emotivo'),
(4, 'Horror', 'Film pensati per spaventare e creare tensione'),
(5, 'Romantico', 'Storie d amore e sentimenti'),
(6, 'Fantascienza', 'Ambientazioni futuristiche e tecnologia avanzata');

-- --------------------------------------------------------
-- Tabella `spettacolo`
-- --------------------------------------------------------
CREATE TABLE `spettacolo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(100) NOT NULL,
  `trama` text DEFAULT NULL,
  `id_tematica` int(11) DEFAULT NULL,
  `id_regista` int(11) DEFAULT NULL,
  `id_casa_produttrice` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tematica` (`id_tematica`),
  KEY `id_regista` (`id_regista`),
  KEY `id_casa_produttrice` (`id_casa_produttrice`),
  CONSTRAINT `spettacolo_ibfk_1` FOREIGN KEY (`id_tematica`) REFERENCES `tematica` (`id`),
  CONSTRAINT `spettacolo_ibfk_2` FOREIGN KEY (`id_regista`) REFERENCES `regista` (`id`),
  CONSTRAINT `spettacolo_ibfk_3` FOREIGN KEY (`id_casa_produttrice`) REFERENCES `casaproduttrice` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Tabella `spettacoloparola`
-- --------------------------------------------------------
CREATE TABLE `spettacoloparola` (
  `id_spettacolo` int(11) NOT NULL,
  `id_parola` int(11) NOT NULL,
  PRIMARY KEY (`id_spettacolo`, `id_parola`),
  KEY `id_parola` (`id_parola`),
  CONSTRAINT `spettacoloparola_ibfk_1` FOREIGN KEY (`id_spettacolo`) REFERENCES `spettacolo` (`id`),
  CONSTRAINT `spettacoloparola_ibfk_2` FOREIGN KEY (`id_parola`) REFERENCES `parolachiave` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `spettacoloparola` (`id_spettacolo`, `id_parola`) VALUES
(1, 1),(1, 2),(1, 10),
(2, 3),(2, 9),
(3, 3),(3, 7),
(4, 1),(4, 2),
(5, 7),(5, 8),
(6, 4),(6, 6),
(7, 4),(7, 6),
(8, 1),(8, 5);

-- --------------------------------------------------------
-- Tabella `proiezione`
-- --------------------------------------------------------
CREATE TABLE `proiezione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_ora` datetime NOT NULL,
  `id_spettacolo` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_spettacolo` (`id_spettacolo`),
  KEY `id_sala` (`id_sala`),
  CONSTRAINT `proiezione_ibfk_1` FOREIGN KEY (`id_spettacolo`) REFERENCES `spettacolo` (`id`),
  CONSTRAINT `proiezione_ibfk_2` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Tabella `prenotazione`
-- --------------------------------------------------------
CREATE TABLE `prenotazione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_operazione` datetime DEFAULT NULL,
  `numero_biglietti` int(11) NOT NULL,
  `costo` decimal(6,2) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_proiezione` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_proiezione` (`id_proiezione`),
  CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `utenti` (`id`),
  CONSTRAINT `prenotazione_ibfk_2` FOREIGN KEY (`id_proiezione`) REFERENCES `proiezione` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `prenotazione` (`id`, `data_operazione`, `numero_biglietti`, `costo`, `id_cliente`, `id_proiezione`) VALUES
(1, '2026-03-01 10:00:00', 2, 16.00, 2, 1),
(2, '2026-03-01 11:30:00', 1, 8.00, 3, 2),
(3, '2026-03-02 09:00:00', 4, 32.00, 4, 3),
(4, '2026-03-02 14:00:00', 2, 16.00, 5, 4),
(5, '2026-03-03 16:00:00', 3, 24.00, 6, 5),
(6, '2026-03-03 17:00:00', 1, 8.00, 7, 6),
(7, '2026-03-04 10:00:00', 2, 16.00, 8, 7),
(8, '2026-03-04 12:00:00', 5, 40.00, 9, 8),
(9, '2026-03-04 15:00:00', 2, 16.00, 2, 9),
(10, '2026-03-04 18:00:00', 3, 24.00, 4, 10);

COMMIT;
