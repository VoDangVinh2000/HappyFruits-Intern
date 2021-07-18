-- 04/03/2015 - prices
ALTER TABLE `inventory_item_details` ADD `default_price` DECIMAL(8,2) NOT NULL DEFAULT '0' AFTER `unit`;
ALTER TABLE `inventory_import_details` ADD `price` DECIMAL(8,2) NOT NULL DEFAULT '0' AFTER `quantity`;