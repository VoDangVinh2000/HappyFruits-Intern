-- 08/10/2018 - Debts of customers
CREATE TABLE `customer_debts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT '1',
  `description` text,
  `branch_id` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT 'cash',
  `payment_date` datetime NOT NULL,
  `paid_amount` int(11) DEFAULT NULL,
  `status` enum('pending','paid') DEFAULT 'pending',
  `created_by` int(11) NOT NULL,
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;