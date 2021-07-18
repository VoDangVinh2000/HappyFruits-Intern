ALTER TABLE `assessment` ADD `parking_fee` INT(3) NOT NULL DEFAULT 0;
ALTER TABLE `assessment` ADD `has_allowance` TINYINT(1) NOT NULL DEFAULT 0;

ALTER TABLE `users` ADD `parking_fee` INT(3) NOT NULL DEFAULT 0 AFTER `rate_per_hour`;
ALTER TABLE `users` ADD `is_fulltime` TINYINT(1) NOT NULL DEFAULT 0 AFTER `parking_fee`;
ALTER TABLE `users` ADD `need_deposit` TINYINT(1) NOT NULL DEFAULT 0 AFTER `is_fulltime`;
ALTER TABLE `users` ADD `hours_deposit` INT(3) NOT NULL DEFAULT 0 AFTER `need_deposit`;
ALTER TABLE `users` ADD `salary_per_month` INT(11) NOT NULL DEFAULT 0 AFTER `hours_deposit`;

insert into `settings` (`option_name`, `option_value`, `name`, `is_hide`, `created_dtm`, `modified_dtm`) values('working_days_in_months','26','Ngày làm việc trong tháng','0','2017-04-08 23:47:56','2017-04-08 23:47:56');

ALTER TABLE `shipping_details` ADD `branch_id` INT(11) NOT NULL DEFAULT 1 AFTER `order_id`;
UPDATE `shipping_details`
INNER JOIN `orders` ON `orders`.`id` = `shipping_details`.`order_id`
SET `shipping_details`.`branch_id` = `orders`.`branch_id`;
