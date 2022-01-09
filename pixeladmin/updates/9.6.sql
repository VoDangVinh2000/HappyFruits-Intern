-- 15/09/2018 - Update cost from debt
ALTER TABLE `debts` ADD `payment_type` VARCHAR(20) COLLATE utf8_general_ci DEFAULT 'cash' AFTER `order_id`;
ALTER TABLE `debts` ADD `paid_amount` INT(11) DEFAULT NULL AFTER `payment_date`;