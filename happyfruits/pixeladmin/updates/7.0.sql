-- 12/03/2017 -- Showing tag of products on homepage
ALTER TABLE `tags` ADD `is_main` TINYINT(1) DEFAULT 0 AFTER `modified_dtm`;