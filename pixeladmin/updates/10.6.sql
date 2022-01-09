-- 05/08/2019 - Creating product components table
CREATE TABLE `product_components` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `item_id` int(11) unsigned NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT '0',
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;