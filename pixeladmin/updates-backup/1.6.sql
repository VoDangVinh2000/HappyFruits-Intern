-- 19/09/2014
UPDATE customers SET deleted = 1 WHERE customer_id IN (280,218,357,313,236,371,248,78,92,138,142,158,181);
UPDATE shipping_details SET customer_id = 261 WHERE customer_id IN(280);
UPDATE shipping_details SET customer_id = 365 WHERE customer_id IN(218, 357);
UPDATE shipping_details SET customer_id = 312 WHERE customer_id IN(313);
UPDATE shipping_details SET customer_id = 321 WHERE customer_id IN(236);
UPDATE shipping_details SET customer_id = 370 WHERE customer_id IN(371, 248);
UPDATE shipping_details SET customer_id = 77 WHERE customer_id IN(78);
UPDATE shipping_details SET customer_id = 309 WHERE customer_id IN(92);
UPDATE shipping_details SET customer_id = 307 WHERE customer_id IN(138);
UPDATE shipping_details SET customer_id = 275 WHERE customer_id IN(142);
UPDATE shipping_details SET customer_id = 355 WHERE customer_id IN(158);
UPDATE shipping_details SET customer_id = 304 WHERE customer_id IN(181);

ALTER TABLE `customers` ADD `total_paid` INT(11) AFTER `type_id`;
UPDATE customers c SET total_paid = (SELECT SUM(s.total) FROM shipping_details s WHERE s.customer_id = c.customer_id);