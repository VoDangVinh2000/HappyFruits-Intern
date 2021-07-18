ALTER TABLE `orders` CHANGE `status` `status` ENUM('Pending','In Process','Wait for Shipping','Shipping','On Hold','Completed','Failed') NOT NULL DEFAULT 'Pending';

ALTER TABLE `branches` ADD `note_on_processing_screen` TEXT NULL;
