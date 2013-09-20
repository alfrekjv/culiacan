-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2013 at 12:06 PM
-- Server version: 5.6.12
-- PHP Version: 5.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `culiacan`
--
CREATE DATABASE IF NOT EXISTS `culiacan` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `culiacan`;

-- --------------------------------------------------------

--
-- Table structure for table `Lugar`
--

CREATE TABLE IF NOT EXISTS `Lugar` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'nombre			',
  `nombre` varchar(45) DEFAULT NULL,
  `calle` varchar(45) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `colonia` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `tipo` enum('centro de acopio','albergue','otro') DEFAULT NULL,
  `observaciones` text,
  `status` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Necesidad`
--

CREATE TABLE IF NOT EXISTS `Necesidad` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lugar_id` int(11) unsigned NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` text,
  `tipo` enum('alimento','objeto','otro') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`lugar_id`),
  KEY `fk_Necesidades_Lugar_idx` (`lugar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Noticia`
--

CREATE TABLE IF NOT EXISTS `Noticia` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `autor` int(11) unsigned NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `contenido` text,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`autor`),
  KEY `fk_Noticias_User1_idx` (`autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Persona`
--

CREATE TABLE IF NOT EXISTS `Persona` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `edad` int(3) DEFAULT NULL,
  `observaciones` text,
  `status` enum('desaparecida','encontrada','en albergue') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_level_id` int(10) unsigned NOT NULL DEFAULT '1',
  `provider` varchar(45) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `provider_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `display_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `photo_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_level_id` (`user_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_activation_token`
--

CREATE TABLE IF NOT EXISTS `user_activation_token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `used` tinyint(1) DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `date_used` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_forgot_token`
--

CREATE TABLE IF NOT EXISTS `user_forgot_token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `used` tinyint(1) DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `date_used` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `title`) VALUES
(1, 'Admin'),
(2, 'Developer'),
(3, 'Usuario');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Necesidad`
--
ALTER TABLE `Necesidad`
  ADD CONSTRAINT `fk_Necesidades_Lugar` FOREIGN KEY (`lugar_id`) REFERENCES `Lugar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Noticia`
--
ALTER TABLE `Noticia`
  ADD CONSTRAINT `fk_Noticias_User1` FOREIGN KEY (`autor`) REFERENCES `User` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
