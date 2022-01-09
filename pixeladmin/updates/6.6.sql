-- 06/05/2016 -- Settings
ALTER TABLE `settings` ADD `name` VARCHAR(255) NULL AFTER `option_value`;
ALTER TABLE `settings` ADD `is_hide`TINYINT(1) NOT NULL DEFAULT '0' AFTER `name`;

insert into `settings` (`option_name`, `option_value`, `name`, `is_hide`, `created_dtm`, `modified_dtm`) values('pebooking_discount','0.05','Ưu đãi đặt trước','0','2016-05-06 22:10:24','2016-05-06 23:20:40');
UPDATE `settings` SET `is_hide` = 1 WHERE `option_name` = 'db_version';