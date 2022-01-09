-- 11/10/2018 - More information for providers
ALTER TABLE `providers` ADD `provider_type` INT(11) NULL DEFAULT 1 COMMENT '1 is Nha vuon, 2 is Cong ty, 3 is Thuong lai' AFTER `provider_address` ;
ALTER TABLE `providers` ADD `company_name` VARCHAR(255) NULL AFTER `bank_account_number`;
ALTER TABLE `providers` ADD `company_tax_code` VARCHAR(255) NULL AFTER `company_name`;
ALTER TABLE `providers` ADD `company_address` VARCHAR(255) NULL AFTER `company_tax_code`;
ALTER TABLE `providers` ADD `VAT_rate` INT(3) NULL COMMENT 'In percentage 5, 10, 15,..' AFTER `company_tax_code`;

ALTER TABLE `inventory_import` ADD `has_invoice` TINYINT(1) NOT NULL DEFAULT '0' AFTER `total`;

UPDATE `providers` SET `type` = 0 WHERE `type` = 'Trái cây';
UPDATE `providers` SET `type` = 2 WHERE `type` = 'Vật dụng';
ALTER TABLE `providers` CHANGE `type` `type` INT(10) NOT NULL DEFAULT 0 COMMENT '0 is Trai cay, 99 is Khac';

UPDATE `inventory_item_types` SET `type_name` = 'Vật dụng khác' WHERE `inventory_item_types`.`id` = 2;
UPDATE `inventory_item_types` SET `type_name` = 'Máy móc trang thiết bị' WHERE `inventory_item_types`.`id` = 3;
UPDATE `inventory_item_types` SET `type_name` = 'Vật dụng Takeaway' WHERE `inventory_item_types`.`id` = 4;
UPDATE `inventory_item_types` SET `type_name` = 'Dụng cụ, vật dụng pha chế' WHERE `inventory_item_types`.`id` = 5;
UPDATE `inventory_item_types` SET `type_name` = 'Vật dụng thủy tinh, nhựa khác' WHERE `inventory_item_types`.`id` = 9;
INSERT INTO `inventory_item_types` (`id`, `type_code`, `type_name`, `is_fruit`, `created_dtm`, `modified_dtm`, `deleted`) VALUES (NULL, 'ANVAT', 'Kho hàng Ăn vặt', '0', NOW(), CURRENT_TIMESTAMP, '0')