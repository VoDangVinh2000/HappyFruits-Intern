-- 12/08/2019 - Ribbons for products
ALTER TABLE `products` ADD `ribbon_left` VARCHAR(20) NULL AFTER `type`;
ALTER TABLE `products` ADD `ribbon_left_color` VARCHAR(20) NULL AFTER `ribbon_left`;
ALTER TABLE `products` ADD `ribbon_right` VARCHAR(20) NULL AFTER `ribbon_left_color`;
ALTER TABLE `products` ADD `ribbon_right_color` VARCHAR(20) NULL AFTER `ribbon_right`;