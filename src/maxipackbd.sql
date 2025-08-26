-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/06/2025 às 23:02
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `maxipackbd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradores`
--

DROP TABLE IF EXISTS `administradores`;
CREATE TABLE IF NOT EXISTS `administradores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `dataNascimento` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `administradores`
--

INSERT INTO `administradores` (`id`, `nome`, `email`, `senha`, `cpf`, `dataNascimento`, `created_at`) VALUES
(14, 'Teste Cadastro', 'cadastro@email.com', '$2y$10$uQxgYPC8rI9HEESiK05WBua3tGILzZ4N0TA32/BYQ33sGTRIcBgn6', '12345678888', '2011-11-11', '2025-06-03 23:00:22'),
(7, 'Maria', 'maria@email.com', '$2y$10$F3yOnsujATSadx4aQPC6t.SkEAnYQ3.XjSvKuZ3WwK37Gdf63Dl1e', '11111111111', '2011-11-11', '2025-05-31 14:33:09'),
(13, 'Teste Válido', 'testevalido@email.com', '$2y$10$OXsSyQIhpsVYGaEzjVwgBOS/lMpR4Z8nZH28IHr6pIyMTbqLQ8Aqy', '99999999999', '2001-01-01', '2025-06-03 22:58:30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `dataNascimento` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`, `cpf`, `dataNascimento`, `created_at`) VALUES
(9, 'Teste Cadastro', 'teste@email.com', '$2y$10$h1BBwPxOImgEiWGbrNJatu2tmcWJHAwCFe2rVAQWahIUhPwo2pjYu', '12345678909', '2000-01-01', '2025-06-03 22:31:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produto` varchar(255) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `descricao` text,
  `qtdEstoque` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `produto`, `valor`, `descricao`, `qtdEstoque`, `created_at`) VALUES
(1, 'Caixa de papelão N5', 8.90, 'Caixa de papelão 15x25x7cm 1 unidade', 25, '2025-05-27 00:11:28'),
(4, 'Forma de Bolo BP-56', 3.20, 'Forma de bolo modelo 56 Bipack', 30, '2025-05-31 20:30:33'),
(7, 'Fita Adesiva 45x100m', 7.00, 'Fita adesiva cristal 45x100m rolo', 15, '2025-05-31 20:40:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
