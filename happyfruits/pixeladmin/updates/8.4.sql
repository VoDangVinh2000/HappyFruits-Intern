-- 19/06/2018 - Category for inventory item
CREATE TABLE `inventory_item_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL DEFAULT '',
  `is_fruit` tinyint(1) NOT NULL DEFAULT '0',
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert  into `inventory_item_categories`(`id`,`category_name`,`is_fruit`,`created_dtm`,`modified_dtm`,`deleted`) values (1,'Loại 1',1,'2018-06-19 22:28:14','2018-06-19 22:28:14',0);
insert  into `inventory_item_categories`(`id`,`category_name`,`is_fruit`,`created_dtm`,`modified_dtm`,`deleted`) values (2,'Loại 2',1,'2018-06-19 22:28:29','2018-06-19 22:28:29',0);
insert  into `inventory_item_categories`(`id`,`category_name`,`is_fruit`,`created_dtm`,`modified_dtm`,`deleted`) values (3,'Loại dạt',1,'2018-06-19 22:28:51','2018-06-19 22:28:51',0);
insert  into `inventory_item_categories`(`id`,`category_name`,`is_fruit`,`created_dtm`,`modified_dtm`,`deleted`) values (4,'Loại đặc biệt',1,'2018-06-19 22:29:02','2018-06-19 22:29:02',0);

ALTER TABLE `inventory_item_details` ADD `category_id` INT(11) NULL AFTER `type_id`;
ALTER TABLE `inventory_import` ADD `payment_status` ENUM('pending','paid_by_cash','paid_via_bank') DEFAULT 'pending' AFTER `total`;
ALTER TABLE `inventory_import` ADD `cashier_id` INT(11) NULL AFTER `payment_status`;

-- 06/07/2018 - Costs and debts management
DROP TABLE IF EXISTS `debt_types`;
CREATE TABLE `debt_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL ,
  `description` text,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `debts`;
CREATE TABLE `debts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL ,
  `type_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `description` text,
  `user_id` int(11) NULL,
  `payment_date` datetime NOT NULL,
  `status` enum('pending','paid','period') DEFAULT 'pending',
  `created_by` int(11) NOT NULL,
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cost_types`;
CREATE TABLE `cost_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL ,
  `description` text,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `costs`;
CREATE TABLE `costs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL ,
  `type_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `description` text,
  `user_id` int(11) NULL,
  `debt_id` int(11) NULL,
  `created_by` int(11) NOT NULL,
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;