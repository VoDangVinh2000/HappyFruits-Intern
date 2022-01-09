-- 18/09/2018 - Allow quantity to be float number
ALTER TABLE `inventory_item_details` CHANGE `warning_quanity` `warning_quanity` DECIMAL(8,2) NOT NULL DEFAULT 3;
ALTER TABLE `inventory_item_details` CHANGE `required_quantity` `required_quantity` DECIMAL(8,2) NULL;
ALTER TABLE `inventory_item_details` CHANGE `quantity_in_details` `quantity_in_details` DECIMAL(8,2) NULL;