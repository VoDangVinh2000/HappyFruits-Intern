-- 09/06/2014
ALTER TABLE `assessment` CHANGE `shift` `working_time` INT(10) NOT NULL DEFAULT 0;
ALTER TABLE `assessment` CHANGE `late` `late` TINYINT(1) NOT NULL DEFAULT 0;
ALTER TABLE `assessment` ADD `assessment_date` DATE NOT NULL AFTER `user_id`;