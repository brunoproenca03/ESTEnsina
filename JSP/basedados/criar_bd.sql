-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Jun-2024 às 23:07
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estensina`
--

CREATE DATABASE estEnsina;
USE estEnsina;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `duracao` int(11) NOT NULL,
  `inscritos` int(11) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`, `duracao`, `inscritos`, `capacidade`, `docente`) VALUES
(32, 'PHP', 60, 0, 25, 19),
(33, 'JSP', 20, 0, 25, 19),
(34, 'Java', 70, 0, 25, 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estadoinscricao`
--

CREATE TABLE `estadoinscricao` (
  `estadoInscricao` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estadoinscricao`
--

INSERT INTO `estadoinscricao` (`estadoInscricao`, `descricao`) VALUES
(1, 'Pendente'),
(2, 'Aceite'),
(3, 'Rejeitada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao`
--

CREATE TABLE `inscricao` (
  `aluno` int(11) NOT NULL,
  `curso` int(11) NOT NULL,
  `data_inscricao` date NOT NULL,
  `custo` decimal(10,2) NOT NULL,
  `estadoDaInscricao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoutilizador`
--

CREATE TABLE `tipoutilizador` (
  `id_tipo` int(11) NOT NULL,
  `tipoutilizador` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tipoutilizador`
--

INSERT INTO `tipoutilizador` (`id_tipo`, `tipoutilizador`) VALUES
(1, 'Administrador'),
(2, 'Docente'),
(3, 'Aluno'),
(4, 'Aluno nao Validado'),
(5, 'Visitante');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id_utilizador` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `data_nascimento` date NOT NULL,
  `pass` varchar(60) NOT NULL,
  `morada` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telemovel` int(11) NOT NULL,
  `tipo_utilizador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id_utilizador`, `nome`, `data_nascimento`, `pass`, `morada`, `email`, `telemovel`, `tipo_utilizador`) VALUES
(1, 'admin', '2000-02-20', '21232f297a57a5a743894a0e4a801fc3', 'Urbanização Quinta Dr. Beirão, Lote 30', 'admin@estensina.pt', 272558536, 1),
(18, 'aluno', '2004-01-08', 'ca0cd09a12abade3bf0777574d9f987f', 'Rua Humberto Delgado', 'aluno@estensina.pt', 915684235, 3),
(19, 'docente', '1980-05-29', 'ac99fecf6fcb8c25d18788d14a5384ee', 'Urbanização Quinta Dr. Beirão, Lote 30', 'docente@estensina.pt', 2147483647, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `fk_docente_curso` (`docente`);

--
-- Índices para tabela `estadoinscricao`
--
ALTER TABLE `estadoinscricao`
  ADD PRIMARY KEY (`estadoInscricao`);

--
-- Índices para tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`aluno`,`curso`),
  ADD KEY `curso` (`curso`),
  ADD KEY `estadoDaInscricao` (`estadoDaInscricao`);

--
-- Índices para tabela `tipoutilizador`
--
ALTER TABLE `tipoutilizador`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id_utilizador`),
  ADD KEY `fk_utilizador_tipoutilizador` (`tipo_utilizador`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `estadoinscricao`
--
ALTER TABLE `estadoinscricao`
  MODIFY `estadoInscricao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipoutilizador`
--
ALTER TABLE `tipoutilizador`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id_utilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_docente_curso` FOREIGN KEY (`docente`) REFERENCES `utilizador` (`id_utilizador`);

--
-- Limitadores para a tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `fk_aluno_inscricao` FOREIGN KEY (`aluno`) REFERENCES `utilizador` (`id_utilizador`),
  ADD CONSTRAINT `inscricao_ibfk_2` FOREIGN KEY (`curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `inscricao_ibfk_3` FOREIGN KEY (`estadoDaInscricao`) REFERENCES `estadoinscricao` (`estadoInscricao`);

--
-- Limitadores para a tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD CONSTRAINT `fk_utilizador_tipoutilizador` FOREIGN KEY (`tipo_utilizador`) REFERENCES `tipoutilizador` (`id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
