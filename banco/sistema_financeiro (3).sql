-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19-Jan-2018 às 19:36
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Extraindo dados da tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `usuario`, `ip`, `ultima_acao`, `token`) VALUES
(70, 'admin', '127.0.0.1', '2018-01-18 18:20:59', '5a5f4a5c3d08d'),
(73, 'admin', '127.0.0.1', '2018-01-19 15:02:53', '5a61e5d1670c6'),
(72, 'admin', '127.0.0.1', '2018-01-19 16:35:00', '5a61dca512e77'),
(71, 'admin', '127.0.0.1', '2018-01-19 09:53:57', '5a61cf8d17bec');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `tb_admin.usuario`
--

INSERT INTO `tb_admin.usuario` (`id`, `usuario`, `nome`, `senha`, `permissao`, `ativo`, `img`) VALUES
(1, 'admin', 'Raphael de Jesus Bonifacio', 'admin', 2, 1, '59c16d3a5e557.jpg'),
(7, 'batman', 'Bruce Wayne', '123', 1, 1, '59c2fc2f9b899.jpg'),
(5, 'comun', 'Comunista', 'comun', 1, 1, '59c2f01d77265.jpg'),
(9, 'teste', 'teste', 'teste', 1, 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.entradas`
--

CREATE TABLE IF NOT EXISTS `tb_fin.entradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `parametro` int(11) NOT NULL,
  `sub_parametro` int(11) NOT NULL,
  `data` date NOT NULL,
  `quantidade` int(11) NOT NULL,
  `desconto` float NOT NULL,
  `valor` float NOT NULL,
  `total` float NOT NULL,
  `pdv` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `tb_fin.entradas`
--

INSERT INTO `tb_fin.entradas` (`id`, `item`, `parametro`, `sub_parametro`, `data`, `quantidade`, `desconto`, `valor`, `total`, `pdv`, `usuario`) VALUES
(17, 3, 1, 2, '2018-01-19', 80, 2, 0.5, 38, 1, 1),
(14, 1, 1, 2, '2018-01-18', 25, 0.15, 0.15, 3.6, 1, 1),
(15, 2, 1, 2, '2018-01-18', 100, 2, 1, 98, 1, 1),
(16, 1, 1, 2, '2018-01-18', 15, 0, 0.15, 2.25, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.itens`
--

CREATE TABLE IF NOT EXISTS `tb_fin.itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `subParametro` int(11) NOT NULL,
  `valor` float NOT NULL,
  `pdv` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_fin.itens`
--

INSERT INTO `tb_fin.itens` (`id`, `descricao`, `subParametro`, `valor`, `pdv`, `ativo`) VALUES
(1, 'Xerox', 2, 0.15, 1, 1),
(2, 'Impressão', 2, 1, 1, 1),
(3, 'Impressão colorida', 2, 0.5, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.parametro`
--

CREATE TABLE IF NOT EXISTS `tb_fin.parametro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(250) NOT NULL,
  `ativo` int(11) NOT NULL,
  `pdv` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tb_fin.parametro`
--

INSERT INTO `tb_fin.parametro` (`id`, `descricao`, `ativo`, `pdv`) VALUES
(1, 'Serviços', 1, 1),
(3, 'Produtos', 1, 1),
(4, 'teste', 1, 1),
(5, 'teste2', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.pdv`
--

CREATE TABLE IF NOT EXISTS `tb_fin.pdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_fin.pdv`
--

INSERT INTO `tb_fin.pdv` (`id`, `nome`, `ativo`) VALUES
(1, 'Banca do seu zé', 1),
(2, 'Biscoitaria Biscoito', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.saidas`
--

CREATE TABLE IF NOT EXISTS `tb_fin.saidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `parametro` int(11) NOT NULL,
  `sub_parametro` int(11) NOT NULL,
  `data` date NOT NULL,
  `quantidade` int(11) NOT NULL,
  `desconto` float NOT NULL,
  `valor` float NOT NULL,
  `total` float NOT NULL,
  `pdv` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `tb_fin.saidas`
--

INSERT INTO `tb_fin.saidas` (`id`, `item`, `parametro`, `sub_parametro`, `data`, `quantidade`, `desconto`, `valor`, `total`, `pdv`, `usuario`) VALUES
(16, 2, 1, 2, '2018-01-18', 45, 0, 1, 45, 1, 1),
(17, 1, 1, 2, '2018-01-19', 122, 1, 0.15, 17.3, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.sub-parametro`
--

CREATE TABLE IF NOT EXISTS `tb_fin.sub-parametro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `parametro` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  `pdv` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_fin.sub-parametro`
--

INSERT INTO `tb_fin.sub-parametro` (`id`, `descricao`, `parametro`, `ativo`, `pdv`) VALUES
(1, 'teste', 4, 1, 1),
(2, 'Serviços', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.usuario-pdv`
--

CREATE TABLE IF NOT EXISTS `tb_fin.usuario-pdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `pdv` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_fin.usuario-pdv`
--

INSERT INTO `tb_fin.usuario-pdv` (`id`, `usuario`, `pdv`, `ativo`) VALUES
(1, 1, 1, 1),
(2, 5, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
