-- 17/01/2020 - Adding more information for branch
ALTER TABLE `branches` ADD `short_address` VARCHAR(255) NULL AFTER `branch_address`;
ALTER TABLE `branches` ADD `en_address` VARCHAR(255) NULL AFTER `short_address`;
ALTER TABLE `branches` ADD `phone_number` VARCHAR(255) NULL AFTER `en_address`;