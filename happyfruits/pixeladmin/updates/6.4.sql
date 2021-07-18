-- 19/04/2016 -- Salary advances
DROP TABLE IF EXISTS `salary_advances`;
CREATE TABLE `salary_advances` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `date_time` DATETIME NOT NULL,
  `user_id` INT(11) NOT NULL,
  `amount` INT(4) NOT NULL,
  `description` VARCHAR(255) NULL,
  `created_by` INT(11) NOT NULL,
  `created_dtm` DATETIME NOT NULL,
  `modified_dtm` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;