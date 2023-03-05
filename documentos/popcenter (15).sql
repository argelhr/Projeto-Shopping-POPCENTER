-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Jan-2023 às 13:09
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `popcenter`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamentos`
--

CREATE TABLE `departamentos` (
  `coddepartamento` int(11) NOT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `departamentos`
--

INSERT INTO `departamentos` (`coddepartamento`, `descricao`, `ativo`) VALUES
(2, 'Ferramentas', 1),
(6, 'Variedades', 1),
(7, 'Vestuário', 1),
(8, 'Eletrônicos', 1),
(9, 'Pescaria', 1),
(10, 'Barbeiro', 1),
(11, 'Brinquedos', 1),
(12, 'Pet shop', 0),
(13, 'Jóias', 1),
(14, 'Games', 1),
(15, 'Livros', 1),
(16, 'Perfumaria', 1),
(17, 'Relógios', 1),
(18, 'Bolsas e acessórios', 1),
(19, 'Filmes', 1),
(20, 'Tabacaria', 1),
(21, 'ABLUEBLE', 1),
(22, 'bbbbbbbbbb', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `codendereco` int(11) NOT NULL,
  `cep` varchar(50) DEFAULT NULL,
  `uf` varchar(10) DEFAULT NULL,
  `cidade` varchar(150) DEFAULT NULL,
  `bairro` varchar(150) DEFAULT NULL,
  `rua` varchar(150) DEFAULT NULL,
  `numero` varchar(150) DEFAULT NULL,
  `complemento` varchar(300) DEFAULT NULL,
  `codpessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`codendereco`, `cep`, `uf`, `cidade`, `bairro`, `rua`, `numero`, `complemento`, `codpessoa`) VALUES
