-- 14/08/2019 - Booking order in group
ALTER TABLE `g_order_items` ADD `member_description` VARCHAR(255) NULL AFTER `member_name`;
ALTER TABLE `g_booking` ADD `order_code` VARCHAR(20) NULL AFTER `g_code`;