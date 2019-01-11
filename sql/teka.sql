-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2019 at 12:01 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teka`
--

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id`, `nome`) VALUES
(1, 'Caio'),
(2, 'Jader'),
(3, 'Caio'),
(4, 'Jader'),
(5, 'Caio'),
(6, 'Jader'),
(7, 'Caio'),
(8, 'Jader'),
(9, 'Caio'),
(10, 'Jader'),
(11, 'Caio'),
(12, 'Jader'),
(13, 'Caio'),
(14, 'Jader'),
(15, 'Caio'),
(16, 'Jader'),
(17, 'Caio'),
(18, 'Jader'),
(19, 'Caio'),
(20, 'Jader'),
(21, 'Caio'),
(22, 'Jader'),
(23, 'Caio'),
(24, 'Jader'),
(25, 'Caio'),
(26, 'Jader');

-- --------------------------------------------------------

--
-- Table structure for table `filtros`
--

CREATE TABLE `filtros` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `imagem` varchar(300) NOT NULL DEFAULT 'avatar.png',
  `password` char(40) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `telefone`, `imagem`, `password`, `group_id`, `created`, `modified`, `ultimo_login`, `ativo`) VALUES
(58, 'caiolima@brainme.com.br', '', '', '', '', 'avatar.png', '520bcdfa3c1cd55799c522660dffc81baead7049', 0, '2018-10-31 02:11:02', '2018-10-31 02:11:02', '0000-00-00 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filtros`
--
ALTER TABLE `filtros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `filtros`
--
ALTER TABLE `filtros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
