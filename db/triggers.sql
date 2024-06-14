DELIMITER //

-- notifiche
-- _________

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

CREATE TRIGGER notif_after_like_post
AFTER INSERT ON postlike
FOR EACH ROW
BEGIN
	DECLARE rec VARCHAR(30);
    SET rec = (SELECT username
				FROM post
                WHERE PostID = NEW.PostID
                LIMIT 1);
    IF rec <> NEW.username
	INSERT INTO notification (Receiver, Type, TriggeringUser, PostID) 
	VALUES (rec, 'Post_Interaction', NEW.Username, NEW.PostID);
END //

CREATE TRIGGER notif_after_comment_post
AFTER INSERT ON comment
FOR EACH ROW
BEGIN
	DECLARE rec VARCHAR(30);
    SET rec = (SELECT username
				FROM post
                WHERE PostID = NEW.PostID
                LIMIT 1);
	INSERT INTO notification (Receiver, Type, TriggeringUser) 
	VALUES (rec, 'Post_Interaction', NEW.Username);
END //

CREATE TRIGGER notif_after_reply_comment
AFTER INSERT ON comment
FOR EACH ROW
BEGIN
	DECLARE rec VARCHAR(30);
	IF NEW.Parent IS NOT NULL THEN
		SET rec = (SELECT username
					FROM comment
					WHERE CommentID = NEW.Parent
					LIMIT 1);
		INSERT INTO notification (Receiver, Type, TriggeringUser, CommentID) 
		VALUES (rec, 'Reply', NEW.Username, NEW.CommentID);
    END IF;
END //

CREATE TRIGGER notif_new_follower
AFTER INSERT ON follow
FOR EACH ROW
BEGIN
    INSERT INTO notification (Receiver, Type, TriggeringUser) 
	VALUES (NEW.following, 'Follower', NEW.follower);
END //

-- UPDATE di valori derivati
-- _________________________

CREATE TRIGGER add_num_like_post
AFTER INSERT ON postlike
FOR EACH ROW
BEGIN
	DECLARE nlike INT;
    
    SELECT numLike
    INTO nlike
    FROM post
    WHERE PostID = NEW.PostID
    LIMIT 1;
    
    UPDATE post
    SET NumLike = nlike +1
    WHERE PostID = NEW.PostID;
END //

CREATE TRIGGER rem_num_like_post
BEFORE DELETE ON postlike
FOR EACH ROW
BEGIN
	DECLARE nlike INT;
    
    SELECT numLike
    INTO nlike
    FROM post
    WHERE PostID = OLD.PostID
    LIMIT 1;
    
    UPDATE post
    SET NumLike = nlike - 1
    WHERE PostID = OLD.PostID;
END //

CREATE TRIGGER add_numFollower_user
AFTER INSERT ON follow
FOR EACH ROW
BEGIN
	DECLARE nfollower INT;
    
    SELECT NumFollower
    INTO nfollower
    FROM user
    WHERE Username = NEW.following;
    
    UPDATE post
    SET NumFollower = nfollower +1
    WHERE Username = NEW.following;
END //

CREATE TRIGGER rem_numFollower_user
BEFORE DELETE ON follow
FOR EACH ROW
BEGIN
	DECLARE nfollower INT;
    
    SELECT NumFollower
    INTO nfollower
    FROM user
    WHERE Username = OLD.following;
    
    UPDATE post
    SET NumFollower = nfollower -1
    WHERE Username = OLD.following;
END //

CREATE TRIGGER add_numFollowing_user
AFTER INSERT ON follow
FOR EACH ROW
BEGIN
	DECLARE nfollowing INT;
    
    SELECT NumFollowing
    INTO nfollowing
    FROM user
    WHERE Username = NEW.follower;
    
    UPDATE post
    SET NumFollowing = nfollowing +1
    WHERE Username = NEW.follower;
END //

CREATE TRIGGER rem_numFollowing_user
BEFORE DELETE ON follow
FOR EACH ROW
BEGIN
	DECLARE nfollowing INT;
    
    SELECT NumFollowing
    INTO nfollowing
    FROM user
    WHERE Username = OLD.follower;
    
    UPDATE post
    SET NumFollowing = nfollowing -1
    WHERE Username = OLD.follower;
END //

CREATE TRIGGER add_numComment_post
AFTER INSERT ON Comment
FOR EACH ROW
BEGIN
	DECLARE nComments INT;
    
    SELECT NumComments
    INTO nComments
    FROM post
    WHERE PostId = NEW.PostID;
    
    UPDATE post
    SET NumComments = nComments +1
    WHERE PostId = NEW.PostID;
END //

CREATE TRIGGER rem_numComment_post
BEFORE DELETE ON Comment
FOR EACH ROW
BEGIN
	DECLARE nComments INT;
    
    SELECT NumComments
    INTO nComments
    FROM post
    WHERE PostId = OLD.PostID;
    
    UPDATE post
    SET NumComments = nComments -1
    WHERE PostId = OLD.PostID;
END //

DELIMITER ;
