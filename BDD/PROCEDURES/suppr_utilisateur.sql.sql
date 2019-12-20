DELIMITER &&
CREATE DEFINER=`eblesch`@`%` PROCEDURE `suppr_utilisateur`(IN `login` VARCHAR(255) CHARSET utf8)
    COMMENT 'Procédure qui supprime un utilisateur'
DELETE FROM UTILISATEUR WHERE login  = login&&
DELIMITER ;