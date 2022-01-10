UPDATE `inventory_item_details` SET `default_price` = `default_price`*1000 WHERE `default_price` < 100;
ALTER TABLE `inventory_item_details` CHANGE `default_price` `default_price` INT(8);
ALTER TABLE `inventory_item_details` CHANGE `quantity_in_details` `quantity_in_details` INT(6);
ALTER TABLE `inventory_item_details` ADD `enabled` TINYINT(1) NOT NULL DEFAULT '1';
ALTER TABLE `inventory_item_details` ADD `warning_quanity` INT(3) NOT NULL DEFAULT '3' AFTER `default_price`;

ALTER TABLE `inventory_import_details` CHANGE `price` `price` INT(8) NOT NULL DEFAULT '0';
ALTER TABLE `inventory_import_details` CHANGE `total` `total` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `inventory_import_details` ADD `provider_id` INT(11) NULL AFTER `total`;

DELETE FROM `inventory_item_types` WHERE `id` = 8;

UPDATE `warehouses` SET `code` = 'KHOLHP', `name` = 'Kho Lê Hồng Phong' WHERE `id` = 1;
UPDATE `warehouses` SET `code` = 'KHOHTC', `name` = 'Kho Huỳnh Tịnh Của' WHERE `id` = 2;

ALTER TABLE `inventory_export` ADD `to_warehouse_id` INT(11) NOT NULL DEFAULT '0' AFTER `warehouse_id`;
ALTER TABLE `inventory_export` ADD `is_fruit` TINYINT(1) NOT NULL DEFAULT '0' AFTER `to_warehouse_id`;

ALTER TABLE `inventory_import` ADD `capital` INT(11) NOT NULL DEFAULT '0' AFTER `warehouse_id`;
ALTER TABLE `inventory_import` ADD `total` INT(11) NOT NULL DEFAULT '0' AFTER `capital`;
ALTER TABLE `inventory_import` ADD `is_fruit` TINYINT(1) NOT NULL DEFAULT '0' AFTER `total`;

ALTER TABLE `inventory_item_types` ADD `is_fruit` TINYINT(1) NOT NULL DEFAULT '0' AFTER `type_name`;
UPDATE `inventory_item_types` SET `type_code` = 'TC_DAM', `type_name` = 'Trái cây dầm / hộp + Sinh tố', `is_fruit` = 1 WHERE `id` = 6;
INSERT INTO `inventory_item_types`(`type_code`,`type_name`,`is_fruit`,`created_dtm`) 
VALUES ('TC_HOP', 'Trái cây hộp', 1, '2017-04-23 16:17:00'),('TC_EP', 'Trái cây ép', 1, '2017-04-23 16:17:00');

DROP TABLE IF EXISTS `providers`;
CREATE TABLE `providers` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `provider_name` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL,
  `provider_address` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL,
  `mobile` VARCHAR(50) NOT NULL,
  `email` VARCHAR(255) NULL,
  `lat` DECIMAL(10,6) NOT NULL,
  `lng` DECIMAL(10,5) NOT NULL,
  `description` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL,
  `type` VARCHAR(50) NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` DATETIME NOT NULL,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;