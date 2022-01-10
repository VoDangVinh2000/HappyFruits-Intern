-- 01/12/2014
DROP TABLE IF EXISTS `shipping_fees`;
CREATE TABLE `shipping_fees` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL,
  `fee` TEXT COLLATE utf8_general_ci DEFAULT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `shipping_fees` (`id`, `description`, `fee`, `created_dtm`, `modified_dtm`) VALUES('1','Giá giao hàng của eFruit','{\"10\":{\"min\":50,\"fee\":5,\"free_ship\":80},\"1\":{\"min\":60,\"fee\":10,\"free_ship\":100},\"3\":{\"min\":60,\"fee\":10,\"free_ship\":100},\"11\":{\"min\":60,\"fee\":10,\"free_ship\":100},\"5\":{\"min\":80,\"fee\":10,\"free_ship\":140},\"Ph\\u00fa Nhu\\u1eadn\":{\"min\":80,\"fee\":10,\"free_ship\":140},\"T\\u00e2n B\\u00ecnh\":{\"min\":80,\"fee\":10,\"free_ship\":140},\"4\":{\"min\":150,\"fee\":10,\"free_ship\":220},\"6\":{\"min\":150,\"fee\":10,\"free_ship\":220},\"8\":{\"min\":150,\"fee\":10,\"free_ship\":220},\"T\\u00e2n Ph\\u00fa\":{\"min\":150,\"fee\":10,\"free_ship\":220},\"2\":{\"min\":250,\"fee\":10,\"free_ship\":400},\"7\":{\"min\":250,\"fee\":10,\"free_ship\":400},\"12\":{\"min\":250,\"fee\":10,\"free_ship\":400},\"B\\u00ecnh T\\u00e2n\":{\"min\":250,\"fee\":10,\"free_ship\":400},\"B\\u00ecnh Th\\u1ea1nh\":{\"min\":250,\"fee\":10,\"free_ship\":400},\"G\\u00f2 V\\u1ea5p\":{\"min\":250,\"fee\":10,\"free_ship\":400}}','2014-12-01 15:03:49','2014-12-01 15:03:49');
INSERT INTO `shipping_fees` (`id`, `description`, `fee`, `created_dtm`, `modified_dtm`) VALUES('2','Giá giao hàng của cho các dịch vụ khác','{\"10\":{\"min\":80,\"fee\":10,\"free_ship\":120},\"1\":{\"min\":100,\"fee\":10,\"free_ship\":180},\"3\":{\"min\":80,\"fee\":10,\"free_ship\":150},\"11\":{\"min\":100,\"fee\":10,\"free_ship\":180},\"5\":{\"min\":100,\"fee\":10,\"free_ship\":180},\"Ph\\u00fa Nhu\\u1eadn\":{\"min\":120,\"fee\":20,\"free_ship\":200},\"T\\u00e2n B\\u00ecnh\":{\"min\":120,\"fee\":20,\"free_ship\":250},\"4\":{\"min\":150,\"fee\":20,\"free_ship\":250},\"6\":{\"min\":150,\"fee\":20,\"free_ship\":250},\"8\":{\"min\":120,\"fee\":20,\"free_ship\":200},\"T\\u00e2n Ph\\u00fa\":{\"min\":150,\"fee\":10,\"free_ship\":220},\"2\":{\"min\":250,\"fee\":10,\"free_ship\":400},\"7\":{\"min\":250,\"fee\":10,\"free_ship\":400},\"12\":{\"min\":250,\"fee\":10,\"free_ship\":400},\"B\\u00ecnh T\\u00e2n\":{\"min\":250,\"fee\":10,\"free_ship\":400},\"B\\u00ecnh Th\\u1ea1nh\":{\"min\":250,\"fee\":10,\"free_ship\":400},\"G\\u00f2 V\\u1ea5p\":{\"min\":250,\"fee\":10,\"free_ship\":400}}','2014-12-01 15:03:49','2014-12-01 15:03:49');

ALTER TABLE `order_types` ADD `shipping_type` INT(11) AFTER `price_type`;
UPDATE `order_types` SET `shipping_type` = 1;