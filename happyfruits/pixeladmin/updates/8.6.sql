-- 09/07/2018 - Costs/debts table
ALTER TABLE `costs` ADD `import_id` int(11) NULL AFTER `debt_id`;
ALTER TABLE `debts` ADD `import_id` int(11) NULL AFTER `user_id`;
ALTER TABLE `costs` CHANGE `amount` `amount` int(11) NULL AFTER `debt_id`;
ALTER TABLE `debts` CHANGE `amount` `amount` int(11) NULL AFTER `user_id`;
ALTER TABLE `inventory_import` ADD `payment_date` datetime NULL AFTER `payment_status`;