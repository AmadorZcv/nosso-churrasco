DELIMITER $
 
CREATE TRIGGER trg_churrasco_user AFTER INSERT
ON churrasco
FOR EACH ROW
BEGIN
    INSERT INTO user_has_churrasco (user_id, churrasco_id, is_admin) values (NEW.user_founder_id,NEW.id,1);
END$
 
DELIMITER 