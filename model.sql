-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/06/2023 às 21:32
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mpg`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertConsumer` (IN `p_Nome` VARCHAR(120), IN `p_CPF_CNPJ` VARCHAR(14), IN `p_RG_IE` VARCHAR(14), IN `p_Tipo_pessoa` CHAR(1), IN `p_Data_nascimento` DATE, IN `p_Sexo` CHAR(4), IN `p_Insert_session` VARBINARY(128), IN `p_UserId` BIGINT, OUT `p_STATUS_CODE` BIGINT, OUT `p_MESSAGE` VARCHAR(255))   InsertConsumer:BEGIN
	IF EXISTS(SELECT CPF_CNPJ FROM mpgconsumer WHERE CPF_CNPJ = p_CPF_CNPJ) THEN
    	SET p_STATUS_CODE = 409;
        IF (p_Tipo_pessoa = "F") THEN
        	SET p_MESSAGE = "Já existe uma pessoa cadastrada com esse CPF!";
       	ELSE
        	SET p_MESSAGE = "Já existe uma pessoa cadastrada com esse CNPJ!";
        END IF;
        LEAVE InsertConsumer;
    END IF;
    INSERT INTO mpgconsumer(Nome, CPF_CNPJ, RG_IE, Tipo_pessoa, Data_nascimento, Sexo, Insert_session, UserId)
	VALUES(p_Nome, p_CPF_CNPJ, p_RG_IE, p_Tipo_pessoa, p_Data_nascimento, p_Sexo, p_Insert_session, p_UserId); 
    SET p_STATUS_CODE = 200;
    SET p_MESSAGE = "Consumidor cadastrado com sucesso!";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertProduct` (IN `p_Nome` VARCHAR(120), IN `p_Preco_venda` DECIMAL(13,2), IN `p_Preco_compra` DECIMAL(13,2), IN `p_Cod_barra` VARCHAR(13), IN `p_Estoque` DECIMAL(13,2), IN `p_Insert_session` VARBINARY(128), IN `p_UserId` BIGINT, OUT `STATUS_CODE` BIGINT, OUT `MESSAGE` VARCHAR(255))   InsertProduct:BEGIN
   		IF EXISTS(SELECT Cod_barra FROM mpgproducts WHERE Cod_barra = p_Cod_barra) THEN
        	SET STATUS_CODE = 409;
        	SET MESSAGE = "Código de barras já está em uso!";
        	LEAVE InsertProduct;
        END IF;
        INSERT INTO mpgproducts (Nome, Preco_venda, Preco_compra, Cod_barra, Estoque,  Insert_session, UserId, Insert_date)
        VALUES(p_Nome, p_Preco_venda, p_Preco_compra, p_Cod_barra, p_Estoque, p_Insert_session, p_UserId, NOW());
        SET STATUS_CODE = 200;
        SET MESSAGE = "Produto cadastrado com sucesso!";
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertProductSold` (IN `p_Cod_barra` BIGINT, IN `p_SoldId` BIGINT, IN `p_Quantidade` DECIMAL(13,2), IN `p_Insert_session` VARBINARY(128), IN `p_UserId` BIGINT, OUT `STATUS_CODE` BIGINT, OUT `MESSAGE` VARCHAR(255))   InsertProductSold:BEGIN
	DECLARE v_Total DECIMAL(13,2);
	IF NOT EXISTS(SELECT ProductsId FROM mpgproducts WHERE Cod_barra = p_Cod_barra) THEN
    	SET STATUS_CODE = 209;
		SET MESSAGE = 'Produto não encontrado!';
        LEAVE InsertProductSold;
    ELSE
    	IF(SELECT IFNULL(estoque,0) - p_Quantidade FROM mpgproducts WHERE Cod_barra = p_Cod_barra) < 0 THEN
        	SET STATUS_CODE = 209;
            SET MESSAGE = 'Estoque Insuficiente!';
            LEAVE InsertProductSold;
        END IF;
    END IF;
    IF EXISTS(SELECT mpgproductsold.ProductsId FROM mpgproductsold INNER JOIN mpgproducts ON mpgproductsold.ProductsId = mpgproducts.ProductsId WHERE SoldId = p_SoldId AND mpgproducts.Cod_barra = p_Cod_barra) THEN
    	UPDATE mpgproductsold
    INNER JOIN mpgproducts ON mpgproductsold.ProductsId = mpgproducts.ProductsId
    SET mpgproductsold.Update_session = p_Insert_session, 
        mpgproductsold.Update_date = NOW(), 
        mpgproductsold.Preco = mpgproducts.Preco_venda * (mpgproductsold.Quantidade + p_Quantidade),
        mpgproductsold.Quantidade = mpgproductsold.Quantidade + p_Quantidade
    WHERE mpgproducts.Cod_barra = p_Cod_barra AND mpgproductsold.SoldId = p_SoldId;
    ELSE
    	INSERT INTO mpgproductsold(Insert_date, Insert_session, Preco, Quantidade, ProductsId, SoldId)
        SELECT NOW(), p_Insert_session, Preco_venda * p_Quantidade, p_Quantidade, ProductsId, p_SoldId FROM mpgproducts WHERE Cod_barra = p_Cod_barra;
        
        UPDATE mpgproducts SET estoque = estoque - p_Quantidade WHERE Cod_barra = p_Cod_barra;
    END IF;
    SET v_Total = (SELECT SUM(Preco) FROM mpgproductsold WHERE SoldId = p_SoldId);
    UPDATE mpgsold SET Total = v_Total WHERE SoldId = p_SoldId;
    SET STATUS_CODE = 200;
    SET MESSAGE = 'Produto Inserido!';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertSold` (IN `p_Insert_session` VARBINARY(128), IN `p_UserId` BIGINT, OUT `STATUS_CODE` BIGINT, OUT `MESSAGE` VARCHAR(255), OUT `SoldId` BIGINT)   InsertSold:BEGIN
	INSERT INTO mpgsold(Estado, UserId, Insert_date, Insert_session)
    VALUES('A', p_UserId, NOW(), p_Insert_session);
    SET SoldId = LAST_INSERT_ID();
    SET STATUS_CODE = 200;
    SET MESSAGE = 'Venda aberta com sucesso!';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUser` (IN `p_Username` VARCHAR(32), IN `p_Password` VARCHAR(32), IN `p_Email` VARCHAR(60), OUT `p_STATUS_CODE` INT, OUT `p_MESSAGE` VARCHAR(255))   InsertUser:BEGIN
	IF (EXISTS(SELECT `User`.Username FROM mpguser AS `User` WHERE `User`.Username = p_Username)) THEN
        SET p_STATUS_CODE = 409;
        SET p_MESSAGE = "Esse usuário já está sendo utilizado!";
		LEAVE InsertUser;
    END IF;
    
    IF(EXISTS(SELECT `User`.Email FROM mpguser AS `User` WHERE `User`.Email = p_Email)) THEN
       	SET p_STATUS_CODE = 409;
        SET p_MESSAGE = "Esse e-mail já está sendo utilizado!";
        LEAVE InsertUser;
    END IF;
        
    INSERT INTO mpguser (Username, `Password`, Email, Insert_date)
    VALUES (p_Username, AES_ENCRYPT(p_Password, "xxyyppzz"), p_Email, NOW());
    SET p_STATUS_CODE = 200;
    SET p_MESSAGE = "Cadastrado com sucesso!";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Login` (IN `p_Username` VARCHAR(32), IN `p_Password` VARCHAR(32), OUT `p_Token` VARBINARY(128), OUT `p_UserId` BIGINT, OUT `STATUS_CODE` BIGINT, OUT `MESSAGE` VARCHAR(255))   Login:BEGIN
	DECLARE v_login_date DATETIME;
	SET p_UserId = 0;
    SET p_Token = NULL;

	SELECT UserId INTO p_UserId FROM mpguser WHERE Username = p_Username AND `Password` =  AES_ENCRYPT(p_Password, "xxyyppzz");
	IF p_UserId > 0 Then
		SET v_login_date = NOW();
        SET p_Token = AES_ENCRYPT(CONCAT(p_UserId,v_login_date), "xxyyppzz");
		INSERT INTO mpglogin(Token, Login_date, UserId)
        VALUES(p_Token, v_login_date, p_UserId);
        SET STATUS_CODE = 200;
        SET MESSAGE = "Logado com sucesso!";
    ELSE
    	SET STATUS_CODE = 401;
        SET MESSAGE = "Usuario ou senha inválidos!";
        LEAVE Login;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mpgconsumer`
