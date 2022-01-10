-- 26/10/2019 - Addresses and companies info
CREATE TABLE `addresses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `address` varchar(255),
  `district` varchar(100),
  `building` varchar(255),
  `lat` decimal(10,6),
  `lng` decimal(10,6),
  `distance` varchar(5),
  `description` varchar(255),
  `created_by` int(11) NOT NULL,
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `addressables` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `address_id` int(11) NOT NULL,
  `addressable_id` int(11) NOT NULL,
  `addressable_type` varchar(100),
  `description` varchar(255),
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255),
  `tax_code` varchar(100),
  `address` varchar(255),
  `lat` decimal(10,6),
  `lng` decimal(10,6),
  `description` varchar(255),
  `created_by` int(11) NOT NULL,
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `companies_links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `link_type` varchar(100),
  `description` varchar(255),
  `created_dtm` datetime NOT NULL,
  `modified_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;