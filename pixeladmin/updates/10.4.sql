-- 05/07/2019 - Adding exchange_points for customers
ALTER TABLE `customers` ADD `exchange_points` INT(11) NULL DEFAULT 0 AFTER `free_ship`;