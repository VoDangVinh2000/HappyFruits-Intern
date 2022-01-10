-- 14/01/2016 -- Image galery manage
CREATE TABLE `images_in_gallery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) unsigned NOT NULL,
  `image_id` int(11) unsigned NOT NULL,
  `sequence_number` INT(5) NOT NULL DEFAULT '0',
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;