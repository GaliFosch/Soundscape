Drop trigger after_post_insert;
DELIMITER //

CREATE TRIGGER after_post_insert
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
		INSERT INTO notification (Receiver, Type, NotificationTimestamp, TriggeringUser, PostID) 
		VALUES (follower, 'Post', current_timestamp(), NEW.Username, NEW.PostID);
    END LOOP fetch_follower;

    CLOSE follower_cursor;

END //

DELIMITER ;
