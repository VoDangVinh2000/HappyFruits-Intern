-- 07/10/2015 - English name for tags
ALTER TABLE `tags` ADD `english_name` VARCHAR(255) AFTER `tag_name`;
ALTER TABLE `products` CHANGE `type` `type` ENUM('size','extra','topping') AFTER `description`;