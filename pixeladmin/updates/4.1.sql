-- 07/04/2015 - base price for products
ALTER TABLE `products` ADD `base_price` DECIMAL(8,2) NOT NULL DEFAULT '0' AFTER `unit`;