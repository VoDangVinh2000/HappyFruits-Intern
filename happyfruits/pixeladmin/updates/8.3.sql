-- 25/03/2018 - New user type and ship service fee
INSERT INTO `user_types`(`type_id`, `type_name`, `created_dtm`) VALUES(6, 'Dịch vụ giao hàng', NOW());

ALTER TABLE `orders` ADD `service_fee` DECIMAL(5,2) NULL AFTER `efruit_note`;