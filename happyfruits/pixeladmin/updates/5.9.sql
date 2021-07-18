-- 21/01/2016 -- Image field for products and categories
ALTER TABLE `products` ADD `image` VARCHAR(255) NULL AFTER `english_name`;
ALTER TABLE `categories` ADD `image` VARCHAR(255) NULL AFTER `english_name`;

UPDATE products
LEFT JOIN files ON files.foreign_id = products.product_id AND files.type = 'product_image' AND files.id = (
	SELECT MIN(f.id)
	FROM files f 
	WHERE f.foreign_id = products.product_id AND f.type = 'product_image' 
	LIMIT 1
	)
SET image = CONCAT('http://www.efruit.vn/',files.path)
WHERE files.id IS NOT NULL;

UPDATE categories
LEFT JOIN files ON files.foreign_id = categories.category_id AND files.type = 'category_image' AND files.id = (
	SELECT MIN(f.id)
	FROM files f 
	WHERE f.foreign_id = categories.category_id AND f.type = 'category_image' 
	LIMIT 1
	)
SET image = CONCAT('http://www.efruit.vn/',files.path)
WHERE files.id IS NOT NULL;