delimiter //

create trigger new_post_not_check after insert on post
for each row
begin
	for each (select username from users )
end;//

delimiter ;