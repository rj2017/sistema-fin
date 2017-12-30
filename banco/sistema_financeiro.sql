-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Out-2017 às 23:55
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=140 ;

--
-- Extraindo dados da tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `usuario`, `ip`, `ultima_acao`, `token`) VALUES
(139, 'edima', '127.0.0.1', '2017-10-08 18:47:54', '59da9cec3c946'),
(138, 'admin', '127.0.0.1', '2017-10-08 18:47:15', '59da9cc9c1297'),
(137, 'admin', '127.0.0.1', '2017-10-08 18:46:38', '59da9cab7ab97'),
(136, 'admin', '127.0.0.1', '2017-10-08 18:45:59', '59da886df2f25');

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
(1, 'admin', 'Raphael de Jesus Bonifácio', 'admin', 2, 1, '59da6b4171281.jpg'),
(7, 'batman', 'Bruce Wayne', '123', 1, 1, '59c2fc2f9b899.jpg'),
(5, 'comun', 'Comunista', 'comun', 1, 1, '59c2f01d77265.jpg'),
(9, 'edima', 'Edima Piedade de Jesus Forte Batista', 'edima', 1, 1, '59da9c724638c.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.entradas`
--

CREATE TABLE IF NOT EXISTS `tb_fin.entradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `valor` float NOT NULL,
  `pdv` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `tb_fin.entradas`
--

INSERT INTO `tb_fin.entradas` (`id`, `descricao`, `data`, `valor`, `pdv`, `usuario`) VALUES
(9, 'doces', '2017-10-04', 55.65, 1, 1),
(8, 'jornal', '2017-10-04', 35.41, 1, 1),
(7, 'revista', '2017-10-04', 64.85, 1, 5),
(10, 'Helicoptero', '2017-10-08', 20000, 2, 7),
(11, 'bolças', '2017-10-08', 38120300, 2, 7);

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
  `data` date NOT NULL,
  `valor` float NOT NULL,
  `pdv` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_fin.saidas`
--

INSERT INTO `tb_fin.saidas` (`id`, `descricao`, `data`, `valor`, `pdv`, `usuario`) VALUES
(2, 'luz', '2017-10-04', 75.98, 1, 5),
(3, 'finanças mensais', '2017-10-08', 2000000, 2, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fin.usuario-pdv`
--

CREATE TABLE IF NOT EXISTS `tb_fin.usuario-pdv` (
  `usuario` int(11) NOT NULL,
  `pdv` int(11) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_fin.usuario-pdv`
--

INSERT INTO `tb_fin.usuario-pdv` (`usuario`, `pdv`, `ativo`) VALUES
(1, 1, 1),
(5, 1, 1),
(7, 2, 1),
(9, 3, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
