<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Inventoryimportdetails
 * Generation date:  21/01/2015
 * Baseclass:        BaseInventoryimportdetails
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseInventoryimportdetails.php');

/**
 * Class declaration
 */
class Inventoryimportdetails extends BaseInventoryimportdetails
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Inventoryimportdetails';
    }
    
    function get_records($filters = array())
    {
        $sql = 'SELECT inventory_import.*, users.fullname, warehouses.name as warehouse_name, inventory_item_types.type_name,
                    inventory_item_details.code, inventory_item_details.name, inventory_item_details.unit, inventory_item_details.type_id, inventory_item_details.quantity_in_details, provider_id, 
                    inventory_import_details.item_id, inventory_import_details.quantity, inventory_import_details.price, inventory_import_details.description as detail_description, inventory_import_details.provider_id
                FROM inventory_import
                INNER JOIN users ON users.user_id = inventory_import.user_id
                INNER JOIN warehouses ON warehouses.id = inventory_import.warehouse_id
                INNER JOIN inventory_import_details ON inventory_import_details.import_id = inventory_import.id
                INNER JOIN inventory_item_details ON inventory_item_details.id = inventory_import_details.item_id
                INNER JOIN inventory_item_types ON inventory_item_types.id = inventory_item_details.type_id';
        return self::_do_sql($sql, $filters);
    }
    
    function get_list($filters = array(), $order_by = '')
    {
        $sql = 'SELECT inventory_import_details.quantity, inventory_item_details.name, inventory_item_details.unit
                FROM inventory_import_details
                INNER JOIN inventory_item_details ON inventory_item_details.id = inventory_import_details.item_id';
        return self::_do_sql($sql, $filters, array(), $order_by);
    }
    
    function delete_import_details($filters = array())
    {
        return self::_delete('inventory_import_details', $filters);
    }
}
/* End of generated class */
