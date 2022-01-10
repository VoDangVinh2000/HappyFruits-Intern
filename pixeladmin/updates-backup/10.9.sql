-- 20/09/2019 - pickup_time for orders
ALTER TABLE `orders` ADD `pickup_time` DATETIME NULL DEFAULT NULL AFTER `delivery_date`;