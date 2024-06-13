DELIMITER //

CREATE TRIGGER notif_after_post_insert
AFTER INSERT ON post
FOR EACH ROW
BEGIN
    DECLARE follower VARCHAR(30);
    DECLARE done INT DEFAULT FALSE;

    DECLARE follower_cursor CURSOR FOR
        SELECT follow.follower 
        FROM follow 
        WHERE following = NEW.Username;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN follower_cursor;

    fetch_follower: LOOP
        FETCH follower_cursor INTO follower;
        IF done THEN
            LEAVE fetch_follower;
        END IF;
		INSERT INTO notification (Receiver, Type, TriggeringUser, PostID) 
		VALUES (follower, 'Post', NEW.Username, NEW.PostID);
    END LOOP fetch_follower;

    CLOSE follower_cursor;

END //

CREATE TRIGGER notif_new_follower
AFTER INSERT ON follow
FOR EACH ROW
BEGIN
    INSERT INTO notification (Receiver, Type, TriggeringUser) 
	VALUES (NEW.following, 'Follower', NEW.follower);
END //
DELIMITER ;
