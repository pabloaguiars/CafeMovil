-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-03-2019 a las 07:13:35
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cafemovildb`
--
CREATE DATABASE IF NOT EXISTS `cafemovildb` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `cafemovildb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

DROP TABLE IF EXISTS `escuela`;
CREATE TABLE IF NOT EXISTS `escuela` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_bin NOT NULL,
  `direccion` varchar(60) COLLATE utf8_bin NOT NULL,
  `telefono` varchar(10) COLLATE utf8_bin NOT NULL,
  `correo` varchar(255) COLLATE utf8_bin NOT NULL,
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `telefono` (`telefono`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_escolar` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_bin NOT NULL,
  `apellido_paterno` varchar(40) COLLATE utf8_bin NOT NULL,
  `apellido_materno` varchar(40) COLLATE utf8_bin NOT NULL,
  `curp` varchar(18) COLLATE utf8_bin NOT NULL,
  `correo` varchar(255) COLLATE utf8_bin NOT NULL,
  `telefono` varchar(10) COLLATE utf8_bin NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estatus` int(1) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `id_escuela` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_escolar` (`id_escolar`),
  UNIQUE KEY `curp` (`curp`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `telefono` (`telefono`),
  FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario`(`id`),
  FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
--
-- Estructura de tabla para la tabla `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_bin NOT NULL,
  `precio_unitario` double NOT NULL,
  `descripcion` tinytext COLLATE utf8_bin NOT NULL,
  `url_imagen` text COLLATE utf8_bin NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_vendedor`) REFERENCES `usuario`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `fecha_hora_pedido` datetime NOT NULL,
  `fecha_hora_entrega` datetime NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_cliente`) REFERENCES `usuario`(`id`),
  FOREIGN KEY (`id_vendedor`) REFERENCES `usuario`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

DROP TABLE IF EXISTS `orden`;
CREATE TABLE IF NOT EXISTS `orden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_pedido`) REFERENCES `pedido`(`id`),
  FOREIGN KEY (`id_menu`) REFERENCES `menu`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
