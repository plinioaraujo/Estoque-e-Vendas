-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Dez-2018 às 03:43
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--
CREATE DATABASE IF NOT EXISTS `inventory` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `inventory`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `descricao` text COLLATE utf8_bin NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `descricao`, `data_criacao`) VALUES
(1, 'Jardim e Piscina', '2018-11-07 17:48:30'),
(3, 'Lâmpadas e Acessórios', '2018-11-08 19:45:33'),
(6, 'Azulejos', '2018-11-08 19:45:46'),
(7, 'Blocos e Tijolos', '2018-11-08 19:45:51'),
(8, 'Eletroduto e Conexões', '2018-11-08 19:45:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` text COLLATE utf8_bin NOT NULL,
  `cpf` int(11) NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `telefone` text COLLATE utf8_bin NOT NULL,
  `celular` text COLLATE utf8_bin NOT NULL,
  `logradouro` text COLLATE utf8_bin NOT NULL,
  `data_nascimento` date NOT NULL,
  `compras` int(11) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `email`, `telefone`, `celular`, `logradouro`, `data_nascimento`, `compras`, `data_criacao`) VALUES
(1, 'plinio', 2147483647, 'plinioglad@gmail.com', '(21) 3124-5468', '(21) 98885-5456', 'Rua Mafra 47 apto 101', '1971-07-09', 0, '2018-11-27 08:46:35'),
(2, 'Carlos', 654687897, 'carlos@gmail.com', '(21) 4565-4565', '(21) 95456-4545', 'teste', '0000-00-00', 0, '2018-11-27 08:47:59'),
(3, 'teste', 345345, 'teste@teste.com', '(21)6546-5465', '(21)94545-4545', 'teste', '2018-01-01', 0, '2018-11-30 00:18:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `descricao` text COLLATE utf8_bin NOT NULL,
  `codigo` text COLLATE utf8_bin NOT NULL,
  `imagem` text COLLATE utf8_bin NOT NULL,
  `estoque` int(11) NOT NULL,
  `preco_compra` float NOT NULL,
  `preco_venda` float NOT NULL,
  `vendas` int(11) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `id_categoria`, `descricao`, `codigo`, `imagem`, `estoque`, `preco_compra`, `preco_venda`, `vendas`, `data_criacao`) VALUES
(1, 1, 'Aspiradora Industrial ', ' 101', 'view/img/produtos/101/105.png', 3, 100, 140, 0, '2018-12-04 17:52:54'),
(2, 1, 'Plato Flotante para Allanadora', '102', 'view/img/produtos/102/940.jpg', 3, 200, 280, 0, '2018-12-04 17:53:10'),
(3, 1, 'tetste', '103', 'view/img/produtos/103/466.jpg', 20, 15, 21, 0, '2018-11-30 21:18:05'),
(4, 3, 'lamparadas', '301', 'view/img/produtos/default/anonymous.png', 34, 54, 75.6, 0, '2018-12-02 01:51:05'),
(5, 6, 'adfdadfad', '601', 'view/img/produtos/default/anonymous.png', 34, 37, 51.8, 0, '2018-12-02 01:51:29'),
(6, 7, 'gfgsdfgfdsdfg', '701', 'view/img/produtos/default/anonymous.png', 456, 344, 481.6, 0, '2018-12-02 01:51:51'),
(7, 1, 'tretretre', '104', 'view/img/produtos/default/anonymous.png', 0, 434, 607.6, 0, '2018-12-02 02:26:18'),
(8, 1, 'ertedfgfgdfg', '105', 'view/img/produtos/default/anonymous.png', 34, 454, 635.6, 0, '2018-12-02 01:52:43'),
(9, 3, 'ytrytrytrytr', '302', 'view/img/produtos/default/anonymous.png', 345, 2343, 3280.2, 0, '2018-12-02 01:53:06'),
(10, 3, 'asdfdfdf', '303', 'view/img/produtos/default/anonymous.png', 76, 443, 620.2, 0, '2018-12-02 01:53:30'),
(11, 8, 'cano 34', '801', 'view/img/produtos/default/anonymous.png', 0, 34, 47.6, 0, '2018-12-04 01:05:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `login` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `senha` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `foto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `status` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `perfil`, `foto`, `status`, `ultimo_login`, `data_criacao`) VALUES
(1, 'Usuario Administrador', 'admin', '$2a$07$rasmuslerd$', 'Administrador', 'view/img/usuarios/admin/108.jpg', 1, '2018-12-03 19:21:18', '2018-12-03 21:21:18'),
(14, 'Julio de Albuquerque', 'julio', '$2a$07$rasmuslerd$', 'Vendedor', 'view/img/usuarios//243.jpg', 1, '2018-12-01 19:53:14', '2018-12-01 21:53:14'),
(21, 'joao', 'joao', '$2a$07$rasmuslerd$', 'Vendedor', 'view/img/usuarios/joao/327.jpg', 1, '2018-10-30 14:28:38', '2018-10-30 16:28:38'),
(22, 'carlos', 'carlos', '$2a$07$rasmuslerd$', 'Especial', '', 0, '0000-00-00 00:00:00', '2018-10-30 14:13:35'),
(23, 'jose', 'jose', '$2a$07$rasmuslerd$', 'Vendedor', '', 0, '0000-00-00 00:00:00', '2018-10-30 14:13:50'),
(24, 'Alberto', 'alberto', '$2a$07$rasmuslerd$', 'Especial', 'view/img/usuarios/alberto/841.jpg', 0, '0000-00-00 00:00:00', '2018-10-30 14:14:14'),
(25, 'Maria', 'maria', '$2a$07$rasmuslerd$', 'Vendedor', '', 0, '0000-00-00 00:00:00', '2018-10-30 14:14:46'),
(26, 'glaucio', 'glaucio', '$2a$07$rasmuslerd$', 'Vendedor', 'view/img/usuarios/glaucio/927.jpg', 0, '0000-00-00 00:00:00', '2018-10-30 14:15:15'),
(27, 'Francisco', 'chico', '$2a$07$rasmuslerd$', 'Vendedor', '', 0, '0000-00-00 00:00:00', '2018-10-30 14:15:46'),
(28, 'Albertino', 'alb', '$2a$07$rasmuslerd$', 'Vendedor', 'view/img/usuarios/alb/475.jpg', 0, '0000-00-00 00:00:00', '2018-11-06 19:49:44'),
(29, 'Eduardo', 'edu', '$2a$07$rasmuslerd$', 'Especial', '', 0, '0000-00-00 00:00:00', '2018-10-30 14:17:44'),
(30, 'Jair', 'jair', '$2a$07$rasmuslerd$', 'Vendedor', 'view/img/usuarios/jair/399.jpg', 1, '0000-00-00 00:00:00', '2018-10-30 16:33:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `produtos` text COLLATE utf8_bin NOT NULL,
  `juros` float NOT NULL,
  `valor` int(11) NOT NULL,
  `valor_total` int(11) NOT NULL,
  `metodo_pagamento` int(11) NOT NULL,
  `data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
