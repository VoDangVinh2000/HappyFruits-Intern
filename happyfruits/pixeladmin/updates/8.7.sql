-- 12/07/2018 - Foody orders
INSERT INTO `customer_types` (`type_id`, `long_name`, `short_name`, `description`, `deleted`, `created_dtm`, `modified_dtm`) VALUES
(7, 'Foody', 'FD', NULL, 0, '0000-00-00 00:00:00', '2018-07-11 17:40:30');

ALTER TABLE `orders` ADD `unique_key` VARCHAR(32) NULL;
ALTER TABLE `orders` ADD `extra` TEXT NULL;