-- 15/06/2016 -- Promotion code
DROP TABLE IF EXISTS `promotion_codes`;
CREATE TABLE `promotion_codes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `code` VARCHAR(5) NOT NULL,
  `discount` DECIMAL(3,2) NOT NULL,
  `description` VARCHAR(255) NULL,
  `created_by` INT(11) NOT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `orders` ADD `promotion_code` VARCHAR(5) NULL;
ALTER TABLE `orders` ADD INDEX `code` (`code`);
ALTER TABLE `orders` ADD INDEX `promotion_code` (`promotion_code`);

ALTER TABLE `customers` ADD INDEX `district` (`district`);
ALTER TABLE `customers` ADD INDEX `customer_name` (`customer_name`);
ALTER TABLE `customers` ADD INDEX `address` (`address`);
ALTER TABLE `customers` ADD INDEX `mobile` (`mobile`);