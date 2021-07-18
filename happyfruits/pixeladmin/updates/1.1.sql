-- 18/06/2014
ALTER TABLE `customers` ADD `lat` DECIMAL(10,6) NULL AFTER `mobile`;
ALTER TABLE `customers` ADD `lng` DECIMAL(10,6) NULL AFTER `lat`;
ALTER TABLE `customers` ADD `deleted` TINYINT(1) NOT NULL DEFAULT 0;
ALTER TABLE `customers` ADD `description` VARCHAR(255) NULL AFTER `distance`;
