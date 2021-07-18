-- 27/03/2015 - assign additional products
ALTER TABLE `products` ADD `is_additional` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_hidden`;
UPDATE `products` SET `is_additional` = 1 WHERE belongs_to IS NOT NULL AND belongs_to <> '';