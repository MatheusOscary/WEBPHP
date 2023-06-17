CREATE TABLE `mofs`.`mofsuser` (`UserId` BIGINT NOT NULL AUTO_INCREMENT , `Username` VARCHAR(32) NOT NULL , `Password` VARBINARY(128) NOT NULL , `Email` VARCHAR(60) NOT NULL , `Insert_date` DATETIME NOT NULL , `Update_date` DATETIME NULL DEFAULT NULL , `Update_session` BIGINT NULL DEFAULT NULL , PRIMARY KEY (`UserId`), UNIQUE `User_Username_UN` (`Username`(32)), UNIQUE `User_Email_UN` (`Email`(60))) ENGINE = InnoDB;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUser`(
    IN p_Username VARCHAR(32),
    IN p_Password VARCHAR(32),
    IN p_Email VARCHAR(60),
	OUT p_STATUS_CODE INT,
    OUT p_MESSAGE VARCHAR(255)
)
InsertUser:BEGIN
	IF (EXISTS(SELECT `User`.Username FROM mofsuser AS `User` WHERE `User`.Username = p_Username)) THEN
        SET p_STATUS_CODE = 409;
        SET p_MESSAGE = "Esse usuário já está sendo utilizado!";
		LEAVE InsertUser;
    END IF;
    
    IF(EXISTS(SELECT `User`.Email FROM mofsuser AS `User` WHERE `User`.Email = p_Email)) THEN
       	SET p_STATUS_CODE = 409;
        SET p_MESSAGE = "Esse e-mail já está sendo utilizado!";
        LEAVE InsertUser;
    END IF;
        
    INSERT INTO mofsuser (Username, `Password`, Email, Insert_date)
    VALUES (p_Username, AES_ENCRYPT(p_Password, "xxyyppzz"), p_Email, NOW());
    SET p_STATUS_CODE = 200;
    SET p_MESSAGE = "Cadastrado com sucesso!";
END$$
DELIMITER ;

