-- 25/12/2014 - Fixing type of 'total' in orders table
ALTER TABLE `orders` CHANGE `total` `total` DECIMAL(8,2);