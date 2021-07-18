-- 29/10/2014
ALTER TABLE `orders` ADD `is_locked` TINYINT(1) DEFAULT 0;
UPDATE `orders` SET `is_locked` = 1 WHERE `is_shipped` = 1