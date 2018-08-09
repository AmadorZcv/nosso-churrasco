DELIMITER $$
CREATE
	TRIGGER `nosso_churrasco`.`tr_aud_update_churrasco` AFTER UPDATE
    ON `nosso_churrasco`.`churrasco`
    FOR EACH ROW BEGIN
    
    INSERT INTO aud_churrasco(tabela, acao, usuario, data_hora, chave, antes, depois)
    VALUES ('churrasco', 'UPDATE', CURRENT_USER, NOW(), NEW.id, CONCAT(OLD.id, ' - ',  OLD.churras_name, ' - ', OLD.churras_datetime, ' - ', OLD.churras_ds_adress, ' - ', OLD.churras_image, ' - ', OLD.user_founder_id), CONCAT(NEW.id, ' - ',  NEW.churras_name, ' - ', NEW.churras_datetime, ' - ', NEW.churras_ds_adress, ' - ', NEW.churras_image, ' - ', NEW.user_founder_id)) ;
    
    END$$
DELIMITER ;