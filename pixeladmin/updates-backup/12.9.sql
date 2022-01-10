-- 28/10/2020 - More settings
ALTER TABLE `settings` ADD `seq_no` TINYINT(1) NOT NULL DEFAULT '50' AFTER `category`;
 
INSERT INTO `settings` (`id`, `category`, `seq_no`, `option_name`, `option_value`, `option_value_en`, `has_en_option`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES
(NULL, '3. Khuyến mãi', 40, 'pebooking_discount_2', '0.03', NULL, '0', 'Ưu đãi đặt trước 1 ngày', 'float', '0', NOW(), NOW());

UPDATE `settings` SET `seq_no` = 30, `name` = 'Ưu đãi đặt trước 2 ngày' WHERE `settings`.`id` = 2;