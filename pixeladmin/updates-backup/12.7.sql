-- 23/08/2020 - More settings for about us
ALTER TABLE `settings` ADD `option_value_en` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `option_value`;
ALTER TABLE `settings` ADD `has_en_option` TINYINT(1) NOT NULL DEFAULT 0 AFTER `option_value_en`;
INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `option_value_en`, `has_en_option`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES
(NULL, '7. About Us', 'about_us_heading', 'Về eFruit', 'About eFruit', '1', 'Tiêu đề', 'string', '0', NOW(), NOW()),
(NULL, '7. About Us', 'about_us_content1', 'eFruit tự hào là thương hiệu tiên phong trong dịch vụ cung cấp sản phẩm, giải pháp về trái cây tươi an toàn đến nhiều công ty, văn phòng tại HCM.', 'eFruit is proud of being a leading brand providing fresh fruits, smoothies and juices for many companies and offices in Ho Chi Minh city.', '1', 'Nội dung 1', 'html', '0', NOW(), NOW()),
(NULL, '7. About Us', 'about_us_content1_img', 'http://www.efruit.vn/themes/efruit/assets/img/efruit-to-save.png', '', '0', 'Hình ảnh cho nội dung 1', 'image', '0', NOW(), NOW()),
(NULL, '7. About Us', 'about_us_content2', 'Ủng hộ nông sản Việt chất lượng, an toàn, canh tác bền vững, không hóa chất độc hại bảo vệ môi sinh là tiêu chí của eFruit.', 'Using high quality, safety, sustainable and non-toxic chemicals Vietnamese agricultural products is the operation policy of eFruit.', '1', 'Nội dung 2', 'html', '0', NOW(), NOW()),
(NULL, '7. About Us', 'about_us_content2_img', 'http://www.efruit.vn/themes/efruit/assets/img/100percent-natural.png', '', '0', 'Hình ảnh cho nội dung 2', 'image', '0', NOW(), NOW()),
(NULL, '7. About Us', 'about_us_content3', 'Tự tin, sáng tạo, hoạt động bền vững, luôn lắng nghe và sẵn sàng đem đến những trải nghiệm tốt nhất cho khách hàng.', 'Confident, creative, sustainable operations, always listening and being ready to bring the best services to our customers.', '1', 'Nội dung 3', 'html', '0', NOW(), NOW()),
(NULL, '7. About Us', 'about_us_content3_img', 'http://www.efruit.vn/themes/efruit/assets/img/creation.png', '', '0', 'Hình ảnh cho nội dung 3', 'image', '0', NOW(), NOW()),
(NULL, '7. About Us', 'about_us_content4', '', '', '1', 'Nội dung 4', 'html', '0', NOW(), NOW()),
(NULL, '7. About Us', 'about_us_content4_img', '', '', '0', 'Hình ảnh cho nội dung 4', 'image', '0', NOW(), NOW());


INSERT INTO `settings` (`id`, `category`, `option_name`, `option_value`, `option_value_en`, `has_en_option`, `name`, `field_type`, `is_hide`, `created_dtm`, `modified_dtm`) VALUES
(NULL, '1. Tổng quan', 'general_shiping_fee_description', 'http://www.efruit.vn/themes/efruit/assets/img/new-shipping-fee.png', '0', '0', 'Ghi chú phí ship', 'string', '0', NOW(), NOW());