-- 20/10/2019 - tag_ids  for pages
ALTER TABLE `pages` ADD `tag_ids` varchar(50) NULL AFTER `product_cat_ids`;