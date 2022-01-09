TRUNCATE TABLE `categories`;
TRUNCATE TABLE `order_items`;
TRUNCATE TABLE `orders`;
TRUNCATE TABLE `prices`;
TRUNCATE TABLE `products`;

UPDATE prices p1 INNER JOIN prices p2 ON p1.product_id = p2.product_id
SET p1.price = p2.price WHERE p2.type_id = 1 AND p1.type_id IN (2,3);

-- 10/14/2014
UPDATE shipping_details SET customer_id = 418 WHERE customer_id IN (328);
UPDATE shipping_details SET customer_id = 34 WHERE customer_id IN (385, 305);
UPDATE shipping_details SET customer_id = 505 WHERE customer_id IN (492);
UPDATE shipping_details SET customer_id = 365 WHERE customer_id IN (405);
UPDATE shipping_details SET customer_id = 391 WHERE customer_id IN (291);
UPDATE shipping_details SET customer_id = 259 WHERE customer_id IN (284);
UPDATE shipping_details SET customer_id = 312 WHERE customer_id IN (425);

UPDATE customers c SET c.total_paid = (SELECT SUM(s.total) FROM shipping_details s WHERE s.customer_id = c.customer_id GROUP BY s.customer_id);
UPDATE customers SET deleted = 1 WHERE total_paid = 0;

-- 29/10/2014
DELETE FROM order_items
WHERE order_items.order_id IN (SELECT orders.id FROM orders WHERE orders.deleted = 1);
DELETE FROM orders WHERE orders.deleted = 1;

-- Update product names
UPDATE products SET `name` = CONCAT('Nước ép ', `name`), `name_without_utf8` = CONCAT('Nuoc ep ', `name_without_utf8`), `english_name` = CONCAT(`english_name`,' juice') WHERE category_id = 7 AND ISNULL(belongs_to);

-- Change lat/lng length
ALTER TABLE `customers` CHANGE `lat` `lat` DECIMAL(15,10) NULL;
ALTER TABLE `customers` CHANGE `lng` `lng` DECIMAL(15,10) NULL;

--
UPDATE products SET `modified_dtm` = NOW() WHERE `category_id` = 3;

-- 14/12/2017 - cron
UPDATE customers c SET c.total_paid = (SELECT SUM(o.total) FROM orders o WHERE o.customer_id = c.customer_id AND o.deleted = 0 AND o.status = 'Completed' GROUP BY o.customer_id);

-- 05/01/2018 - cron
UPDATE `customers` SET `last_order_dtm` = (SELECT MAX(`orders`.`delivery_date`) FROM `orders` WHERE `orders`.`customer_id` = `customers`.`customer_id` AND `orders`.`deleted` = 0 AND `orders`.`status` = 'Completed');

-- 21/05/2018 - insert missing shipping records
INSERT INTO shipping_details(`user_id`, `customer_id`, `order_id`, `branch_id`, `date_time`, `distance`, `number_of_dishes`, `total`, `description`, `created_by`, `created_dtm`)
SELECT `shipper_id`, `customer_id`, `id`, o.`branch_id`, `delivery_date`, 1.1, `quantity`, `total`, `service_fee`, 1, NOW()
FROM `orders` o
INNER JOIN `users` u ON u.user_id = o.shipper_id
WHERE u.type_id = 6 AND o.deleted = 0 AND o.status = 'Completed';