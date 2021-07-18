-- 02/07/2014
DROP TABLE IF EXISTS `shipping_details`;
CREATE TABLE `shipping_details` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `customer_id` INT(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `distance` varchar(4) COLLATE utf8_general_ci DEFAULT NULL,
  `total` INT(10) NOT NULL DEFAULT '0',
  `description` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL,
  `created_by` INT(11) NOT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` DATETIME NOT NULL,
  `ip_address` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;