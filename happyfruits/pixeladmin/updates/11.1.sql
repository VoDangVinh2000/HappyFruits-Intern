-- 13/10/2019 - Meta keywords - Slides for pages
INSERT  INTO `settings`(`id`,`option_name`,`option_value`,`name`,`is_hide`,`created_dtm`,`modified_dtm`) 
VALUES (NULL,'meta_keywords','trái cây efruit, efruit, trái cây an toàn, trái cây giao tận nơi, trái cây tươi, trái cây văn phòng, yaourt trái cây, sinh tố ngon giao tận nơi, nước ép nguyên chất, nước ép chai nguyên chất, trái cây tiệc, cartering office, tea break','Nội dung thẻ meta keywords',0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

ALTER TABLE `pages` ADD `slide_images` TEXT NULL AFTER `header_image`;
ALTER TABLE `pages` ADD `product_cat_ids` varchar(50) NULL AFTER `meta_robots`;

ALTER TABLE `announcements` ADD `is_promotion` tinyint(1) NULL DEFAULT 0 AFTER `has_sales_time`;
ALTER TABLE `announcements` ADD `promotion_image` varchar(255) NULL AFTER `is_promotion`;
ALTER TABLE `announcements` ADD `promotion_link` varchar(255) NULL AFTER `promotion_image`;

ALTER TABLE `files` CHANGE `extra_data` `extra_data` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;