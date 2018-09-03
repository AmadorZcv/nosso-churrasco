DELIMITER $$
CREATE
	TRIGGER `nosso_churrasco`.`tr_aud_delete_churrasco` AFTER DELETE
    ON `nosso_churrasco`.`churrasco`
    FOR EACH ROW BEGIN
    
    INSERT INTO aud_churrasco(tabela, acao, usuario, data_hora, chave, antes, depois)
    VALUES ('churrasco', 'DELETE', CURRENT_USER, NOW(), OLD.id, CONCAT(OLD.id, ' - ',  OLD.churras_name, ' - ', OLD.churras_datetime, ' - ', OLD.churras_ds_adress, ' - ', OLD.churras_image, ' - ', OLD.user_founder_id), NULL ) ;
    
    END$$
DELIMITER ;

Drop trigger tr_aud_delete_churrasco; 