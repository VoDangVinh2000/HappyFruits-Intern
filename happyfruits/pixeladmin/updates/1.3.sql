-- 01/09/2014
ALTER TABLE `assessment` CHANGE `work_process` `work_process` ENUM('good','normal','bad') NOT NULL DEFAULT 'normal';
ALTER TABLE `assessment` DROP `jobs_completed`;
ALTER TABLE `assessment` CHANGE `late` `being_prompted` TINYINT(1) NOT NULL DEFAULT '0' AFTER `rules_violation`;
ALTER TABLE `assessment` ADD `assiduousness` ENUM('work_late','finish_soon','off_w_permission','off_wt_permission') AFTER `breaking_things`;
ALTER TABLE `shipping_details` ADD `number_of_dishes` INT(10) AFTER `distance`;
ALTER TABLE `customers` ADD `district` VARCHAR(100) AFTER `address`;
ALTER TABLE `customers` CHANGE `mobile` `mobile` VARCHAR(20);
ALTER TABLE `customers` ADD `modified_by` INT(11) AFTER `modified_dtm`;