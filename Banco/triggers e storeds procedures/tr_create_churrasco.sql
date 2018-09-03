DELIMITER $$
CREATE
	TRIGGER `nosso_churrasco`.`tr_create_churrasco` AFTER INSERT
    ON `nosso_churrasco`.`churrasco`
    FOR EACH ROW 
    BEGIN
    
    INSERT INTO compra(is_finalizada, end_entrega, data_finalizada, churrasco_id, preco, tipo_pagamento_id)
    VALUES (0, NEW.churras_ds_adress, '', NEW.id, '', 1) ;
    END$$
DELIMITER ;
Drop trigger tr_create_churrasco; 