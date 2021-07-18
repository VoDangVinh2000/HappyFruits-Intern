-- 04/11/2017 - minutes late
ALTER TABLE `assessment` ADD `minutes_late` DECIMAL(8,2) NOT NULL DEFAULT 0 AFTER `is_late`;