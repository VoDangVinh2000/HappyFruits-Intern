-- 07/10/2015 - Product type to managing
ALTER TABLE `products` ADD `type` ENUM('size','extra') AFTER `description`;