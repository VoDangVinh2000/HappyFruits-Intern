-- 26/11/2017 - More order status
ALTER TABLE `orders` CHANGE `status` `status` ENUM('Pending', 'Wait for Staff Confirm', 'In Process', 'Wait for Shipping', 'Process Completed', 'Shipping', 'Completed', 'On Hold','Failed') NOT NULL DEFAULT 'Pending';
UPDATE `orders` SET `status` = 'Process Completed' WHERE `status` = 'Wait for Shipping';
ALTER TABLE `orders` CHANGE `status` `status` ENUM('Pending', 'Wait for Staff Confirm', 'In Process', 'Process Completed','Shipping', 'Completed', 'On Hold', 'Failed') NOT NULL DEFAULT 'Pending';

ALTER TABLE `customers` ADD `building` VARCHAR(255) NULL AFTER `district`;

ALTER TABLE `announcements` ADD `has_sales_time` TINYINT(1) NULL AFTER `temporary_close`;
ALTER TABLE `announcements` ADD `start_sales_time` TIME NULL AFTER `has_sales_time`;
ALTER TABLE `announcements` ADD `end_sales_time` TIME NULL AFTER `start_sales_time`;