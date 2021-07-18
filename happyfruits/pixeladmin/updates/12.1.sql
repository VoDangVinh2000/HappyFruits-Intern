-- 12/12/2019 - Shipping fees
TRUNCATE `efruit_db`.`shipping_fees`;
ALTER TABLE `shipping_fees` ADD `district` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `id`;
ALTER TABLE `shipping_fees` CHANGE `description` `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `fee`;
ALTER TABLE `shipping_fees` ADD `min_total` INT NOT NULL DEFAULT '0' AFTER `district`;
ALTER TABLE `shipping_fees` CHANGE `fee` `fee` INT NULL DEFAULT '0';
