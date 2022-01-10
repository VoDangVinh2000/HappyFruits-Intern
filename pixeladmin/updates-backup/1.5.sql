-- 12/09/2014
CREATE TABLE `customer_types` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `long_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
insert  into `customer_types`(`type_id`,`long_name`,`short_name`,`description`,`deleted`) values (1,'eFruit','eF',NULL,0),(2,'Foodpanda','FP',NULL,0),(3,'VietnamMM','VMM',NULL,0),(4,'Hotmeal','HM',NULL,0),(5,'Chọn Món','CM',NULL,0),(6,'Eat.vn','EAT',NULL,0);

ALTER TABLE `customers` ADD `type_id` INT(11) AFTER `description`;