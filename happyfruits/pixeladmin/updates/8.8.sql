-- 19/07/2018 - Import details - shipping fee
ALTER TABLE `inventory_import` ADD `shipping_fee` INT(11) NOT NULL DEFAULT 0 AFTER `capital`;