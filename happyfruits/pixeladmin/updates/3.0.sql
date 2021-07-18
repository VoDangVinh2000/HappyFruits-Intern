-- 14/12/2014
ALTER TABLE `orders`CHANGE `code` `code` VARCHAR(20) NULL;
ALTER TABLE `orders` ADD `table_name` VARCHAR(20) AFTER `g_code`;