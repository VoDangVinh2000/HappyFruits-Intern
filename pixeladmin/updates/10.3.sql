-- 06/11/2018 - Service fee when shipping
ALTER TABLE `costs` ADD `order_id` INT(11) NULL AFTER `import_id`;