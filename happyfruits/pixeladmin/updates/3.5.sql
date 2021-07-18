-- 30/12/2014 - Adding is_hidden field for products table
ALTER TABLE `products` ADD `is_hidden` TINYINT(1) NOT NULL DEFAULT '0' AFTER `enabled`;
UPDATE `products` SET `is_hidden` = `deleted`;
UPDATE `products` SET `deleted` = '0';