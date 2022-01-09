-- 01/01/2016 -- Announcements table
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `content` TEXT NULL,
  `content_en` TEXT NULL,
  `image` VARCHAR(255),
  `start_dtm` DATETIME NULL,
  `end_dtm` DATETIME NULL,
  `enabled` TINYINT(1) NOT NULL DEFAULT '1',
  `temporary_close` TINYINT(1) NOT NULL DEFAULT '0',
  `created_by` INT(11) NOT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Changing sequence_number to decimal
ALTER TABLE `categories` CHANGE `sequence_number` `sequence_number` DECIMAL(5,1);
ALTER TABLE `products` CHANGE `sequence_number` `sequence_number` DECIMAL(5,1);