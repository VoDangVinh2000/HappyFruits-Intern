-- 05/12/2019 - Option to show/hide product component on frontend
ALTER TABLE `products` ADD `show_components_on_frontend` TINYINT(1) NOT NULL DEFAULT '0' AFTER `not_deliver`;