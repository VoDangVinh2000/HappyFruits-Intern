-- 07/11/2019 - Adding fields for assessment table
ALTER TABLE `assessment` ADD `violated_rule` VARCHAR(255) NULL AFTER `rules_violation`;
ALTER TABLE `assessment` ADD `self_criticism` TINYINT(1) NULL AFTER `violated_rule`;
ALTER TABLE `assessment` ADD `disconcentrated` VARCHAR(255) NULL AFTER `concentration`;
ALTER TABLE `assessment` CHANGE `minutes_late` `minutes_late` DECIMAL(8,2) NULL;