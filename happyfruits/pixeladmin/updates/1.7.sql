-- 19/09/2014
ALTER TABLE `users` ADD `do_shipping` TINYINT(1) DEFAULT 0 AFTER `type_id`;
UPDATE users SET do_shipping = 1 WHERE user_id IN (2,3,11,12,13,14);