-- 12/02/2015 - vouchers manager
DROP TABLE IF EXISTS `vouchers`;
CREATE TABLE `vouchers` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` ENUM('receipt','payment') DEFAULT 'receipt',
  `date_time` DATE NOT NULL,
  `amount` INT(10) NOT NULL DEFAULT '0',
  `description` TEXT NULL,
  `user_id` INT(11) NOT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `shipping_details` ADD `order_id` INT(10) NULL AFTER `customer_id`;