-- 28/10/2018 - More optional for product
ALTER TABLE `products` ADD `free_choice` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_hidden`;