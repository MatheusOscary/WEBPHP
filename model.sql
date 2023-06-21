-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/06/2023 às 00:02
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
(0x72b91d7446dffd03dfd61cda84837524245a3f79817d99806d97371dd159a034, 1, '2023-06-18 11:52:44'),
(0x72b91d7446dffd03dfd61cda84837524eff607ed79bc449dccbf574f0df1d42e, 1, '2023-06-18 11:55:08'),
(0xa433e69da21f3c1e560a0aafd164a14e114b6f07264876947105da34696982a7, 1, '2023-06-18 11:34:30'),
(0xa433e69da21f3c1e560a0aafd164a14e3b15d4efdf35ff30bab2c2c85d09d3af, 1, '2023-06-18 11:32:24'),
(0xa433e69da21f3c1e560a0aafd164a14e4fbb2a6812e5c68ca28fa0b0d97fe9cf, 1, '2023-06-18 11:33:16'),
(0xa433e69da21f3c1e560a0aafd164a14e567f4b966901379845b67dbed8999e3e, 1, '2023-06-18 11:38:53'),
(0xa433e69da21f3c1e560a0aafd164a14ee0254ec37c97180ac765dd9d4da8bf29, 1, '2023-06-18 11:37:35'),
(0xa433e69da21f3c1e560a0aafd164a14ef0460b2e012f38df31256b06cf3606c3, 1, '2023-06-18 11:30:04');

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
(7, 'Joaoloiola', 0x6d6f5164b4001bf37ce61bc48fd9c891, 'Joaoloiola@outlook.com', '2023-06-17 16:53:01', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `mpglogin`
--
ALTER TABLE `mpglogin`
  ADD PRIMARY KEY (`Token`),
  ADD KEY `mpgLogin_UserId_fk` (`UserId`);

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
-- AUTO_INCREMENT de tabela `mpguser`
--
ALTER TABLE `mpguser`
  MODIFY `UserId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `mpglogin`
--
ALTER TABLE `mpglogin`
  ADD CONSTRAINT `mpgLogin_UserId_fk` FOREIGN KEY (`UserId`) REFERENCES `mpguser` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
