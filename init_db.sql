-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2025 at 06:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emprestai`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `codigo_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(50) NOT NULL,
  `descricao_categoria` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`codigo_categoria`, `nome_categoria`, `descricao_categoria`) VALUES
(1, 'Ferramentas Elétricas', 'Itens para reparos e construção'),
(2, 'Utensílios Domésticos', 'Equipamentos de cozinha e limpeza'),
(3, 'Camping e Lazer', 'Barracas, cadeiras e itens de viagem'),
(4, 'Instrumentos Musicais', 'Violões, teclados e percussão'),
(5, 'Eletrônicos', 'Projetores, caixas de som e periféricos');

-- --------------------------------------------------------

--
-- Table structure for table `doadores`
--

CREATE TABLE `doadores` (
  `codigo_doador` int(11) NOT NULL,
  `nome_doador` varchar(100) NOT NULL,
  `tipo_pessoa` char(1) NOT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `contato` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doadores`
--

INSERT INTO `doadores` (`codigo_doador`, `nome_doador`, `tipo_pessoa`, `cpf_cnpj`, `contato`) VALUES
(1, 'João da Silva', 'F', '111.222.333-44', 'joao.silva@email.com'),
(2, 'Maria Oliveira', 'F', '222.333.444-55', 'maria.o@email.com'),
(3, 'ConstruShop Ltda', 'J', '12.345.678/0001-90', 'contato@construshop.com.br'),
(4, 'Associação de Moradores', 'J', '98.765.432/0001-10', 'adm@associacao.org');

-- --------------------------------------------------------

--
-- Table structure for table `emprestimos`
--

CREATE TABLE `emprestimos` (
  `codigo_emprestimo` int(11) NOT NULL,
  `codigo_item` int(11) NOT NULL,
  `codigo_membro` int(11) NOT NULL,
  `data_emprestimo` datetime NOT NULL DEFAULT current_timestamp(),
  `data_prevista_dev` date NOT NULL,
  `data_efetiva_dev` datetime DEFAULT NULL,
  `status_emprestimo` varchar(20) NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emprestimos`
--

INSERT INTO `emprestimos` (`codigo_emprestimo`, `codigo_item`, `codigo_membro`, `data_emprestimo`, `data_prevista_dev`, `data_efetiva_dev`, `status_emprestimo`) VALUES
(1, 1, 2, '2025-12-04 19:18:38', '2025-12-11', '2025-12-04 19:26:03', 'Concluído'),
(2, 1, 4, '2025-12-04 19:35:52', '2025-12-11', '2025-12-04 20:03:30', 'Concluído'),
(3, 6, 1, '2025-12-04 20:05:37', '2025-12-12', '2025-12-04 20:28:20', 'Concluído'),
(4, 1, 1, '2025-12-04 20:05:45', '2025-12-12', '2025-12-04 20:28:33', 'Concluído'),
(5, 2, 1, '2025-12-04 20:05:51', '2025-12-12', '2025-12-04 20:28:24', 'Concluído'),
(6, 3, 1, '2025-12-04 20:05:56', '2025-12-12', '2025-12-04 20:28:28', 'Concluído'),
(7, 4, 1, '2025-12-04 20:06:02', '2025-12-12', '2025-12-04 20:28:36', 'Concluído'),
(8, 1, 5, '2025-12-04 20:47:23', '2025-12-12', '2025-12-06 12:37:40', 'Concluído'),
(9, 3, 6, '2025-12-06 09:11:17', '2025-12-13', NULL, 'Ativo'),
(10, 5, 1, '2025-12-06 09:17:40', '2025-12-13', '2025-12-06 10:05:03', 'Concluído'),
(11, 7, 9, '2025-12-06 09:19:05', '2025-12-13', NULL, 'Ativo'),
(12, 4, 2, '2025-12-06 09:45:04', '2025-12-13', '2025-12-06 10:38:20', 'Concluído'),
(13, 2, 4, '2025-12-06 09:48:05', '2025-12-13', NULL, 'Ativo'),
(14, 6, 2, '2025-12-06 09:48:11', '2025-12-13', '2025-12-06 09:58:03', 'Concluído'),
(15, 8, 1, '2025-12-06 09:59:42', '2025-12-13', '2025-12-06 10:04:51', 'Concluído'),
(16, 6, 5, '2025-12-06 10:01:23', '2025-12-13', '2025-12-06 10:35:49', 'Concluído'),
(17, 14, 7, '2025-12-06 10:34:11', '2025-12-13', '2025-12-06 10:38:17', 'Concluído'),
(18, 12, 2, '2025-12-06 11:12:26', '2025-12-13', NULL, 'Ativo'),
(19, 14, 2, '2025-12-06 11:12:30', '2025-12-13', NULL, 'Ativo'),
(20, 4, 2, '2025-12-06 11:12:34', '2025-12-13', NULL, 'Ativo'),
(21, 8, 2, '2025-12-06 11:12:37', '2025-12-13', NULL, 'Ativo'),
(22, 11, 2, '2025-12-06 11:12:41', '2025-12-09', NULL, 'Ativo'),
(23, 5, 13, '2025-12-06 12:37:02', '2025-12-13', NULL, 'Ativo');

-- --------------------------------------------------------

--
-- Table structure for table `itens`
--

CREATE TABLE `itens` (
  `codigo_item` int(11) NOT NULL,
  `nome_item` varchar(50) NOT NULL,
  `descricao_item` varchar(200) DEFAULT NULL,
  `codigo_categoria` int(11) NOT NULL,
  `codigo_doador` int(11) NOT NULL,
  `status_item` varchar(20) NOT NULL DEFAULT 'Disponível',
  `valor_reposicao` decimal(10,2) NOT NULL,
  `alto_valor` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itens`
--

INSERT INTO `itens` (`codigo_item`, `nome_item`, `descricao_item`, `codigo_categoria`, `codigo_doador`, `status_item`, `valor_reposicao`, `alto_valor`) VALUES
(1, 'Furadeira ', 'Furadeira 127v makita seminova ', 1, 1, 'Disponível', 436.00, 0),
(2, 'Parafusadeira Bosch', 'Parafusadeira e furadeira a bateria 12V com maleta', 1, 1, 'Emprestado', 350.00, 0),
(3, 'Serra Circular', 'Serra circular manual para madeira 1300W', 1, 3, 'Emprestado', 600.00, 1),
(4, 'Batedeira Planetária', 'Batedeira orbital preta com 3 batedores', 2, 2, 'Emprestado', 450.00, 0),
(5, 'Fritadeira Airfryer', 'Fritadeira sem óleo 4L digital', 2, 2, 'Emprestado', 380.00, 0),
(6, 'Máquina de Costura', 'Máquina doméstica portátil com 12 pontos', 2, 1, 'Disponível', 850.00, 1),
(7, 'Barraca Iglu 4 Pessoas', 'Barraca impermeável com proteção UV', 3, 4, 'Emprestado', 250.00, 0),
(8, 'Cadeira de Praia', 'Cadeira dobrável em alumínio', 3, 4, 'Emprestado', 80.00, 0),
(9, 'Violão Acústico', 'Violão nylon estudante com capa', 4, 1, 'Disponível', 400.00, 0),
(10, 'Projetor HD', 'Mini projetor LED com entrada HDMI e USB', 5, 3, 'Disponível', 1200.00, 1),
(11, 'Caixa de Som JBL', 'Caixa bluetooth portátil à prova d\'água', 5, 2, 'Emprestado', 650.00, 1),
(12, 'Baixo 5 cordas ', 'marca condor em otimo estado de conservacao ', 4, 4, 'Emprestado', 980.00, 1),
(13, 'monitor', 'marca lg semi-novo ', 5, 2, 'Disponível', 790.00, 1),
(14, 'barraca ', 'barraca para camping 4 lugares ', 3, 1, 'Emprestado', 345.00, 0),
(16, 'Martelete Rompedor', 'Martelete com encaixe SDS Plus, potência de 800W e 3 modos de operação', 1, 3, 'Disponível', 600.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `membros`
--

CREATE TABLE `membros` (
  `codigo_membro` int(11) NOT NULL,
  `nome_completo` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `tipo_plano` int(11) NOT NULL,
  `data_cadastro` date NOT NULL DEFAULT curdate(),
  `status_membro` varchar(20) NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membros`
--

INSERT INTO `membros` (`codigo_membro`, `nome_completo`, `cpf`, `email`, `telefone`, `senha_hash`, `tipo_plano`, `data_cadastro`, `status_membro`) VALUES
(1, 'Ana Clara Souza', '123.456.789-00', 'ana@email.com', '(11) 99999-8888', 'senha123', 101, '2024-01-15', 'Ativo'),
(2, 'Carlos Eduardo', '321.654.987-00', 'carlos@email.com', '(11) 98888-7777', 'senha123', 102, '2024-02-20', 'Ativo'),
(4, 'Ana Maria ', '332.444.555-24', 'asdfasdf@gmail.com', '(11) 9999999', '$2y$10$8Q89z7z/kij5/tdvBDDBheDgTVotL9X55R1EmuiYVAHQEOa8ryuuO', 101, '2025-12-04', 'Ativo'),
(5, 'Juliana Mendes', '123.123.123-12', 'ju.mendes@email.com', '(11) 91234-5678', '$2y$10$ExemploHashGen1', 101, '2024-05-10', 'Ativo'),
(6, 'Roberto Almeida', '456.456.456-45', 'beto.almeida@email.com', '(11) 99876-5432', '$2y$10$ExemploHashGen2', 102, '2024-06-15', 'Ativo'),
(7, 'Carla Dias', '789.789.789-78', 'carla.dias@email.com', '(11) 98888-7777', '$2y$10$ExemploHashGen3', 101, '2024-01-20', 'Ativo'),
(8, 'Marcos Mion', '111.222.333-44', 'mion@email.com', '(11) 97777-6666', '$2y$10$ExemploHashGen4', 102, '2024-08-30', 'Ativo'),
(9, 'Fernanda Torres', '555.666.777-88', 'nanda@email.com', '(11) 95555-4444', '$2y$10$ExemploHashGen5', 101, '2024-11-01', 'Ativo'),
(11, 'Edicleusa', '111.222.333-45', 'asdfasdf@gmail.com', '11999955944', '$2y$10$cxEXb8jjL7MJP3enX40QqePzJPiy2EB0emGlNJI7inNf3eXxtw.Ii', 101, '2025-12-06', 'Ativo'),
(13, 'Marcos andre pereira ', '432.567.123-98', 'adfghjd@gmail.com', '11 91234-4567', '$2y$10$5rw5d3LApLCm3q6PHbE4ve3TXlyw1TB9R0LRvIStQLRSkEX9VNPUa', 102, '2025-12-06', 'Ativo'),
(14, 'Maria jose goncalves ', '432.642.641.11', 'maria12@gmail.com', '(11)9455572335', '$2y$10$7C2NMbDDTRQOhrpomn2zQuxIN211QhAC52FWJZ8OU4c5rgaGPYeaO', 101, '2025-12-06', 'Ativo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codigo_categoria`);

--
-- Indexes for table `doadores`
--
ALTER TABLE `doadores`
  ADD PRIMARY KEY (`codigo_doador`);

--
-- Indexes for table `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`codigo_emprestimo`),
  ADD KEY `codigo_item` (`codigo_item`),
  ADD KEY `codigo_membro` (`codigo_membro`);

--
-- Indexes for table `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`codigo_item`),
  ADD KEY `codigo_categoria` (`codigo_categoria`),
  ADD KEY `codigo_doador` (`codigo_doador`);

--
-- Indexes for table `membros`
--
ALTER TABLE `membros`
  ADD PRIMARY KEY (`codigo_membro`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codigo_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doadores`
--
ALTER TABLE `doadores`
  MODIFY `codigo_doador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `codigo_emprestimo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `itens`
--
ALTER TABLE `itens`
  MODIFY `codigo_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `membros`
--
ALTER TABLE `membros`
  MODIFY `codigo_membro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `emprestimos_ibfk_1` FOREIGN KEY (`codigo_item`) REFERENCES `itens` (`codigo_item`),
  ADD CONSTRAINT `emprestimos_ibfk_2` FOREIGN KEY (`codigo_membro`) REFERENCES `membros` (`codigo_membro`);

--
-- Constraints for table `itens`
--
ALTER TABLE `itens`
  ADD CONSTRAINT `itens_ibfk_1` FOREIGN KEY (`codigo_categoria`) REFERENCES `categorias` (`codigo_categoria`),
  ADD CONSTRAINT `itens_ibfk_2` FOREIGN KEY (`codigo_doador`) REFERENCES `doadores` (`codigo_doador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