--

CREATE TABLE `mpgconsumer` (
  `Nome` varchar(120) NOT NULL,
  `ConsumerId` bigint(20) NOT NULL,
  `UserId` bigint(20) DEFAULT NULL,
  `CPF_CNPJ` varchar(14) NOT NULL,
  `RG_IE` varchar(14) NOT NULL,
  `Tipo_pessoa` char(1) NOT NULL CHECK (`Tipo_pessoa` in ('J','F')),
  `Data_nascimento` date NOT NULL,
  `Sexo` char(4) NOT NULL,
  `Insert_date` datetime NOT NULL,
  `Insert_session` varbinary(128) NOT NULL,
  `Update_date` datetime DEFAULT NULL,
  `Update_session` varbinary(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mpgconsumer`
--

INSERT INTO `mpgconsumer` (`Nome`, `ConsumerId`, `UserId`, `CPF_CNPJ`, `RG_IE`, `Tipo_pessoa`, `Data_nascimento`, `Sexo`, `Insert_date`, `Insert_session`, `Update_date`, `Update_session`) VALUES
('Consumidor', 1, 1, '0000000000000', '0000000000000', 'F', '2003-07-07', 'MNTC', '0000-00-00 00:00:00', 0x6619b9737ce956aed16a4b9aa0f0b19d28dbf0a691a059a8c1d2c06bdcb89f36, '2023-06-23 22:08:47', 0x6619b9737ce956aed16a4b9aa0f0b19d28dbf0a691a059a8c1d2c06bdcb89f36);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mpglogin`
--

CREATE TABLE `mpglogin` (
  `Token` varbinary(128) NOT NULL,
  `UserId` bigint(20) NOT NULL,
  `Login_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mpglogin`
--

INSERT INTO `mpglogin` (`Token`, `UserId`, `Login_date`) VALUES
(0x09a3371ccbd1d279cd189d3fb8b36d08070aca0bd15affb1674050373a3cda45, 1, '2023-06-18 11:45:05'),
(0x09a3371ccbd1d279cd189d3fb8b36d0832ede48aec5bf920948737d0410785d6, 1, '2023-06-18 11:44:17'),
(0x09a3371ccbd1d279cd189d3fb8b36d083a0c2e4a27ef269cd883dcbee26e0066, 1, '2023-06-18 11:43:47'),
(0x09a3371ccbd1d279cd189d3fb8b36d086afb2aef216ad308719ff5cf945b695c, 1, '2023-06-18 11:49:58'),
(0x09a3371ccbd1d279cd189d3fb8b36d089c3c2a6c5879a37756f3f7e8c512bb1d, 1, '2023-06-18 11:44:38'),
(0x09a3371ccbd1d279cd189d3fb8b36d08a0baa9f2706457be3810b6346af41826, 1, '2023-06-18 11:42:42'),
(0x09a3371ccbd1d279cd189d3fb8b36d08cacadd97ca916c9096dd11d288334639, 1, '2023-06-18 11:47:50'),
(0x09a3371ccbd1d279cd189d3fb8b36d08f8dcd2562b82549f37750a17414301d9, 1, '2023-06-18 11:44:00'),
(0x2754877849feb2525677fb16fe2f1510749fce5d3e508272ef3ac1d0cd24a34e, 1, '2023-06-17 22:42:16'),
(0x2754877849feb2525677fb16fe2f1510ab28934af8ee9424a8d55f64636fbf47, 1, '2023-06-17 22:43:05'),
(0x35e83ec3f74e5bfe73611acd2b07ab39b59eaaeac0e55c393f4c0daca19124ec, 1, '2023-06-18 11:28:12'),
(0x6619b9737ce956aed16a4b9aa0f0b19d28dbf0a691a059a8c1d2c06bdcb89f36, 1, '2023-06-23 19:44:16'),
(0x72b91d7446dffd03dfd61cda84837524245a3f79817d99806d97371dd159a034, 1, '2023-06-18 11:52:44'),
(0x72b91d7446dffd03dfd61cda84837524eff607ed79bc449dccbf574f0df1d42e, 1, '2023-06-18 11:55:08'),
(0x95aeea7636105d59ef3b00d123d2625d245a3f79817d99806d97371dd159a034, 1, '2023-06-22 20:02:44'),
(0x963f6d6124f437ae8d94a5155ee81543b6f2646fa3e96aed177cd80659b1941e, 1, '2023-06-24 15:45:10'),
(0xa433e69da21f3c1e560a0aafd164a14e114b6f07264876947105da34696982a7, 1, '2023-06-18 11:34:30'),
(0xa433e69da21f3c1e560a0aafd164a14e3b15d4efdf35ff30bab2c2c85d09d3af, 1, '2023-06-18 11:32:24'),
(0xa433e69da21f3c1e560a0aafd164a14e4fbb2a6812e5c68ca28fa0b0d97fe9cf, 1, '2023-06-18 11:33:16'),
(0xa433e69da21f3c1e560a0aafd164a14e567f4b966901379845b67dbed8999e3e, 1, '2023-06-18 11:38:53'),
(0xa433e69da21f3c1e560a0aafd164a14ee0254ec37c97180ac765dd9d4da8bf29, 1, '2023-06-18 11:37:35'),
(0xa433e69da21f3c1e560a0aafd164a14ef0460b2e012f38df31256b06cf3606c3, 1, '2023-06-18 11:30:04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mpgproducts`
--

CREATE TABLE `mpgproducts` (
  `ProductsId` bigint(20) NOT NULL,
  `UserId` bigint(20) DEFAULT NULL,
  `Nome` varchar(120) DEFAULT NULL,
  `Preco_venda` decimal(13,2) NOT NULL CHECK (`Preco_venda` > 0),
  `Preco_compra` decimal(13,2) NOT NULL CHECK (`Preco_compra` >= 0),
  `Cod_barra` varchar(13) DEFAULT NULL,
  `estoque` decimal(13,2) NOT NULL CHECK (`estoque` >= 0),
  `Insert_date` datetime NOT NULL,
  `Insert_session` varbinary(128) NOT NULL,
  `Update_date` datetime DEFAULT NULL,
  `Update_session` varbinary(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mpgproductsold`
--

CREATE TABLE `mpgproductsold` (
  `ProductSoldId` bigint(20) NOT NULL,
  `ProductsId` bigint(20) DEFAULT NULL,
  `Preco` decimal(13,2) NOT NULL DEFAULT 0.00,
  `Quantidade` decimal(13,2) NOT NULL DEFAULT 0.00,
  `Insert_date` datetime NOT NULL,
  `Insert_session` varbinary(128) NOT NULL,
  `Update_date` datetime DEFAULT NULL,
  `Update_session` varbinary(128) DEFAULT NULL,
  `SoldId` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mpgsold`
--

CREATE TABLE `mpgsold` (
  `SoldId` bigint(20) NOT NULL,
  `ConsumerId` bigint(20) NOT NULL DEFAULT 1,
  `UserId` bigint(20) DEFAULT NULL,
  `Estado` char(1) NOT NULL CHECK (`Estado` in ('A','C','D')),
  `Total` decimal(13,2) NOT NULL DEFAULT 0.00,
  `Forma_pagto` int(11) NOT NULL,
  `Insert_date` datetime NOT NULL,
  `Insert_session` varbinary(128) NOT NULL,
  `Update_date` datetime DEFAULT NULL,
  `Update_session` varbinary(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mpgsold`
--

INSERT INTO `mpgsold` (`SoldId`, `ConsumerId`, `UserId`, `Estado`, `Total`, `Forma_pagto`, `Insert_date`, `Insert_session`, `Update_date`, `Update_session`) VALUES
(1, 1, 1, 'A', 0.00, 0, '2023-06-24 15:45:36', 0x963f6d6124f437ae8d94a5155ee81543b6f2646fa3e96aed177cd80659b1941e, NULL, NULL),
(2, 1, 1, 'A', 0.00, 0, '2023-06-24 15:46:08', 0x963f6d6124f437ae8d94a5155ee81543b6f2646fa3e96aed177cd80659b1941e, NULL, NULL),
(3, 1, 1, 'A', 0.00, 0, '2023-06-24 15:47:36', 0x963f6d6124f437ae8d94a5155ee81543b6f2646fa3e96aed177cd80659b1941e, NULL, NULL),
(4, 1, 1, 'A', 0.00, 0, '2023-06-24 15:50:10', 0x963f6d6124f437ae8d94a5155ee81543b6f2646fa3e96aed177cd80659b1941e, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mpguser`
--

CREATE TABLE `mpguser` (
  `UserId` bigint(20) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Password` varbinary(128) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Insert_date` datetime NOT NULL,
  `Update_date` datetime DEFAULT NULL,
  `Update_session` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mpguser`
--

INSERT INTO `mpguser` (`UserId`, `Username`, `Password`, `Email`, `Insert_date`, `Update_date`, `Update_session`) VALUES
(1, 'matheus.oscar', 0xe55bee63bd30f4b4d303b31c42fb4ac2, 'matheusoscar2019@gmail.com', '2023-06-17 14:57:24', NULL, NULL),
(2, 'Teste', 0x4e2643e516c04283a943cc7a8a5d3df1, 'Teste@gmail.com', '2023-06-17 16:19:35', NULL, NULL),
(5, 'Teste2', 0x553e244f18d1b612f996ac93231d9327, 'aaaaa', '2023-06-17 16:49:50', NULL, NULL),
(6, 'Joao.pedro', 0x6d6f5164b4001bf37ce61bc48fd9c891, 'joaopedro@outlook.com', '2023-06-17 16:51:46', NULL, NULL),
(7, 'Joaoloiola', 0x6d6f5164b4001bf37ce61bc48fd9c891, 'Joaoloiola@outlook.com', '2023-06-17 16:53:01', NULL, NULL),
(8, '', 0x7bf12cbe3d5318a3be88233ab4b6fbe2, '', '2023-06-22 21:34:02', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `mpgconsumer`
--
ALTER TABLE `mpgconsumer`
  ADD PRIMARY KEY (`ConsumerId`),
  ADD UNIQUE KEY `CPF_CNPJ_un` (`CPF_CNPJ`),
  ADD KEY `UserId_fk` (`UserId`);

--
-- Índices de tabela `mpglogin`
--
ALTER TABLE `mpglogin`
  ADD PRIMARY KEY (`Token`),
  ADD KEY `mpgLogin_UserId_fk` (`UserId`);

--
-- Índices de tabela `mpgproducts`
--
ALTER TABLE `mpgproducts`
  ADD PRIMARY KEY (`ProductsId`),
  ADD UNIQUE KEY `Cod_barra_un` (`Cod_barra`),
  ADD KEY `Products_UserId_fk` (`UserId`);

--
-- Índices de tabela `mpgproductsold`
--
ALTER TABLE `mpgproductsold`
  ADD PRIMARY KEY (`ProductSoldId`),
  ADD KEY `ProductSold_ProductId_fk` (`ProductsId`);

--
-- Índices de tabela `mpgsold`
--
ALTER TABLE `mpgsold`
  ADD PRIMARY KEY (`SoldId`),
  ADD KEY `Sold_ConsumerId_fk` (`ConsumerId`),
  ADD KEY `Sold_UserId_fk` (`UserId`);

--
-- Índices de tabela `mpguser`
--
ALTER TABLE `mpguser`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `User_Username_UN` (`Username`),
  ADD UNIQUE KEY `User_Email_UN` (`Email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `mpgconsumer`
--
ALTER TABLE `mpgconsumer`
  MODIFY `ConsumerId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `mpgproducts`
--
ALTER TABLE `mpgproducts`
  MODIFY `ProductsId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `mpgsold`
--
ALTER TABLE `mpgsold`
  MODIFY `SoldId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `mpguser`
--
ALTER TABLE `mpguser`
  MODIFY `UserId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `mpgconsumer`
--
ALTER TABLE `mpgconsumer`
  ADD CONSTRAINT `UserId_fk` FOREIGN KEY (`UserId`) REFERENCES `mpguser` (`UserId`);

--
-- Restrições para tabelas `mpglogin`
--
ALTER TABLE `mpglogin`
  ADD CONSTRAINT `mpgLogin_UserId_fk` FOREIGN KEY (`UserId`) REFERENCES `mpguser` (`UserId`);

--
-- Restrições para tabelas `mpgproducts`
--
ALTER TABLE `mpgproducts`
  ADD CONSTRAINT `Products_UserId_fk` FOREIGN KEY (`UserId`) REFERENCES `mpguser` (`UserId`);

--
-- Restrições para tabelas `mpgproductsold`
--
ALTER TABLE `mpgproductsold`
  ADD CONSTRAINT `ProductSold_ProductId_fk` FOREIGN KEY (`ProductsId`) REFERENCES `mpgproducts` (`ProductsId`);

--
-- Restrições para tabelas `mpgsold`
--
ALTER TABLE `mpgsold`
  ADD CONSTRAINT `Sold_ConsumerId_fk` FOREIGN KEY (`ConsumerId`) REFERENCES `mpgconsumer` (`ConsumerId`),
  ADD CONSTRAINT `Sold_UserId_fk` FOREIGN KEY (`UserId`) REFERENCES `mpguser` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
