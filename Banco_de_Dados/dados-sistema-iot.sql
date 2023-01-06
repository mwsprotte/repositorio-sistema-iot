-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Maio-2022 às 20:21
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dados-sistema-iot`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_dados`
--

CREATE TABLE `tb_dados` (
  `ID` int(11) NOT NULL,
  `local` varchar(45) NOT NULL,
  `tensao` float NOT NULL,
  `corrente` float NOT NULL,
  `frequencia` float NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Estrutura da tabela `tb_dados_projeto_2`
--

CREATE TABLE `tb_dados_projeto_2` (
  `ID` int(11) NOT NULL,
  `local` varchar(45) NOT NULL,
  `coeficiente` float NOT NULL,
  `deformacao` float NOT NULL,
  `deformacao_total` float NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estrutura da tabela `tb_dados_projeto_2_2`
--

CREATE TABLE `tb_dados_projeto_2_2` (
  `ID` int(11) NOT NULL,
  `local_2` varchar(45) NOT NULL,
  `coeficiente_2` float NOT NULL,
  `deformacao_2` float NOT NULL,
  `deformacao_total_2` float NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_dados_projeto_3`
--

CREATE TABLE `tb_dados_projeto_3` (
  `ID` int(11) NOT NULL,
  `local` varchar(45) NOT NULL,
  `v_rms` float NOT NULL,
  `i_rms` float NOT NULL,
  `frequencia` float NOT NULL,
  `pot_s` float NOT NULL,
  `pot_p` float NOT NULL,
  `pot_q` float NOT NULL,
  `fp` float NOT NULL,
  `diferencaFase` float NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `adm` int(11) NOT NULL,
  `projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuarios`, `email`, `senha`, `nome`, `adm`, `projeto`) VALUES
(18, 'msprotte@outlook.com', 'senha', 'Matheus Willian Sprotte', 0, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_dados`
--
ALTER TABLE `tb_dados`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `tb_dados_projeto_2`
--
ALTER TABLE `tb_dados_projeto_2`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `tb_dados_projeto_2_2`
--
ALTER TABLE `tb_dados_projeto_2_2`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `tb_dados_projeto_3`
--
ALTER TABLE `tb_dados_projeto_3`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_dados`
--
ALTER TABLE `tb_dados`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;

--
-- AUTO_INCREMENT de tabela `tb_dados_projeto_2`
--
ALTER TABLE `tb_dados_projeto_2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1503;

--
-- AUTO_INCREMENT de tabela `tb_dados_projeto_2_2`
--
ALTER TABLE `tb_dados_projeto_2_2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT de tabela `tb_dados_projeto_3`
--
ALTER TABLE `tb_dados_projeto_3`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
