-- 24/07/2018 - Paid date for order and company info for customer
ALTER TABLE `orders` ADD `payment_date` datetime NULL AFTER `delivery_date`;
ALTER TABLE `orders` ADD `payment_description` TEXT NULL AFTER `payment_date`;

DROP TABLE IF EXISTS `debt_types`;

INSERT INTO `cost_types` (`id`, `name`, `description`, `is_public`, `created_dtm`, `modified_dtm`) VALUES
(8, 'Khách hàng', NULL, 0, '2018-07-25 00:00:00', '2018-07-25 00:00:00');

ALTER TABLE `debts` ADD `order_id` int(11) NULL AFTER `import_id`;