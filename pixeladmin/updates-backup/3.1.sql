-- 14/12/2014
ALTER TABLE `categories` ADD `sequence_number` INT(5) AFTER `code`;
UPDATE `categories` SET `sequence_number` = `category_id`;
ALTER TABLE `products` ADD `sequence_number` INT(5) AFTER `code`;
UPDATE `products` SET `sequence_number` = `product_id`;