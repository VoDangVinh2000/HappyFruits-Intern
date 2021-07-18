-- 10/05/2020 - Adding fruit box products
ALTER TABLE `products` ADD `is_box` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_additional`;
ALTER TABLE `products` ADD `can_be_added_to_box` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_box`;
ALTER TABLE `products` ADD `box_discount_rate` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Percentage' AFTER `is_box`;

CREATE TABLE IF NOT EXISTS `products_in_boxes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `box_id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

INSERT INTO `categories` (`category_id`, `parent_id`, `code`, `sequence_number`, `name`, `name_without_utf8`, `english_name`, `image`, `allow_delivery`, `enabled`, `description`, `created_dtm`, `modified_dtm`, `deleted`) VALUES
(19, 1, 'HTC', '10.0', 'Hộp trái cây', 'Hop trai cay', 'Fruit Box', '', 1, 1, '', '2020-05-10 15:30:43', '2020-05-10 08:31:04', 0);

CREATE TABLE IF NOT EXISTS `order_box_items` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_item_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `unit` varchar(20) NULL,
  `quantity` decimal(5,2) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0',
  `discount_rate` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Percentage',
  `total` decimal(8,2) DEFAULT NULL,
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `order_items` ADD `custom` TEXT NULL AFTER `description`;