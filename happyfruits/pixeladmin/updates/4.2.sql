-- 09/05/2015 - bugs fixed and add is_paid field for order_types
UPDATE customers SET type_id = 1 WHERE ISNULL(type_id);
ALTER TABLE `order_types` ADD `can_prepaid` TINYINT(1) NOT NULL DEFAULT '0' AFTER `need_customer_details`;
ALTER TABLE `orders` ADD `is_prepaid` TINYINT(1) NOT NULL DEFAULT '0';
