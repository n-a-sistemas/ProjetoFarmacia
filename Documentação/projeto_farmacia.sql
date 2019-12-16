-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Dez-2019 às 17:34
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_farmacia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `peso`
--

CREATE TABLE `peso` (
  `id_peso` int(11) NOT NULL,
  `id_nome` int(11) NOT NULL,
  `peso` decimal(10,0) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_nome` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `senha` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `endereco` varchar(300) NOT NULL,
  `cidade_estado` varchar(200) NOT NULL,
  `cep` varchar(100) NOT NULL,
  `foto_perfil` varchar(200) DEFAULT NULL,
  `foto_qrcode` varchar(200) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `cpf` varchar(12) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `telefone_emergencia` varchar(50) NOT NULL,
  `altura` decimal(10,0) NOT NULL,
  `adm` tinyint(1) NOT NULL,
  `tipo_sanguineo` varchar(2) NOT NULL,
  `alergia_doencas` varchar(500) NOT NULL,
  `plano_saude` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pressao`
--

CREATE TABLE `pressao` (
  `id_pressao` int(11) NOT NULL,
  `id_nome` int(11) NOT NULL,
  `pressao` varchar(20) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `peso`
--
ALTER TABLE `peso`
  ADD PRIMARY KEY (`id_peso`);

--
-- Índices para tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_nome`);

--
-- Índices para tabela `pressao`
--
ALTER TABLE `pressao`
  ADD PRIMARY KEY (`id_pressao`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `peso`
--
ALTER TABLE `peso`
  MODIFY `id_peso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_nome` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pressao`
--
ALTER TABLE `pressao`
  MODIFY `id_pressao` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
