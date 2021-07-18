-- 15/09/2018 - Foody authentiation
INSERT  INTO `settings`(`id`,`option_name`,`option_value`,`name`, `field_type`,`is_hide`,`created_dtm`,`modified_dtm`) 
VALUES (NULL,'delivery_auth_code','','Auth code will be expired in 1 month','string',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);