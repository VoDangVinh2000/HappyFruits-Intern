-- 21/09/2014
ALTER TABLE `users` CHANGE `modified_dtm` `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
ALTER TABLE `shipping_details` CHANGE `modified_dtm` `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
ALTER TABLE `customers` CHANGE `modified_dtm` `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
ALTER TABLE `assessment` CHANGE `modified_dtm` `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

UPDATE `assessment` SET `work_process` = 'good' WHERE `work_process` = 'normal';
ALTER TABLE `assessment` CHANGE `work_process` `work_process` ENUM('good','bad');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` INT(11) NOT NULL DEFAULT '0',
  `code` VARCHAR(20) NOT NULL DEFAULT '',
  `name` VARCHAR(255) NOT NULL DEFAULT '',
  `name_without_utf8` VARCHAR(255) NOT NULL DEFAULT '',
  `enabled` TINYINT(1) NOT NULL DEFAULT '1',
  `description` TEXT COLLATE utf8_general_ci DEFAULT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` INT(11) NOT NULL DEFAULT '0',
  `code` VARCHAR(20) NOT NULL DEFAULT '',
  `name` VARCHAR(255) NOT NULL DEFAULT '',
  `name_without_utf8` VARCHAR(255) NOT NULL DEFAULT '',
  `enabled` TINYINT(1) NOT NULL DEFAULT '1',
  `description` TEXT COLLATE utf8_general_ci DEFAULT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 22/09/2014
ALTER TABLE `customer_types` ADD `created_dtm` DATETIME NOT NULL;
ALTER TABLE `customer_types` ADD `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
ALTER TABLE `user_types` ADD `created_dtm` DATETIME NOT NULL;
ALTER TABLE `user_types` ADD `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

DROP TABLE IF EXISTS `price_types`;
CREATE TABLE `price_types` (
  `type_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` VARCHAR(20) NOT NULL DEFAULT '',
  `description` VARCHAR(255) NOT NULL DEFAULT '',
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `prices`;
CREATE TABLE `prices` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_id` INT(11) NOT NULL DEFAULT '0',
  `product_id` INT(11) NOT NULL DEFAULT '0',
  `price` INT(10) NOT NULL DEFAULT '0',
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 23/09/2014
ALTER TABLE `customers` ADD `email` VARCHAR(255) NULL AFTER `mobile`;
ALTER TABLE `categories` ADD `allow_delivery` TINYINT(1) NOT NULL DEFAULT '1' AFTER `name_without_utf8`;
ALTER TABLE `products` ADD `unit` VARCHAR(20) NULL AFTER `name_without_utf8`;

-- 24/09/2014
ALTER TABLE `assessment` ADD `kpi` INT(5) NOT NULL DEFAULT '10' AFTER `description`;

-- 26/09/2014
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` INT(11) NOT NULL DEFAULT '0',
  `subtotal` INT(5) NOT NULL DEFAULT '0',
  `shipping_fee` INT(5) NOT NULL DEFAULT '0',
  `discount` DECIMAL(5,2) NOT NULL DEFAULT '0',
  `quantity` INT(5) NOT NULL DEFAULT '0',
  `total` INT(5) NOT NULL DEFAULT '0',
  `description` TEXT COLLATE utf8_general_ci DEFAULT NULL,
  `code` VARCHAR(20) NOT NULL DEFAULT '',
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` INT(11) NOT NULL DEFAULT '0',
  `product_id` INT(11) NOT NULL DEFAULT '0',
  `quantity` INT(5) NOT NULL DEFAULT '0',
  `price` INT(5) NOT NULL DEFAULT '0',
  `discount` DECIMAL(5,2) NOT NULL DEFAULT '0',
  `total` INT(5) NOT NULL DEFAULT '0',
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `customers` CHANGE `total_paid` `total_paid` INT(11) NOT NULL DEFAULT '0';

DROP TABLE IF EXISTS `price_types`;
CREATE TABLE `price_types` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
insert  into `price_types`(`type_id`,`type_name`,`description`,`created_dtm`,`modified_dtm`,`deleted`) values (1,'Giá thường','','2014-09-22 21:57:00','2014-09-22 21:57:34',0),(2,'Giá mang về','','2014-09-22 21:57:00','2014-09-22 21:58:00',0),(3,'Giá giao hàng','','2014-09-23 10:00:00','2014-09-23 10:00:47',0);
