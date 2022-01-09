<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Inventory
 * Generation date:  21/01/2015
 * Baseclass:        BaseInventory
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseInventory.php');

/**
 * Class declaration
 */
class Inventory extends BaseInventory
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Inventory';
    }
    
    function get_inventory_records($filters = array())
    {
        $sql = 'SELECT inventory.*,
                    inventory_item_details.code, inventory_item_details.name, inventory_item_details.unit, inventory_item_details.unit_in_details, inventory_item_details.quantity_in_details as has_quantity_in_details, inventory_item_details.warning_quanity, 
                    warehouses.name as warehouse_name, inventory_item_types.type_name,
                    (SELECT MAX(ii.import_date) FROM inventory_import ii INNER JOIN inventory_import_details iid ON iid.import_id = ii.id WHERE inventory.item_id = iid.item_id AND inventory.warehouse_id = ii.warehouse_id AND ii.deleted = 0) AS last_import_date,
                    (SELECT MAX(ie.export_date) FROM inventory_export ie INNER JOIN inventory_export_details ied ON ied.export_id = ie.id WHERE inventory.item_id = ied.item_id AND inventory.warehouse_id = ie.warehouse_id AND ie.deleted = 0) AS last_export_date
                FROM inventory
                INNER JOIN warehouses ON warehouses.id = inventory.warehouse_id
                INNER JOIN inventory_item_details ON inventory_item_details.id = inventory.item_id
                INNER JOIN inventory_item_types ON inventory_item_types.id = inventory_item_details.type_id';
        $filters['inventory.deleted'] = 0;
	    $filters['inventory_item_details.enabled'] = 1;
        return self::_do_sql($sql, $filters);
    }
    
    function get_warehouses($filters = array(), $deleted = 0)
    {
        if ($deleted != -1)
            $filters['deleted'] = $deleted;
        return self::_select('warehouses', $filters);
    }

    function get_warning_records($filters = array())
    {
	    $sql = 'SELECT inventory.*,
                    inventory_item_details.code, inventory_item_details.name, inventory_item_details.unit, inventory_item_details.unit_in_details, inventory_item_details.quantity_in_details as has_quantity_in_details, inventory_item_details.warning_quanity, 
                    warehouses.name as warehouse_name, inventory_item_types.type_name
                FROM inventory
                INNER JOIN warehouses ON warehouses.id = inventory.warehouse_id
                INNER JOIN inventory_item_details ON inventory_item_details.id = inventory.item_id
                INNER JOIN inventory_item_types ON inventory_item_types.id = inventory_item_details.type_id';
	    $filters['inventory.deleted'] = 0;
	    $filters['inventory_item_details.enabled'] = 1;
	    $filters['where'] = 'inventory.quantity <= inventory_item_details.warning_quanity';
	    return self::_do_sql($sql, $filters);
    }
}
/* End of generated class */
