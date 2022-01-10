-- 21/12/2019 - Adding warehouse_id to inventory_item_details to classify the inventory item
ALTER TABLE `inventory_item_details` ADD `warehouse_id` INT(11) NOT NULL DEFAULT '1' AFTER `category_id`;
DELETE FROM `inventory` WHERE warehouse_id = 2;
UPDATE `inventory_item_details` SET warehouse_id = 2 WHERE `code` like '%SC'