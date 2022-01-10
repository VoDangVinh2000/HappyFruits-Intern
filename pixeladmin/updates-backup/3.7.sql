-- 05/02/2015 - lock customer lat/lng
ALTER TABLE `customers` ADD `is_locked` TINYINT(1) DEFAULT 0 AFTER `total_paid`;