-- 17/12/2014 - English name for products
ALTER TABLE `categories` ADD `english_name` VARCHAR(255) AFTER `name_without_utf8`;
UPDATE `categories` SET `english_name` = `name`;
ALTER TABLE `products` ADD `english_name` VARCHAR(255) AFTER `name_without_utf8`;
UPDATE `products` SET `english_name` = `name`;