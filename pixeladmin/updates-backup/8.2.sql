-- 01/05/2018 - eFruit team's note for orders
ALTER TABLE `orders` ADD `efruit_note` TEXT NULL AFTER `description`;

UPDATE `providers` SET `type` = 'Trái cây';

ALTER TABLE `inventory_item_details` ADD `required_quantity` INT(6) NULL AFTER `warning_quanity`;

ALTER TABLE `customers` ADD `last_order_dtm` DATETIME NULL AFTER `modified_by`;
UPDATE `customers` SET `last_order_dtm` = (SELECT MAX(`orders`.`delivery_date`) FROM `orders` WHERE `orders`.`customer_id` = `customers`.`customer_id` AND `orders`.`deleted` = 0 AND `orders`.`status` = 'Completed');

ALTER TABLE `customers` ADD INDEX `last_order_dtm` (`last_order_dtm`);
ALTER TABLE `orders` ADD INDEX `delivery_date` (`delivery_date`);

ALTER TABLE `customers` ADD `last_note` TEXT NULL AFTER `last_order_dtm`;