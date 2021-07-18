-- 24/10/2019 - payment_method  for orders
ALTER TABLE `orders` ADD `payment_method` varchar(50) NULL AFTER `payment_description`;