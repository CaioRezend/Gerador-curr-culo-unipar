-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/11/2025 às 21:50
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `generatordb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `certificados`
--

CREATE TABLE `certificados` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `instituicao` varchar(200) DEFAULT NULL,
  `data_emissao` date DEFAULT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_pessoais`
--

CREATE TABLE `dados_pessoais` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `sobre` text DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto_caminho` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dados_pessoais`
--

INSERT INTO `dados_pessoais` (`id`, `nome`, `email`, `telefone`, `nascimento`, `sobre`, `endereco`, `cidade`, `estado`, `cep`, `criado_em`, `atualizado_em`, `foto_caminho`) VALUES
(21, 'Caio Pessutti Rezende Elochim Ventura', 'kaiorezende.contato@gmail.com', '(44) 99127-0239', NULL, 'Um programador escreve, testa, mantém e melhora códigos que compõem softwares, aplicativos, sites e outros sistemas digitais. Sua função principal é transformar ideias em soluções tecnológicas por meio da lógica de programação, o que envolve planejar, codificar, testar e corrigir falhas (bugs). ', NULL, NULL, NULL, NULL, '2025-10-31 22:25:56', '2025-10-31 22:25:56', NULL),
(22, 'Caio Pessutti Rezende Elochim Ventura', 'admin@gmail.com', '(44) 99127-0239', NULL, 'Um programador escreve, testa, mantém e melhora códigos que compõem softwares, aplicativos, sites e outros sistemas digitais. Sua função principal é transformar ideias em soluções tecnológicas por meio da lógica de programação, o que envolve planejar, codificar, testar e corrigir falhas (bugs). ', NULL, NULL, NULL, NULL, '2025-10-31 22:31:24', '2025-10-31 22:31:24', NULL),
(23, 'Caio Pessutti Rezende Elochim Ventura', 'admin@gmail.com', '(44) 99127-0239', NULL, 'Um programador escreve, testa, mantém e melhora códigos que compõem softwares, aplicativos, sites e outros sistemas digitais. Sua função principal é transformar ideias em soluções tecnológicas por meio da lógica de programação, o que envolve planejar, codificar, testar e corrigir falhas (bugs). ', NULL, NULL, NULL, NULL, '2025-10-31 22:39:36', '2025-10-31 22:39:36', NULL),
(24, 'Monica Nunes Rezende', 'moniceteste@gmail.com', '12345678', NULL, 'teste', NULL, NULL, NULL, NULL, '2025-11-02 17:27:05', '2025-11-02 17:27:05', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `educacao`
--

CREATE TABLE `educacao` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `instituicao` varchar(200) NOT NULL,
  `curso` varchar(200) DEFAULT NULL,
  `nivel` enum('Ensino Fundamental','Ensino Médio','Técnico','Graduação','Pós-Graduação','Mestrado','Doutorado','Outro') DEFAULT 'Graduação',
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `em_andamento` tinyint(1) DEFAULT 0,
  `ordem` int(11) DEFAULT 0,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `experiencias`
--

CREATE TABLE `experiencias` (
  `id` int(11) NOT NULL,
  `curriculo_id` int(11) NOT NULL,
  `cargo` varchar(150) NOT NULL,
  `empresa` varchar(150) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `atual` tinyint(1) DEFAULT 0,
  `ordem` int(11) DEFAULT 0,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `experiencias`
--

INSERT INTO `experiencias` (`id`, `curriculo_id`, `cargo`, `empresa`, `descricao`, `cidade`, `pais`, `data_inicio`, `data_fim`, `atual`, `ordem`, `criado_em`) VALUES
(10, 21, 'Desenvolvedor de Software - DEV JR', 'GURPO - PARAISO', 'teste', NULL, NULL, NULL, NULL, 0, 0, '2025-10-31 22:26:16'),
(11, 22, 'Desenvolvedor de Software - DEV JR', 'GURPO - PARAISO', 'Um programador escreve, testa, mantém e melhora códigos que compõem softwares, aplicativos, sites e outros sistemas digitais. Sua função principal é transformar ideias em soluções tecnológicas por meio da lógica de programação, o que envolve planejar, codificar, testar e corrigir falhas (bugs). ', NULL, NULL, NULL, NULL, 1, 0, '2025-10-31 22:32:21'),
(12, 23, 'Desenvolvedor de Software - DEV JR', 'GURPO - PARAISO', 'teste', NULL, NULL, NULL, NULL, 1, 0, '2025-10-31 22:40:33'),
(13, 24, 'Desenvolvedor de Software - DEV JR', 'GURPO - PARAISO', 'teste', NULL, NULL, NULL, NULL, 1, 0, '2025-11-02 17:27:32');

-- --------------------------------------------------------

--
-- Estrutura para tabela `formacao`
--

CREATE TABLE `formacao` (
  `id` int(11) NOT NULL,
  `curriculo_id` int(11) NOT NULL,
  `instituicao` varchar(255) NOT NULL COMMENT 'Nome da Instituição de Ensino',
  `curso` varchar(255) NOT NULL COMMENT 'Nome do Curso ou Habilitação',
  `nivel` varchar(100) DEFAULT NULL COMMENT 'Nível de formação (Ex: Graduação, Pós-graduação, Técnico)',
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL COMMENT 'Pode ser NULL se a formação estiver em andamento',
  `descricao` text DEFAULT NULL COMMENT 'Detalhes ou resumo da formação/projeto',
  `status_formacao` enum('Completa','Em andamento','Trancada') DEFAULT 'Completa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Registra o histórico educacional do usuário.';

--
-- Despejando dados para a tabela `formacao`
--

INSERT INTO `formacao` (`id`, `curriculo_id`, `instituicao`, `curso`, `nivel`, `data_inicio`, `data_fim`, `descricao`, `status_formacao`) VALUES
(9, 21, 'CEEP PAULO RENATO SOUZA', 'TECNICO EM INFORMÁTICA', NULL, NULL, '0000-00-00', 'Test', 'Completa'),
(10, 22, 'CEEP PAULO RENATO SOUZA', 'TECNICO EM INFORMÁTICA', NULL, NULL, '0000-00-00', 'Seu futuro profissional está aqui! | Tec. em Desenv. de Sistemas | Tec. em Administração ', 'Completa'),
(11, 23, 'CEEP PAULO RENATO SOUZA', 'TECNICO EM INFORMÁTICA', NULL, NULL, '0000-00-00', 'Seu futuro profissional está aqui! | Tec. em Desenv. de Sistemas | Tec. em Administração ', 'Completa'),
(12, 24, 'CEEP PAULO RENATO SOUZA', 'TECNICO EM INFORMÁTICA', NULL, NULL, '0000-00-00', ' ', 'Completa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `habilidades`
--

CREATE TABLE `habilidades` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `nivel` enum('Básico','Intermediário','Avançado','Especialista') DEFAULT 'Intermediário',
  `ordem` int(11) DEFAULT 0,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `referencias`
--

CREATE TABLE `referencias` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `relacao` varchar(150) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `ordem` int(11) DEFAULT 0,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `nascimento` date NOT NULL,
  `idade` int(11) DEFAULT NULL,
  `sobre` text DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `foto_path` varchar(255) DEFAULT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `certificados`
--
ALTER TABLE `certificados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `dados_pessoais`
--
ALTER TABLE `dados_pessoais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `educacao`
--
ALTER TABLE `educacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `experiencias`
--
ALTER TABLE `experiencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`curriculo_id`);

--
-- Índices de tabela `formacao`
--
ALTER TABLE `formacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_formacao_user` (`curriculo_id`);

--
-- Índices de tabela `habilidades`
--
ALTER TABLE `habilidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `referencias`
--
ALTER TABLE `referencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `certificados`
--
ALTER TABLE `certificados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dados_pessoais`
--
ALTER TABLE `dados_pessoais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `educacao`
--
ALTER TABLE `educacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `experiencias`
--
ALTER TABLE `experiencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `formacao`
--
ALTER TABLE `formacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `referencias`
--
ALTER TABLE `referencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `certificados`
--
ALTER TABLE `certificados`
  ADD CONSTRAINT `certificados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `educacao`
--
ALTER TABLE `educacao`
  ADD CONSTRAINT `educacao_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `habilidades`
--
ALTER TABLE `habilidades`
  ADD CONSTRAINT `habilidades_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `referencias`
--
ALTER TABLE `referencias`
  ADD CONSTRAINT `referencias_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
