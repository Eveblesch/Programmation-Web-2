DELIMITER &&
CREATE DEFINER=`eblesch`@`%` PROCEDURE `add_utilisateur`(IN `login` VARCHAR(255) CHARSET utf8, OUT `mdp` VARCHAR(255) CHARSET utf8)
    COMMENT 'Ajoute un utilisateur à partir d''un login et d'' mot de passe'
INSERT INTO UTILISATEUR (login, mdp, pseudo, email, id_droit) VALUES (login1, mdp1, pseudo1, email1, id_droit1)
login=VALUES(login1), mdp=VALUES(mdp1), pseudo=VALUES(pseudo1), email=VALUES(email1), id_droit=VALUES(id_droit1)&&
DELIMITER ;