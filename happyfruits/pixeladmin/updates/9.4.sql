-- 14/09/2018 - More information for providers
ALTER TABLE `providers` ADD `bank_name` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL AFTER `email`;
ALTER TABLE `providers` ADD `bank_account_name` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL AFTER `bank_name`;
ALTER TABLE `providers` ADD `bank_account_number` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL AFTER `bank_account_name`;