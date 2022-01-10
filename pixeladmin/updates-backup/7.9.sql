-- 04/11/2017 - Changing type
ALTER TABLE `orders` CHANGE `subtotal` `subtotal` DECIMAL(8,2);
ALTER TABLE `orders` CHANGE `discount` `discount` DECIMAL(8,2);
ALTER TABLE `orders` CHANGE `quantity` `quantity` DECIMAL(5,2);
ALTER TABLE `order_items` CHANGE `quantity` `quantity` DECIMAL(5,2);
ALTER TABLE `order_items` CHANGE `discount` `discount` DECIMAL(8,2);
ALTER TABLE `order_items` CHANGE `total` `total` DECIMAL(8,2);