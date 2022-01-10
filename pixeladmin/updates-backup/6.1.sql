-- 29/02/2016 -- Order statuses
ALTER TABLE `orders` ADD `status` ENUM('Pending','In Process','On Hold','Completed','Failed') NOT NULL DEFAULT 'Pending';
UPDATE `orders` SET `status` = 'Completed' WHERE `deleted` = 0;
UPDATE `orders` SET `status` = 'Failed' WHERE `deleted` = 1;