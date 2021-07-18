-- 04/08/2020 - More settings
ALTER TABLE `settings` ADD `category` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1. Tổng quan' AFTER `id`;
UPDATE `settings` SET `category` = '2. SEO' WHERE `settings`.`id` IN (7, 12);
UPDATE `settings` SET `category` = '3. Khuyến mãi' WHERE `settings`.`id` IN (2, 14);
UPDATE `settings` SET `field_type` = 'text' WHERE `settings`.`id` = 12;

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '4. Top section', 'hotline_1', '0938.70.70.15', 'Hotline 1', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '4. Top section', 'hotline_2', '0906.70.70.15', 'Hotline 2', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '4. Top section', 'facebook_link', 'https://www.facebook.com/efruit.vn', 'Facebook', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '4. Top section', 'youtube_link', 'https://www.youtube.com/channel/UCK0sCgQW-NXBpQVbu6hOyJQ', 'Youtube', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '4. Top section', 'carer_link', '/tuyen-dung', 'Link tuyển dụng', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '4. Top section', 'contact_link', '/vi/lien-he/', 'Link liên hệ', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '1. Tổng quan', 'site_name', 'Trái cây eFruit', 'Tên website', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '1. Tổng quan', 'english_site_name', 'eFruit - Vietnamese Fruits', 'Tên website tiếng Anh', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '1. Tổng quan', 'short_site_name', 'eFruit', 'Tên website viết tắt', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '5. Emails', 'to_emails_for_orders', 'orders@efruit.vn', 'Email nhận orders', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '5. Emails', 'to_emails_for_requests', 'cskh@efruit.vn,orders@efruit.vn', 'Email nhận request từ form', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '6. Công ty', 'company_name', 'Công Ty TNHH Thương Mại Dịch Vụ MID', 'Tên công ty', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '6. Công ty', 'company_address', '444/2 Cách Mạng Tháng 8, Phường 11, Quận 3, TP HCM', 'Địa chỉ công ty', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '6. Công ty', 'company_info', 'Số giấy phép ĐKKD: 0312974791 do sở Kế hoạch và Đầu Tư TPHCM cấp', 'Giấy phép công ty', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '6. Công ty', 'company_extra_1', 'Giấy chứng nhận cơ sở đủ điều kiện an toàn thực phẩm số 1384/2016/ATTP-CNĐK', 'Chứng nhận 1', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '6. Công ty', 'company_extra_2', '', 'Chứng nhận 2', 'string', '0', NOW(), NOW());

INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES (NULL, '2. SEO', 'site_title', 'Giao hàng tận nơi | Trái cây văn phòng | Trái cây an toàn', 'Tiêu đề (title) website', 'string', '0', NOW(), NOW());