-- 28/11/2014
DROP TABLE IF EXISTS `order_types`;
CREATE TABLE `order_types` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL,
  `description` TEXT COLLATE utf8_general_ci DEFAULT NULL,
  `price_type` INT(11),
  `need_customer_details` TINYINT(1) NOT NULL DEFAULT '0',
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO `order_types` VALUES('1','Tại chỗ',NULL,'1','0','2014-11-28 17:00:00','2014-11-28 17:00:00','0');
INSERT INTO `order_types` VALUES('2','Mang về',NULL,'2','0','2014-11-28 17:00:00','2014-11-28 17:00:00','0');
INSERT INTO `order_types` VALUES('3','Giao hàng',NULL,'3','1','2014-11-28 17:00:00','2014-11-28 17:00:00','0');

ALTER TABLE `orders` ADD `type_id` INT(11) AFTER `id`;
UPDATE `orders` SET `type_id` = 3;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_name` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL,
  `option_value` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO `settings` VALUES('1','order_items_update_time','0','2014-11-28 22:41:00','2014-11-28 22:41:36');