(2, '96010000', 'RS', 'Pelotas', 'Centro', 'Rua Félix Xavier da Cunha', '12333', '', 2),
(5, '96010000', 'RS', 'Pelotas', 'Centro', 'Rua Félix Xavier da Cunha', '', '', 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lojas`
--

CREATE TABLE `lojas` (
  `codloja` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `cnpj` varchar(150) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `codpessoa` int(11) DEFAULT NULL,
  `coddepartamento` int(11) DEFAULT NULL,
  `foto` varchar(20) DEFAULT 'loja.png',
  `nr_loja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `lojas`
--

INSERT INTO `lojas` (`codloja`, `nome`, `cnpj`, `ativo`, `codpessoa`, `coddepartamento`, `foto`, `nr_loja`) VALUES
(2, 'Mundo das Ferramentasss', '12.132.1321/3213-23', 1, 2, 2, '2.jpg', 3),
(5, 'Banca da Tia', '13.123.1231/2312-31', 1, 4, 6, '5.jpg', 11),
(22, 'Tabacaria do Zé', '21.321.3213/2132-12', 1, 2, 11, '22.jpg', 12),
(23, 'Banca do miro', '21.321.2312/3132-13', 1, 15, 6, '23.jpg', 14),
(24, NULL, NULL, 1, 15, NULL, 'loja.png', 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `nr_lojas`
--

CREATE TABLE `nr_lojas` (
  `nr_loja` int(11) NOT NULL,
  `ocupado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `nr_lojas`
--

INSERT INTO `nr_lojas` (`nr_loja`, `ocupado`) VALUES
(1, 0),
(2, 0),
(3, 1),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 0),
(16, 0),
(17, 0),
(18, 0),
(19, 0),
(20, 0),
(21, 0),
(22, 0),
(23, 0),
(24, 0),
(25, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `codpessoa` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `dt_nasc` date DEFAULT NULL,
  `telefone` varchar(150) DEFAULT NULL,
  `senha` varchar(1000) DEFAULT NULL,
  `foto` varchar(200) DEFAULT 'foto.png',
  `ativo` tinyint(1) DEFAULT 0,
  `promocoes` tinyint(1) DEFAULT NULL,
  `nivel` varchar(50) DEFAULT 'CLIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`codpessoa`, `nome`, `email`, `cpf`, `dt_nasc`, `telefone`, `senha`, `foto`, `ativo`, `promocoes`, `nivel`) VALUES
(1, 'Argel', 'argelymanu@gmail.com', '123.123.122-12', '1995-02-21', '(12)11313-2132', '$2y$10$rWXCIl.SDtLBNVagJTvR6OEMXrtAiPz3xBsAnd7eexmM..QuG9IxC', 'foto.png', 1, 1, 'ADMIN'),
(2, 'Luiz', 'luiz@gmail.com', '111.111.111-12', '1967-02-15', '(12)31231-2312', '$2y$10$uXXg6Zhic30m1gfG0qomCuWIw0HG08GG.czaskOrOVLZa8/0/4A92', '2.jpg', 1, 1, 'LOJISTA'),
(3, 'Manu', 'emanuelleporto10@gmail.com', '121.313.212-12', '1999-12-17', '(12)31321-3213', '$2y$10$K.AGKXziONb9uTVjjFZPUOB2SkMRIjy.FZ.ILvbXAvApalJTFwRUG', 'foto.png', 1, 1, 'CLIENTE'),
(4, 'Maria', 'maria@gmail.com', '123.132.132-12', '2010-10-10', '(12)31213-2132', '$2y$10$EHPQdg3RLOcy3gx3gvL2BOsqlgperLcbROFnk3wgPzkkEwzr0ySW2', 'foto.png', 1, 0, 'LOJISTA'),
(9, 'argel', 'argelhr95@gmail.com', '123.132.132-13', '1995-02-21', '(53)53553-5353', '$2y$10$LArcHfOnkH7vFRsYz/o9BuNFUF/r8d/27DiYlNugHAQwoLQGcsSMy', 'foto.png', 1, 1, 'CLIENTE'),
(11, 'Luquinhas', 'lucasconceicao@hotmail.com', '123.123.123-12', '1997-10-15', '(12)31231-1241', '$2y$10$O3b9ba0A80Oom6/QRJW1Veh.6E4NoAy1PrY3OZG19k4cjllqx.XDa', 'foto.png', 1, 1, 'CLIENTE'),
(13, '123', '123@gmail.com', '123.123.123-12', '2020-12-12', '(12)31231-2313', '$2y$10$uNKoBeu42HZlD9taB2A/1.blA.G1rxJGsBeuDxBZFKol25BMeI3NS', 'foto.png', 1, 0, 'CLIENTE'),
(14, 'Esther', 'vrodrigues.esther@gmail.com', '213.213.213-21', '2000-08-15', '(12)13213-2132', '$2y$10$nVXxnW83NRA6tc3pPJ9CBOW/vjU8frUt9TuboRXSXEmkqaQqbv7q2', 'foto.png', 1, 1, 'CLIENTE'),
(15, 'Miro', 'miro@gmail.com', '132.123.123-14', '1212-12-12', '(21)32123-1321', '$2y$10$SAx6c48waUKRhi7qhPULzeiELmwRb6AcfGrnDqurvjsEbF3FBsqmy', '15.jpg', 1, 1, 'LOJISTA'),
(18, 'argel', 'argelhr@hotmail.com', '123.123.123-12', '1231-03-12', '(12)31231-2312', '$2y$10$mITCCgQT/hCkJKO2W9rDVO3fkfnwrJ0sSZ9uAxAEGS/0xeQrapHQa', 'foto.png', 1, 1, 'CLIENTE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `codproduto` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `descricao` varchar(400) DEFAULT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `codloja` int(11) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`codproduto`, `nome`, `descricao`, `valor`, `codloja`, `foto`, `ativo`) VALUES
(1, 'Alicate Crimpador', 'Feito de aço de alta resistência, com maior dureza, vida útil mais longa e pode fornecer efeito de crimpagem mais fino.', '59.90', 2, '2-1.jpg', 1),
(4, 'Alicate de corte', 'Esse utensílio amplamente utilizado serve principalmente para cortar fios de ligas metálicas, como alumínio, aço e cobre, conseguindo cortar inclusive materiais grossos com facilidade.', '30.00', 2, '2-2.jpg', 1),
(6, 'Makita', 'A Serra Mármore trabalha com uma rotação muito mais alta do que a Serra Circular, por isso, pode cortar materiais mais rígidos, como tijolos e azulejos, por exemplo. Apesar de não ser a sua principal função, é possível utilizar a Serra Mármore para cortar madeiras, desde que seja utilizado o disco correto.', '500.00', 2, '2-6.jpg', 1),
(7, 'Chaleira Eletrica', 'Com a chaleira elétrica dá pra fazer chás deliciosos a hora que quiser! Gente, a fervura da chaleira elétrica é bem mais rápida do que se você for ferver sua água no microondas ou no fogão, viu? E o melhor é que quando a água atinge o ponto ideal, o modelo desliga sozinho!', '70.00', 5, '5-7.png', 1),
(8, 'Óculos', 'Os óculos são dispositivos ópticos utilizados para a compensação de ametropias, e/ou proteção dos olhos, ou ainda por motivos estéticos', '35.00', 5, '5-8.jpg', 1),
(9, 'Kit de chaves e bits', 'CHAVES CHAVES CHAVES', '99.00', 2, '2-9.jpg', 1),
(10, 'DESESPERO', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '500.00', 2, 'produto.png', 1),
(11, 'Kit de ferramentas', 'Kit ferramentas diversas STMT81243-840 Stanley com 110 peças. Compacto e completo, dispondo de várias soluções desenvolvidas em cromo vanádio, garantindo maior durabilidade e resistência para as ferramentas. Maleta de plástico dobrável com abertura dupla com compartimentos específicos para cada produto. Catracas, alicates e chaves de fenda com cabo emborrachado para melhor aderência e conforto.', '680.00', 2, '2-11.jpg', 1),
(27, 'Cigarro GIFT', 'Cigarro é um pequeno cilindro de folhas de tabaco de corte fino enroladas numa mortalha que pode ser fumado. O cigarro é aceso numa das pontas, iniciando uma combustão lenta cujo fumo pode ser inalado pela outra ponta', '5.00', 22, '22-27jpeg', 1),
(28, 'Cola quente', 'A cola quente é muito útil pra fazer colares, cestos, potes, recipientes pra velas e muitos outros artesanatos até mesmo em roupas, pois cola bem pedrarias, fitas e rendas no tecido! E o bom é que ela seca rapidinho e não descola com o tempo.', '45.00', 23, '23-28.jpg', 1),
(29, 'bbbbbbbbb', 'adsahrahsdffdsgdf', '10.50', 2, 'produto.png', 1),
(30, 'cccccccc', '123123132132132', '50.12', 2, '2-30.png', 1),
(31, '123123', '12312312312', '321.00', 2, 'produto.png', 1),
(32, 'asdasdasdasd', 'asdasdasdasd', '123.00', 2, '2-32.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao`
--

CREATE TABLE `requisicao` (
  `email` varchar(150) NOT NULL,
  `token` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sacola`
--

CREATE TABLE `sacola` (
  `codsacola` int(11) NOT NULL,
  `codpessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `sacola`
--

INSERT INTO `sacola` (`codsacola`, `codpessoa`) VALUES
(19, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sacola_itens`
--

CREATE TABLE `sacola_itens` (
  `codseq` int(11) NOT NULL,
  `codsacola` int(11) DEFAULT NULL,
  `codproduto` int(11) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `sacola_itens`
--

INSERT INTO `sacola_itens` (`codseq`, `codsacola`, `codproduto`, `qtd`) VALUES
(83, 19, 9, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `NF` int(11) NOT NULL,
  `liberacao` tinyint(1) DEFAULT 0,
  `dt_venda` date DEFAULT NULL,
  `codpessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`NF`, `liberacao`, `dt_venda`, `codpessoa`) VALUES
(27, 1, '2023-01-06', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas_produtos`
--

CREATE TABLE `vendas_produtos` (
  `sequencial` int(11) NOT NULL,
  `NF` int(11) DEFAULT NULL,
  `codproduto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor` decimal(7,2) DEFAULT NULL,
  `valor_total` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `vendas_produtos`
--

INSERT INTO `vendas_produtos` (`sequencial`, `NF`, `codproduto`, `quantidade`, `valor`, `valor_total`) VALUES
(21, 27, 6, 1, '500.00', '500.00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`coddepartamento`);

--
-- Índices para tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`codendereco`),
  ADD KEY `fk_endereco_pessoa` (`codpessoa`);

--
-- Índices para tabela `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`codloja`),
  ADD KEY `fk_loja_pessoa` (`codpessoa`),
  ADD KEY `fk_loja_dep` (`coddepartamento`),
  ADD KEY `fk_loja_nr_loja` (`nr_loja`);

--
-- Índices para tabela `nr_lojas`
--
ALTER TABLE `nr_lojas`
  ADD PRIMARY KEY (`nr_loja`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`codpessoa`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`codproduto`),
  ADD KEY `fk_prod_loja` (`codloja`);

--
-- Índices para tabela `requisicao`
--
ALTER TABLE `requisicao`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `sacola`
--
ALTER TABLE `sacola`
  ADD PRIMARY KEY (`codsacola`),
  ADD KEY `fk_sacola_pessoa` (`codpessoa`);

--
-- Índices para tabela `sacola_itens`
--
ALTER TABLE `sacola_itens`
  ADD PRIMARY KEY (`codseq`),
  ADD KEY `fk_listagem_sacola` (`codsacola`),
  ADD KEY `fk_listagem_codproduto` (`codproduto`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`NF`),
  ADD KEY `fk_vendas_pessoas` (`codpessoa`);

--
-- Índices para tabela `vendas_produtos`
--
ALTER TABLE `vendas_produtos`
  ADD PRIMARY KEY (`sequencial`),
  ADD KEY `fk_vendas_produtos` (`codproduto`),
  ADD KEY `fk_vendas_NF` (`NF`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `coddepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `codendereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `lojas`
--
ALTER TABLE `lojas`
  MODIFY `codloja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `codpessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `codproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `sacola`
--
ALTER TABLE `sacola`
  MODIFY `codsacola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `sacola_itens`
--
ALTER TABLE `sacola_itens`
  MODIFY `codseq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `NF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `vendas_produtos`
--
ALTER TABLE `vendas_produtos`
  MODIFY `sequencial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `fk_endereco_pessoa` FOREIGN KEY (`codpessoa`) REFERENCES `pessoas` (`codpessoa`);

--
-- Limitadores para a tabela `lojas`
--
ALTER TABLE `lojas`
  ADD CONSTRAINT `fk_loja_dep` FOREIGN KEY (`coddepartamento`) REFERENCES `departamentos` (`coddepartamento`),
  ADD CONSTRAINT `fk_loja_nr_loja` FOREIGN KEY (`nr_loja`) REFERENCES `nr_lojas` (`nr_loja`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_prod_loja` FOREIGN KEY (`codloja`) REFERENCES `lojas` (`codloja`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `requisicao`
--
ALTER TABLE `requisicao`
  ADD CONSTRAINT `fk_email` FOREIGN KEY (`email`) REFERENCES `pessoas` (`email`);

--
-- Limitadores para a tabela `sacola`
--
ALTER TABLE `sacola`
  ADD CONSTRAINT `fk_sacola_pessoa` FOREIGN KEY (`codpessoa`) REFERENCES `pessoas` (`codpessoa`);

--
-- Limitadores para a tabela `sacola_itens`
--
ALTER TABLE `sacola_itens`
  ADD CONSTRAINT `fk_listagem_codproduto` FOREIGN KEY (`codproduto`) REFERENCES `produtos` (`codproduto`),
  ADD CONSTRAINT `fk_listagem_sacola` FOREIGN KEY (`codsacola`) REFERENCES `sacola` (`codsacola`);

--
-- Limitadores para a tabela `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_vendas_pessoas` FOREIGN KEY (`codpessoa`) REFERENCES `pessoas` (`codpessoa`);

--
-- Limitadores para a tabela `vendas_produtos`
--
ALTER TABLE `vendas_produtos`
  ADD CONSTRAINT `fk_vendas_NF` FOREIGN KEY (`NF`) REFERENCES `vendas` (`NF`),
  ADD CONSTRAINT `fk_vendas_produtos` FOREIGN KEY (`codproduto`) REFERENCES `produtos` (`codproduto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
