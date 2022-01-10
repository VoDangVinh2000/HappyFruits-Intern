-- 23/01/2016 -- Sequence number for order types
ALTER TABLE `order_types` ADD `sequence_number` INT(5) AFTER `show_in_statistics`;
UPDATE `order_types` SET `sequence_number` = `id`;
UPDATE `order_types` SET `show_in_statistics` = 0 WHERE `type_name` = 'Foodpanda';