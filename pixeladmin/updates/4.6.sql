-- 02/06/2015 - Pages manager
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_code` varchar(100) NOT NULL DEFAULT '' COMMENT 'used to identify the page in the url',
  `page_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'the name of the page',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `page_order` int(11) NOT NULL DEFAULT '0',
  `page_body` text NULL,
  `page_template` varchar(255) NOT NULL DEFAULT '',
  `meta_robots` varchar(50) NOT NULL DEFAULT 'index,follow',
  `extra_data` TEXT NOT NULL,
  `created_by` INT(11) NOT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;