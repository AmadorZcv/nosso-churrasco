DELIMITER $
 
CREATE TRIGGER trg_churrasco_user AFTER INSERT
ON churrasco
FOR EACH ROW
BEGIN
    INSERT INTO user_has_churrasco (user_id, churrasco_id, is_admin) SELECT user_founder_id, id, 1 FROM churrasco ORDER BY id DESC LIMIT 1;
END$
 
DELIMITER 