-- 14/09/2018 - Settings for cash and bank balance
INSERT  INTO `settings`(`id`,`option_name`,`option_value`,`name`,`is_hide`,`created_dtm`,`modified_dtm`) 
VALUES (NULL,'cash','0', 'Tiền mặt',0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),(NULL,'bank_balance','0', 'Số dư ngân hàng',0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
ALTER TABLE `settings` ADD `field_type` VARCHAR(50) NULL AFTER `name`;