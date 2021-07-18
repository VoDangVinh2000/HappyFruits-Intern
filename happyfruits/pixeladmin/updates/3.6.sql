-- 03/01/2015 - inventory manager
DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE `warehouses` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(50) NULL,
  `name` VARCHAR(100) NOT NULL DEFAULT '',
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `inventory_item_types`;
CREATE TABLE `inventory_item_types` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_code` VARCHAR(50) NULL,
  `type_name` VARCHAR(100) NOT NULL DEFAULT '',
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `inventory_item_details`;
CREATE TABLE `inventory_item_details` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(50) NULL,
  `name` VARCHAR(100) NOT NULL DEFAULT '',
  `unit` VARCHAR(20) NOT NULL DEFAULT '',
  `quantity_in_details` DECIMAL(8,2) NULL,
  `unit_in_details` VARCHAR(20) NULL,
  `type_id` INT(11) NULL,
  `description` TEXT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `warehouse_id` INT(11) NOT NULL DEFAULT '0',
  `item_id` INT(11) NOT NULL DEFAULT '0',
  `quantity` DECIMAL(8,2) NOT NULL DEFAULT '0',
  `quantity_in_details` DECIMAL(8,2) NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `inventory_import`;
CREATE TABLE `inventory_import` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `import_date` DATETIME NOT NULL,
  `user_id` INT(11) NOT NULL DEFAULT '0',
  `warehouse_id` INT(11) NOT NULL DEFAULT '0',
  `description` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `inventory_import_details`;
CREATE TABLE `inventory_import_details` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `import_id` INT(11) NOT NULL DEFAULT '0',
  `item_id` INT(11) NOT NULL DEFAULT '0',
  `quantity` DECIMAL(8,2) NOT NULL DEFAULT '0',
  `total` DECIMAL(8,2) NOT NULL DEFAULT '0',
  `description` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `inventory_export`;
CREATE TABLE `inventory_export` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `export_date` DATETIME NOT NULL,
  `user_id` INT(11) NOT NULL DEFAULT '0',
  `warehouse_id` INT(11) NOT NULL DEFAULT '0',
  `description` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `inventory_export_details`;
CREATE TABLE `inventory_export_details` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `export_id` INT(11) NOT NULL DEFAULT '0',
  `item_id` INT(11) NOT NULL DEFAULT '0',
  `quantity` DECIMAL(8,2) NOT NULL DEFAULT '0',
  `quantity_in_details`  DECIMAL(8,2) NULL,
  `description` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `warehouses` (`id`, `code`, `name`, `created_dtm`, `modified_dtm`, `deleted`) values('1','KHO1','Kho 1','2015-01-10 18:51:00','2015-01-10 18:51:35','0');
INSERT INTO `warehouses` (`id`, `code`, `name`, `created_dtm`, `modified_dtm`, `deleted`) values('2','KHO2','Kho 2','2015-01-10 18:51:00','2015-01-10 18:52:07','0');

INSERT INTO `inventory_item_types` (`id`, `type_code`, `type_name`, `created_dtm`, `modified_dtm`, `deleted`) values('1','NLPHACHE','Nguyên liệu pha chế','2015-01-10 18:55:00','2015-01-10 18:57:19','0');
INSERT INTO `inventory_item_types` (`id`, `type_code`, `type_name`, `created_dtm`, `modified_dtm`, `deleted`) values('2','VATDUNG','Vật dụng','2015-01-10 18:55:00','2015-01-10 18:57:15','0');
INSERT INTO `inventory_item_types` (`id`, `type_code`, `type_name`, `created_dtm`, `modified_dtm`, `deleted`) values('3','MAYMOC','Máy móc','2015-01-10 18:55:00','2015-01-10 18:58:03','0');
INSERT INTO `inventory_item_types` (`id`, `type_code`, `type_name`, `created_dtm`, `modified_dtm`, `deleted`) values('4','TAKEAWAY','Takeaway','2015-01-10 18:55:00','2015-01-10 18:57:59','0');
INSERT INTO `inventory_item_types` (`id`, `type_code`, `type_name`, `created_dtm`, `modified_dtm`, `deleted`) values('5','DCPHACHE','Dụng cụ pha chế','2015-01-10 18:55:00','2015-01-10 18:58:24','0');
INSERT INTO `inventory_item_types` (`id`, `type_code`, `type_name`, `created_dtm`, `modified_dtm`, `deleted`) values('6','TCTUOI','Trái cây tươi','2015-01-10 18:55:00','2015-01-10 19:00:28','0');
INSERT INTO `inventory_item_types` (`id`, `type_code`, `type_name`, `created_dtm`, `modified_dtm`, `deleted`) values('7','KEM','Kem','2015-01-10 18:55:00','2015-01-10 19:00:01','0');
INSERT INTO `inventory_item_types` (`id`, `type_code`, `type_name`, `created_dtm`, `modified_dtm`, `deleted`) values('8','TCTUOI','Trái cây dự trữ','2015-01-10 18:55:00','2015-01-10 19:00:23','0');
INSERT INTO `inventory_item_types` (`id`, `type_code`, `type_name`, `created_dtm`, `modified_dtm`, `deleted`) values('9','LYTT','Ly thủy tinh','2015-01-10 18:55:00','2015-01-10 19:00:54','0');