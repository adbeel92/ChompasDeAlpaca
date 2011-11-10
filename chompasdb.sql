-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-11-2011 a las 18:00:22
-- Versión del servidor: 5.1.37
-- Versión de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `chompasdb`
--
CREATE DATABASE `chompasdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chompasdb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chompas`
--

CREATE TABLE IF NOT EXISTS `chompas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumo` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `stock_min` int(10) NOT NULL,
  `stock_actual` int(11) NOT NULL,
  `unidades_pedido` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_insumo` (`id_insumo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `chompas`
--

INSERT INTO `chompas` (`id`, `id_insumo`, `nombre`, `precio`, `stock_min`, `stock_actual`, `unidades_pedido`) VALUES
(1, 1, 'office', '100', 100, 100, 200),
(2, 2, 'mid season', '120', 80, 80, 100),
(3, 1, 'holmes', '120', 80, 80, 100),
(4, 3, 'gigardo', '100', 120, 120, 180),
(5, 1, 'anton', '110', 100, 100, 150),
(6, 3, 'l''blanc', '100', 150, 150, 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE IF NOT EXISTS `insumos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `nombre`) VALUES
(1, 'classic'),
(2, 'modern'),
(3, 'elegant');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumo` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_insumo` (`id_insumo`),
  KEY `id_admin` (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_insumo`, `id_admin`, `fecha`) VALUES
(1, 1, 1, '2011-11-09 17:27:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `nombre`, `apellido`, `rol`) VALUES
(1, 'admin01', '18c6d818ae35a3e8279b5330eda01498', 'Gabriel', 'Pinedo', 'administrador'),
(2, 'system', '54b53072540eeeb8f8e9343e71f28176', 'Jeffrey', 'Arenas', 'administrador');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `chompas`
--
ALTER TABLE `chompas`
  ADD CONSTRAINT `chompas_ibfk_1` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
