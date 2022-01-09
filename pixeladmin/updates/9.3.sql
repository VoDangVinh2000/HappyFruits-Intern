-- 12/09/2018 - Order quantity field type change
ALTER TABLE `orders` CHANGE `quantity` `quantity` DECIMAL(8,2) NULL DEFAULT NULL;