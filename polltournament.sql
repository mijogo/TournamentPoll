-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-01-2013 a las 22:25:07
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `polltournament`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User` varchar(30) COLLATE utf8_bin NOT NULL,
  `Pass` varchar(30) COLLATE utf8_bin NOT NULL,
  `Mail` varchar(50) COLLATE utf8_bin NOT NULL,
  `Authpass` varchar(30) COLLATE utf8_bin NOT NULL,
  `Nivel` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batalla`
--

CREATE TABLE IF NOT EXISTS `batalla` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `Ronda` varchar(15) COLLATE utf8_bin NOT NULL,
  `Grupo` varchar(15) COLLATE utf8_bin NOT NULL,
  `Torneo` int(11) NOT NULL,
  `Activa` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ip`
--

CREATE TABLE IF NOT EXISTS `ip` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `IP` varchar(20) COLLATE utf8_bin NOT NULL,
  `Tiempo` int(11) NOT NULL,
  `Usada` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdDependencia` int(11) NOT NULL,
  `Titulo` varchar(25) COLLATE utf8_bin NOT NULL,
  `Descripcion` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`Id`, `IdDependencia`, `Titulo`, `Descripcion`) VALUES
(1, -1, 'Home', 'Aqui va la informacion principal del torneo'),
(3, -1, 'Informacion', 'La informacion necesaria ira aca'),
(4, -1, 'Zona de Votacion', ''),
(5, 3, 'Manifiesto', ''),
(6, 3, 'Calendario', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelea`
--

CREATE TABLE IF NOT EXISTS `pelea` (
  `IdPersonaje` int(11) NOT NULL,
  `IdBatalla` int(11) NOT NULL,
  `Votos` int(11) NOT NULL,
  PRIMARY KEY (`IdPersonaje`,`IdBatalla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personaje`
--

CREATE TABLE IF NOT EXISTS `personaje` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) COLLATE utf8_bin NOT NULL,
  `Serie` varchar(40) COLLATE utf8_bin NOT NULL,
  `Imagen` varchar(30) COLLATE utf8_bin NOT NULL,
  `Inscripcion` int(11) NOT NULL,
  `Eliminado` int(11) NOT NULL,
  `Grupo` varchar(15) COLLATE utf8_bin NOT NULL,
  `Ronda` varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Accion` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Hecho` int(11) NOT NULL,
  `Target` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo`
--

CREATE TABLE IF NOT EXISTS `torneo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ano` int(11) NOT NULL,
  `Version` varchar(15) COLLATE utf8_bin NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_bin NOT NULL,
  `Status` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voto`
--

CREATE TABLE IF NOT EXISTS `voto` (
  `Id` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `IdBatalla` int(11) NOT NULL,
  `IdPersonaje` int(11) NOT NULL,
  `IP` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
