-- 07/07/2015 - Is overtime
ALTER TABLE `assessment` ADD `overtime` TINYINT(1) NOT NULL DEFAULT '0' AFTER assiduousness;