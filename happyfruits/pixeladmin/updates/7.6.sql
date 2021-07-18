ALTER TABLE `inventory_export_details` ADD `remain_quantity` DECIMAL(8,2) NOT NULL DEFAULT '0' AFTER `quantity_in_details`;

INSERT INTO inventory(warehouse_id, item_id, created_dtm)
(SELECT 1 AS warehouse_id, d.id, NOW()
FROM inventory_item_details d INNER JOIN inventory_item_types t ON t.id = d.type_id
WHERE t.is_fruit = 1);

INSERT INTO inventory(warehouse_id, item_id, created_dtm)
(SELECT 2 AS warehouse_id, d.id, NOW()
FROM inventory_item_details d INNER JOIN inventory_item_types t ON t.id = d.type_id
WHERE t.is_fruit = 1);