-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15-Jan-2018 às 00:35
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=152 ;

--
-- Extraindo dados da tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `usuario`, `ip`, `ultima_acao`, `token`) VALUES
(144, 'comun', '127.0.0.1', '2018-01-07 00:09:46', '5a50dc669ebfe'),
(143, 'comun', '127.0.0.1', '2017-12-31 13:04:32', '5a48fc7b72ec9'),
(142, 'comun', '127.0.0.1', '2017-12-31 13:04:20', '5a48fc63cd62a'),
(141, 'comun', '127.0.0.1', '2017-12-31 13:03:38', '5a48fc28d7c4d'),
(140, 'admin', '127.0.0.1', '2017-12-30 20:52:39', '5a47f03a436db'),
(145, 'comun', '127.0.0.1', '2018-01-07 00:10:34', '5a516fba65d8c'),
(146, 'comun', '127.0.0.1', '2018-01-07 21:29:22', '5a529fbf4accf'),
(147, 'comun', '127.0.0.1', '2018-01-07 21:18:08', '5a52a128d0810'),
(148, 'comun', '127.0.0.1', '2018-01-14 16:04:46', '5a5b8f66be5d5'),
(149, 'comun', '127.0.0.1', '2018-01-14 15:13:29', '5a5b8faeb3c8c'),
(150, 'comun', '127.0.0.1', '2018-01-14 16:31:24', '5a5b9c35827db'),
(151, 'comun', '127.0.0.1', '2018-01-14 21:33:03', '5a5bc156b1706');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `tb_admin.usuario`
--

INSERT INTO `tb_admin.usuario` (`id`, `usuario`, `nome`, `senha`, `permissao`, `ativo`, `img`) VALUES
(1, 'admin', 'Raphael de Jesus Bonifácio', 'admin', 2, 1, '59da6b4171281.jpg'),
(7, 'batman', 'Bruce Wayne', '123', 1, 1, '59c2fc2f9b899.jpg'),
(5, 'comun', 'Comunista', 'comun', 2, 1, '59c2f01d77265.jpg'),
(9, 'edima', 'Edima Piedade de Jesus Forte Batista', 'edima', 1, 1, '59da9c724638c.jpg'),
(10, 'Joao', 'joao', 'joao', 1, 1, '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.itens`
--

CREATE TABLE IF NOT EXISTS `tb_fin.itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `parametro` int(11) NOT NULL,
  `sub_parametro` int(11) NOT NULL,
  `valor` float NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_fin.pdv`
--

INSERT INTO `tb_fin.pdv` (`id`, `nome`, `ativo`) VALUES
(1, 'Banca do seu zé', 1),
(2, 'Biscoitaria Biscoito', 1),
(3, 'Café Marita', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.saidas`
--

CREATE TABLE IF NOT EXISTS `tb_fin.saidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `parametro` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor` float NOT NULL,
  `pdv` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_fin.saidas`
--

INSERT INTO `tb_fin.saidas` (`id`, `descricao`, `parametro`, `data`, `valor`, `pdv`, `usuario`) VALUES
(2, 'luz', 1, '2017-10-04', 75.98, 1, 5),
(3, 'finanças mensais', 2, '2017-10-08', 2000000, 2, 7),
(4, 'Pão', 3, '2017-12-30', 12, 1, 1);

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
(2, 'Serviços.2', 1, 1, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tb_fin.usuario-pdv`
--

INSERT INTO `tb_fin.usuario-pdv` (`id`, `usuario`, `pdv`, `ativo`) VALUES
(1, 1, 1, 1),
(2, 5, 1, 1),
(3, 7, 2, 1),
(4, 9, 3, 1),
(5, 1, 2, 1),
(6, 1, 3, 1),
(7, 10, 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
