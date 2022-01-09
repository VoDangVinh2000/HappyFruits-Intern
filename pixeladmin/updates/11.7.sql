-- 15/11/2019 - Product components and out of stock feature
ALTER TABLE `product_components` ADD `active` TINYINT(1) NOT NULL DEFAULT 0 AFTER `amount`;
ALTER TABLE `product_components` ADD `important` TINYINT(1) NOT NULL DEFAULT 0 AFTER `active`;
ALTER TABLE `inventory_item_details` ADD `out_of_stock` TINYINT(1) NOT NULL DEFAULT 0;
