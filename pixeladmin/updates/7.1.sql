-- 16/03/2017 -- Managing branches
CREATE TABLE `branches` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) NOT NULL,
  `branch_address` varchar(255) NOT NULL,
  `lat` decimal(10,6) NOT NULL,
  `lng` decimal(10,5) NOT NULL,
  `created_dtm` datetime NOT NULL,
  `modified_dtm` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO branches VALUE(1, "Cửa hàng chính", "839/3 Lê Hồng Phong, P12, Q10", 10.773170, 106.67138, NOW(),NOW(),1,0);

-- Order statuses
ALTER TABLE `orders` CHANGE `status` `status` ENUM('Pending','In Process','Shipping','On Hold','Completed','Failed') NOT NULL DEFAULT 'Pending';

ALTER TABLE `orders` ADD `branch_id` INT(11) NOT NULL DEFAULT 1 AFTER `id`;
ALTER TABLE `users` ADD `branch_id` INT(11) NOT NULL DEFAULT 1 AFTER `user_id`;
ALTER TABLE `vouchers` ADD `branch_id` INT(11) NOT NULL DEFAULT 1 AFTER `id`;
ALTER TABLE `warehouses` ADD `branch_id` INT(11) NOT NULL DEFAULT 1 AFTER `id`;

ALTER TABLE `orders` ADD `shipper_id` INT(11) NULL AFTER `shipping_info`;
ALTER TABLE `orders` ADD `hide_on_management_screen` TINYINT(1) DEFAULT 0 AFTER `promotion_code`;
