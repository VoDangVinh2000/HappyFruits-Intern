-- 29/08/2015 - Many changes
ALTER TABLE `orders` ADD `delivery_date` DATETIME NULL DEFAULT NULL AFTER `modified_dtm`;
UPDATE `orders` SET `VAT` = 0.1 WHERE `VAT` = 1;
UPDATE `orders` SET `delivery_date` = `created_dtm`;

ALTER TABLE `order_types` ADD `show_in_statistics` TINYINT(1) NOT NULL DEFAULT '1' AFTER `can_prepaid`;
UPDATE `order_types` SET `show_in_statistics` = 0 WHERE `id` IN(5,6,7);

ALTER TABLE `assessment` CHANGE `overtime` `overtime` VARCHAR(5) NOT NULL DEFAULT '0';
ALTER TABLE `assessment` CHANGE `kpi` `kpi` DECIMAL(4,1) NOT NULL DEFAULT '0';