-- 23/09/2019 - exchange_points for customers
ALTER TABLE `customers` CHANGE `exchange_points` `exchange_points` DECIMAL(8,2) NULL;
UPDATE customers c
SET c.exchange_points = (SELECT SUM(o.subtotal)/10
FROM orders o
WHERE o.customer_id = c.customer_id
AND o.deleted = 0 AND (o.type_id = 1 OR o.type_id = 2)
AND o.status = 'Completed'
AND o.delivery_date >= '2019-09-01'
GROUP BY o.customer_id);