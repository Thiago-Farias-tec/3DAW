-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/11/2025 às 22:03
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aluguel`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acomodacoes`
--

CREATE TABLE `acomodacoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `acomodacoes`
--

INSERT INTO `acomodacoes` (`id`, `nome`, `descricao`, `preco`, `imagem`) VALUES
(1, 'Chalé à Beira-Mar', 'Encantador chalé com vista para o mar e acesso privativo à praia.', 350.00, 'img/chale.jpg'),
(2, 'Apartamento no Centro', 'Moderno apartamento no coração da cidade, próximo a todas as atrações.', 250.00, 'img/apto.jpg'),
(3, 'Cabana nas Montanhas', 'Aconchegante cabana com lareira e vista deslumbrante para as montanhas.', 280.00, 'img/cabana.jpg'),
(4, 'Hotel Boutique Histórico', 'Hotel charmoso localizado no centro histórico.', 420.00, 'img/hotel.jpg'),
(5, 'Vila Familiar com Piscina', 'Casa espaçosa ideal para famílias.', 550.00, 'img/vila.jpg'),
(6, 'Estúdio Compacto', 'Estúdio pequeno e aconchegante.', 120.00, 'img/estudio.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aulas`
--

INSERT INTO `aulas` (`id`, `nome`, `preco`) VALUES
(1, 'Aula de Dança Local', 90.00),
(2, 'Aula de Culinária Regional', 120.00),
(3, 'Guia Turístico Personalizado', 200.00),
(4, 'Aula de Yoga na Natureza', 70.00),
(5, 'Massagem Relaxante', 150.00),
(6, 'Sessão de Fotografia', 300.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `experiencias`
--

CREATE TABLE `experiencias` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `experiencias`
--

INSERT INTO `experiencias` (`id`, `nome`, `descricao`, `preco`, `imagem`) VALUES
(1, 'Passeio de Barco nas Ilhas', 'Passeio com paradas em ilhas paradisíacas.', 150.00, 'img/barco.jpg'),
(2, 'Trilha Ecológica com Guia', 'Trilha guiada em meio à natureza.', 80.00, 'img/trilha.jpg'),
(3, 'Tour Cultural Histórico', 'Visita guiada por pontos culturais da cidade.', 120.00, 'img/tour.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_acomodacao` int(11) NOT NULL,
  `nome_cliente` varchar(150) NOT NULL,
  `email_cliente` varchar(150) NOT NULL,
  `telefone_cliente` varchar(30) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas_aulas`
--

CREATE TABLE `reservas_aulas` (
  `id` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `nome_cliente` varchar(150) DEFAULT NULL,
  `email_cliente` varchar(150) DEFAULT NULL,
  `telefone_cliente` varchar(30) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas_experiencias`
--

CREATE TABLE `reservas_experiencias` (
  `id` int(11) NOT NULL,
  `id_experiencia` int(11) NOT NULL,
  `nome_cliente` varchar(150) DEFAULT NULL,
  `email_cliente` varchar(150) DEFAULT NULL,
  `telefone_cliente` varchar(30) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acomodacoes`
--
ALTER TABLE `acomodacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `experiencias`
--
ALTER TABLE `experiencias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_acomodacao` (`id_acomodacao`);

--
-- Índices de tabela `reservas_aulas`
--
ALTER TABLE `reservas_aulas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `reservas_experiencias`
--
ALTER TABLE `reservas_experiencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_experiencia` (`id_experiencia`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acomodacoes`
--
ALTER TABLE `acomodacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `experiencias`
--
ALTER TABLE `experiencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `reservas_aulas`
--
ALTER TABLE `reservas_aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `reservas_experiencias`
--
ALTER TABLE `reservas_experiencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_acomodacao`) REFERENCES `acomodacoes` (`id`);

--
-- Restrições para tabelas `reservas_experiencias`
--
ALTER TABLE `reservas_experiencias`
  ADD CONSTRAINT `reservas_experiencias_ibfk_1` FOREIGN KEY (`id_experiencia`) REFERENCES `experiencias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
