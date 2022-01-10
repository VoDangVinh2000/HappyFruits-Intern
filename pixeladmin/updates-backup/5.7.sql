-- 14/01/2016 -- Allow to not sell products for delivery event it's in deliverable category
ALTER TABLE `products` ADD `not_deliver` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_additional`;