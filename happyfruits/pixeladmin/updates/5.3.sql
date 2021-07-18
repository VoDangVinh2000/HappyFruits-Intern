-- 23/11/2015 - Promotion price
ALTER TABLE `products` ADD `promotion_price` INT(10) NOT NULL DEFAULT 0 AFTER `base_price`;