-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30-Set-2017 às 00:26
-- Versão do servidor: 5.6.15-log
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistema_financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.online`
--

CREATE TABLE IF NOT EXISTS `tb_admin.online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Extraindo dados da tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `usuario`, `ip`, `ultima_acao`, `token`) VALUES
(28, 'comun', '127.0.0.1', '2017-09-29 18:31:24', '59ceb9b2f29c3'),
(29, 'admin', '127.0.0.1', '2017-09-29 19:22:39', '59cebbb237a9a'),
(27, 'admin', '127.0.0.1', '2017-09-29 18:22:51', '59ce91fd58f08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.usuario`
--

CREATE TABLE IF NOT EXISTS `tb_admin.usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `permissao` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tb_admin.usuario`
--

INSERT INTO `tb_admin.usuario` (`id`, `usuario`, `nome`, `senha`, `permissao`, `ativo`, `img`) VALUES
(1, 'admin', 'Raphael de Jesus Bonifacio', 'admin', 2, 1, '59c16d3a5e557.jpg'),
(7, 'batman', 'Bruce Wayne', '123', 1, 1, '59c2fc2f9b899.jpg'),
(5, 'comun', 'Comunista', 'comun', 1, 1, '59c2f01d77265.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.entradas`
--

CREATE TABLE IF NOT EXISTS `tb_fin.entradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `pdv` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.pdv`
--

CREATE TABLE IF NOT EXISTS `tb_fin.pdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_fin.pdv`
--

INSERT INTO `tb_fin.pdv` (`id`, `nome`, `ativo`) VALUES
(1, 'Teste', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.usuario-pdv`
--

CREATE TABLE IF NOT EXISTS `tb_fin.usuario-pdv` (
  `usuario` int(11) NOT NULL,
  `pdv` int(11) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
