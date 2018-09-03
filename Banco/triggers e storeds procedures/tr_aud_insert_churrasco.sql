DELIMITER $$
CREATE
	TRIGGER `nosso_churrasco`.`tr_aud_insert_churrasco` AFTER INSERT
    ON `nosso_churrasco`.`churrasco`
    FOR EACH ROW 
    BEGIN
    
    INSERT INTO aud_churrasco(tabela, acao, usuario, data_hora, chave, antes, depois)
    VALUES ('churrasco', 'INSERT', CURRENT_USER, NOW(), NEW.id, NULL, CONCAT(NEW.id, ' - ',  NEW.churras_name, ' - ', NEW.churras_datetime, ' - ', NEW.churras_ds_adress, ' - ', NEW.churras_image, ' - ', NEW.user_founder_id)) ;
    INSERT INTO user_has_churrasco (user_id, churrasco_id, is_admin) values (NEW.user_founder_id,NEW.id,1);
    END$$
DELIMITER ;