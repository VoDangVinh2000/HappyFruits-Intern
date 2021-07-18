-- 19/08/2018 - Company name, company tax code and company address for customer
ALTER TABLE `customers` ADD `company_name` VARCHAR(255) NULL AFTER `distance`;
ALTER TABLE `customers` ADD `company_tax_code` VARCHAR(255) NULL AFTER `company_name`;
ALTER TABLE `customers` ADD `company_address` VARCHAR(255) NULL AFTER `company_tax_code`;