-- 15/09/2018 - Update balances
ALTER TABLE `costs` ADD `payment_type` VARCHAR(20) COLLATE utf8_general_ci DEFAULT 'cash' AFTER `amount`;