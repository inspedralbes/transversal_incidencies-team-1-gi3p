-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Temps de generació: 19-04-2023 a les 08:31:38
-- Versió del servidor: 10.6.12-MariaDB-1:10.6.12+maria~ubu2004
-- Versió de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `a22arnfergil_gi3pgrup1`
--
DROP DATABASE IF EXISTS `incidencies`;
CREATE DATABASE `incidencies` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `incidencies`;

-- --------------------------------------------------------

--
-- Estructura de la taula `ACTUACIO`
--

CREATE TABLE `ACTUACIO` (
  `idAct` int(10) NOT NULL,
  `descripcio` varchar(1000) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `temps` int(10) DEFAULT NULL,
  `visible` int(1) DEFAULT NULL,
  `incidencia` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Bolcament de dades per a la taula `ACTUACIO`
--

INSERT INTO `ACTUACIO` (`idAct`, `descripcio`, `data`, `temps`, `visible`, `incidencia`) VALUES
(1, 'hem mirat que es el que fallava', '2023-03-13 12:48:17', 15, 0, 1),
(2, 'La peça de recanvi ha sigut demanada', '2022-12-19 12:07:41', 10, 1, 1),
(3, 'Ha arribat però no es pot instal·lar', '2022-12-19 12:08:30', 25, 0, 1),
(4, 'no hem trobat el problema', '2023-03-15 09:08:08', 45, 1, 2),
(5, 'hem trobat el problema', '2022-12-19 12:09:35', 16, 1, 2),
(6, 'intentat solucionar, no aconseguit', '2022-12-19 12:10:10', 23, 0, 2),
(7, 'Reiniciat el sistema, solucionat', '2022-12-19 12:10:45', 13, 1, 3),
(12, 'Això és una actuació sipi', '2023-03-13 12:20:41', 12, 0, 1),
(28, '123456789101112131415', '2023-03-20 13:12:23', 13, 1, 13),
(29, '123456789101112131415', '2023-03-20 13:17:16', 33, 1, 13),
(30, 'cosasdfgdfgdfgdfgfddfgdfgfdg', '2023-03-22 11:47:56', 23, 0, 13),
(33, 'dsgfddfdsfdsfdsfdsfdsfdsfdsfds', '2023-03-23 09:40:32', 34, 1, 35),
(34, 'fdsfdsfdfgfgdfgdfgdfgdfgdfgdfgdfgdfg', '2023-03-23 09:43:26', 15, 1, 43),
(35, '3433534534555555555555555', '2023-03-23 10:55:17', 20, 1, 66),
(36, 'trdfygxsdcfvgbfrdtftfyffyufytfytg', '2023-03-30 11:19:56', 20, 1, 67),
(37, 'ygsudfihgaosdjfg0`98ajgioajdgsfójapoifjgaoipjsdfgpàjs', '2023-04-03 19:52:37', 12, 1, 70),
(38, 'hsafgjiajsgjasanklknv', '2023-04-09 13:02:35', 12, 1, 76);

-- --------------------------------------------------------

--
-- Estructura de suport per a vistes `consumDepartaments`
-- (mireu a sota per a la visualització real)
--
CREATE TABLE `consumDepartaments` (
`nom` varchar(100)
,`temps` decimal(32,0)
,`numInc` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de la taula `DEPARTAMENT`
--

CREATE TABLE `DEPARTAMENT` (
  `idDept` varchar(5) NOT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Bolcament de dades per a la taula `DEPARTAMENT`
--

INSERT INTO `DEPARTAMENT` (`idDept`, `nom`) VALUES
('CAST', 'Castellà'),
('CAT', 'Català'),
('EF', 'Educació Física'),
('MAT', 'Matemàtiques');

-- --------------------------------------------------------

--
-- Estructura de la taula `INCIDENCIA`
--

CREATE TABLE `INCIDENCIA` (
  `idInc` int(10) NOT NULL,
  `descripcio` varchar(1000) DEFAULT NULL,
  `dataIni` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `aula` varchar(20) DEFAULT NULL,
  `tecnic` int(10) DEFAULT NULL,
  `tipologia` int(10) DEFAULT NULL,
  `dataFi` date DEFAULT NULL,
  `prioritat` int(1) DEFAULT NULL,
  `professor` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Bolcament de dades per a la taula `INCIDENCIA`
--

INSERT INTO `INCIDENCIA` (`idInc`, `descripcio`, `dataIni`, `aula`, `tecnic`, `tipologia`, `dataFi`, `prioritat`, `professor`) VALUES
(1, 'un ordinador no va', '2023-03-15 16:16:48', 'MAT', 3, 2, NULL, 3, NULL),
(2, 'La electricitat no funciona a classe', '2023-04-03 19:51:44', 'CAST', 2, 1, NULL, 2, NULL),
(3, 'No apareix la carpeta Dades', '2023-03-15 09:40:24', 'EF', 2, 3, '2023-03-15', 3, NULL),
(5, 'asdfasdfasdf', '2023-03-20 11:39:35', 'CAST', 1, 3, '2023-03-20', 3, NULL),
(9, 'patata', '2023-03-15 11:31:17', 'CAST', 3, 1, NULL, 4, NULL),
(11, 'HOLA', '2023-03-30 11:17:57', 'CAST', 2, 3, NULL, 4, NULL),
(13, 'PROJECTOR HA DEIXAT DE FUNCIONAR', '2023-03-30 09:52:47', 'CAT', 1, 2, '2023-03-30', 3, NULL),
(33, 'aa', '2023-03-27 09:49:31', 'CAST', 2, 1, NULL, 2, NULL),
(35, 'Una descripcio', '2023-03-20 09:51:26', 'CAT', 2, 3, NULL, 3, NULL),
(36, 'asdfasdfasdf', '2023-03-31 08:12:48', 'CAT', 3, 1, NULL, 1, NULL),
(37, 'patata2', '2023-03-23 09:36:27', 'EF', 1, 3, '2023-03-23', 2, NULL),
(43, 'ijtimkydj', '2023-03-20 12:16:51', 'CAST', 2, 1, NULL, 4, NULL),
(45, 'dsfdsf', '2023-03-31 08:12:25', 'CAST', 1, 3, NULL, 1, NULL),
(66, 'descripcio', '2023-03-23 10:56:00', 'CAST', 1, 2, '2023-03-23', 4, NULL),
(67, 'jcyjfy', '2023-03-30 11:20:07', 'CAT', 1, 3, '2023-03-30', 3, NULL),
(68, 'prueba', '2023-03-31 08:12:16', 'EF', 1, 2, NULL, 2, NULL),
(70, 'hola', '2023-04-12 08:24:49', 'CAST', 1, 1, '2023-04-12', 4, NULL),
(72, 'hhhh', '2023-03-31 08:12:56', 'EF', 2, 2, NULL, 2, NULL),
(73, 'asdfasdf', '2023-03-31 08:48:57', 'CAT', 3, 2, NULL, 1, NULL),
(74, 'no va el raton en el aula 5 uwu\r\n', '2023-03-30 11:17:17', 'CAT', NULL, NULL, NULL, NULL, NULL),
(75, 'aafsdfasdfas', '2023-04-13 10:07:41', 'EF', NULL, 1, NULL, NULL, NULL),
(76, 'skdfghkjsdhfghspodjgsdijg', '2023-04-09 12:59:35', 'EF', 1, 3, NULL, 3, NULL),
(78, 'Descripcion muy ranomdfdsfklsnd', '2023-04-13 10:06:59', 'EF', 1, 2, NULL, NULL, NULL),
(79, 'fffddes', '2023-04-13 10:28:56', 'MAT', NULL, NULL, NULL, NULL, NULL),
(89, 'dgdfgdfg', '2023-04-17 11:11:16', 'EF', NULL, NULL, NULL, NULL, NULL),
(90, 'sdfdsf', '2023-04-17 11:12:38', 'EF', NULL, NULL, NULL, NULL, NULL),
(91, 'gghrthgr', '2023-04-17 11:12:56', 'CAT', NULL, NULL, NULL, NULL, NULL);

--
-- Disparadors `INCIDENCIA`
--
DELIMITER $$
CREATE TRIGGER `insertar_incidencies_log` AFTER INSERT ON `INCIDENCIA` FOR EACH ROW BEGIN
    INSERT INTO INCIDENCIA_LOG(INCIDENCIA_LOG.id, INCIDENCIA_LOG.descripcio, INCIDENCIA_LOG.departament, INCIDENCIA_LOG.data)
    VALUES(
        NEW.idInc,
        NEW.descripcio,
        NEW.aula,
        NEW.dataIni
        );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de la taula `INCIDENCIA_LOG`
--

CREATE TABLE `INCIDENCIA_LOG` (
  `id` int(11) NOT NULL,
  `descripcio` varchar(1000) DEFAULT NULL,
  `departament` varchar(20) DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Bolcament de dades per a la taula `INCIDENCIA_LOG`
--

INSERT INTO `INCIDENCIA_LOG` (`id`, `descripcio`, `departament`, `data`) VALUES
(79, 'fffddes', 'MAT', '2023-04-13'),
(89, 'dgdfgdfg', 'EF', '2023-04-17'),
(90, 'sdfdsf', 'EF', '2023-04-17'),
(91, 'gghrthgr', 'CAT', '2023-04-17');

-- --------------------------------------------------------

--
-- Estructura de suport per a vistes `informeTecnics`
-- (mireu a sota per a la visualització real)
--
CREATE TABLE `informeTecnics` (
`nom` varchar(100)
,`descripcio` varchar(1000)
,`prioritat` int(1)
,`DATA` varchar(5)
,`temps` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura de suport per a vistes `numIncidenciesPerDepartament`
-- (mireu a sota per a la visualització real)
--
CREATE TABLE `numIncidenciesPerDepartament` (
`idDept` varchar(5)
,`nom` varchar(100)
,`incidenciasTotals` bigint(21)
,`incidenciasObertes` bigint(21)
,`incidenciasTancades` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de la taula `TECNIC`
--

CREATE TABLE `TECNIC` (
  `idTecn` int(10) NOT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Bolcament de dades per a la taula `TECNIC`
--

INSERT INTO `TECNIC` (`idTecn`, `nom`) VALUES
(1, 'Arnau'),
(2, 'Loris'),
(3, 'Pedro');

-- --------------------------------------------------------

--
-- Estructura de la taula `TIPOLOGIA`
--

CREATE TABLE `TIPOLOGIA` (
  `idTipo` int(10) NOT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Bolcament de dades per a la taula `TIPOLOGIA`
--

INSERT INTO `TIPOLOGIA` (`idTipo`, `nom`) VALUES
(1, 'Hardware'),
(2, 'Elèctric'),
(3, 'Software');

-- --------------------------------------------------------

--
-- Estructura de la taula `USUARI`
--

CREATE TABLE `USUARI` (
  `idUsu` int(11) NOT NULL,
  `usuari` varchar(50) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `permisos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Bolcament de dades per a la taula `USUARI`
--

INSERT INTO `USUARI` (`idUsu`, `usuari`, `contrasenya`, `permisos`) VALUES
(1, 'Ermengol', 'b15d8b02164361f5e8293541397fd240', 1),
(2, 'Arnau', 'b7d80e33db90cc4386cc8830316131d1', 2),
(3, 'Loris', '37d6ce4c19737d06ded9cc2a30c5990e', 2),
(4, 'Pedro', '38e2b2e31c0fce9537f735dda9fdf10a', 2),
(5, 'santipu', '40f150948e8c740cf4ff1db4b9335a42', 3);

-- --------------------------------------------------------

--
-- Estructura per a vista `consumDepartaments`
--
DROP TABLE IF EXISTS `consumDepartaments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`a22arnfergil_gi3pgrup1`@`localhost` SQL SECURITY DEFINER VIEW `consumDepartaments`  AS SELECT `DEPARTAMENT`.`nom` AS `nom`, sum(`ACTUACIO`.`temps`) AS `temps`, count(`INCIDENCIA`.`idInc`) AS `numInc` FROM ((`INCIDENCIA` join `ACTUACIO` on(`INCIDENCIA`.`idInc` = `ACTUACIO`.`incidencia`)) join `DEPARTAMENT` on(`INCIDENCIA`.`aula` = `DEPARTAMENT`.`idDept`)) GROUP BY `INCIDENCIA`.`aula` ;

-- --------------------------------------------------------

--
-- Estructura per a vista `informeTecnics`
--
DROP TABLE IF EXISTS `informeTecnics`;

CREATE ALGORITHM=UNDEFINED DEFINER=`a22arnfergil_gi3pgrup1`@`localhost` SQL SECURITY DEFINER VIEW `informeTecnics`  AS   (select `TECNIC`.`nom` AS `nom`,`INCIDENCIA`.`descripcio` AS `descripcio`,`INCIDENCIA`.`prioritat` AS `prioritat`,concat(dayofmonth(`INCIDENCIA`.`dataIni`),'/',month(`INCIDENCIA`.`dataIni`)) AS `DATA`,sum(`ACTUACIO`.`temps`) AS `temps` from ((`INCIDENCIA` join `TECNIC` on(`INCIDENCIA`.`tecnic` = `TECNIC`.`idTecn`)) left join `ACTUACIO` on(`INCIDENCIA`.`idInc` = `ACTUACIO`.`incidencia`)) where `INCIDENCIA`.`dataFi` is null group by `INCIDENCIA`.`idInc` order by `TECNIC`.`nom`,`INCIDENCIA`.`prioritat` desc)  ;

-- --------------------------------------------------------

--
-- Estructura per a vista `numIncidenciesPerDepartament`
--
DROP TABLE IF EXISTS `numIncidenciesPerDepartament`;

CREATE ALGORITHM=UNDEFINED DEFINER=`a22arnfergil_gi3pgrup1`@`localhost` SQL SECURITY DEFINER VIEW `numIncidenciesPerDepartament`  AS   (select `DEPARTAMENT`.`idDept` AS `idDept`,`DEPARTAMENT`.`nom` AS `nom`,(select count(0) from `INCIDENCIA` where `INCIDENCIA`.`aula` = `DEPARTAMENT`.`idDept`) AS `incidenciasTotals`,(select count(0) from `INCIDENCIA` where `INCIDENCIA`.`aula` = `DEPARTAMENT`.`idDept` and `INCIDENCIA`.`dataFi` is null) AS `incidenciasObertes`,(select count(0) from `INCIDENCIA` where `INCIDENCIA`.`aula` = `DEPARTAMENT`.`idDept` and `INCIDENCIA`.`dataFi` is not null) AS `incidenciasTancades` from `DEPARTAMENT`)  ;

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `ACTUACIO`
--
ALTER TABLE `ACTUACIO`
  ADD PRIMARY KEY (`idAct`),
  ADD KEY `incidencia` (`incidencia`);

--
-- Índexs per a la taula `DEPARTAMENT`
--
ALTER TABLE `DEPARTAMENT`
  ADD PRIMARY KEY (`idDept`);

--
-- Índexs per a la taula `INCIDENCIA`
--
ALTER TABLE `INCIDENCIA`
  ADD PRIMARY KEY (`idInc`),
  ADD KEY `departament` (`aula`),
  ADD KEY `tecnic` (`tecnic`),
  ADD KEY `tipologia` (`tipologia`),
  ADD KEY `professor` (`professor`);

--
-- Índexs per a la taula `INCIDENCIA_LOG`
--
ALTER TABLE `INCIDENCIA_LOG`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departament` (`departament`);

--
-- Índexs per a la taula `TECNIC`
--
ALTER TABLE `TECNIC`
  ADD PRIMARY KEY (`idTecn`);

--
-- Índexs per a la taula `TIPOLOGIA`
--
ALTER TABLE `TIPOLOGIA`
  ADD PRIMARY KEY (`idTipo`);

--
-- Índexs per a la taula `USUARI`
--
ALTER TABLE `USUARI`
  ADD PRIMARY KEY (`idUsu`),
  ADD UNIQUE KEY `usuari` (`usuari`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `ACTUACIO`
--
ALTER TABLE `ACTUACIO`
  MODIFY `idAct` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT per la taula `INCIDENCIA`
--
ALTER TABLE `INCIDENCIA`
  MODIFY `idInc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT per la taula `TECNIC`
--
ALTER TABLE `TECNIC`
  MODIFY `idTecn` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la taula `TIPOLOGIA`
--
ALTER TABLE `TIPOLOGIA`
  MODIFY `idTipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la taula `USUARI`
--
ALTER TABLE `USUARI`
  MODIFY `idUsu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `ACTUACIO`
--
ALTER TABLE `ACTUACIO`
  ADD CONSTRAINT `ACTUACIO_ibfk_1` FOREIGN KEY (`incidencia`) REFERENCES `INCIDENCIA` (`idInc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per a la taula `INCIDENCIA`
--
ALTER TABLE `INCIDENCIA`
  ADD CONSTRAINT `INCIDENCIA_ibfk_1` FOREIGN KEY (`aula`) REFERENCES `DEPARTAMENT` (`idDept`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `INCIDENCIA_ibfk_2` FOREIGN KEY (`tecnic`) REFERENCES `TECNIC` (`idTecn`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `INCIDENCIA_ibfk_3` FOREIGN KEY (`tipologia`) REFERENCES `TIPOLOGIA` (`idTipo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `INCIDENCIA_ibfk_4` FOREIGN KEY (`professor`) REFERENCES `USUARI` (`idUsu`);

--
-- Restriccions per a la taula `INCIDENCIA_LOG`
--
ALTER TABLE `INCIDENCIA_LOG`
  ADD CONSTRAINT `INCIDENCIA_LOG_ibfk_1` FOREIGN KEY (`departament`) REFERENCES `DEPARTAMENT` (`idDept`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
