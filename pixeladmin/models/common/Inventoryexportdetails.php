<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Inventoryexportdetails
 * Generation date:  21/01/2015
 * Baseclass:        BaseInventoryexportdetails
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseInventoryexportdetails.php');

/**
 * Class declaration
 */
class Inventoryexportdetails extends BaseInventoryexportdetails
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Inventoryexportdetails';
    }
    
    function get_records($filters = array())
    {
        $sql = 'SELECT inventory_export.*,
                        users.fullname, warehouses.name as warehouse_name,
                        inventory_item_details.id as item_id, inventory_item_details.code, inventory_item_details.name, inventory_item_details.unit, inventory_item_details.type_id, inventory_item_details.unit_in_details, inventory_item_details.quantity_in_details as default_quantity_in_details,
                        inventory_export_details.item_id, inventory_export_details.quantity, inventory_export_details.quantity_in_details, inventory_export_details.description as detail_description, inventory_export_details.remain_quantity,
                        inventory_item_types.type_name
                FROM inventory_export
                INNER JOIN users ON users.user_id = inventory_export.user_id
                INNER JOIN warehouses ON warehouses.id = inventory_export.warehouse_id
                INNER JOIN inventory_export_details ON inventory_export_details.export_id = inventory_export.id
                INNER JOIN inventory_item_details ON inventory_item_details.id = inventory_export_details.item_id
                INNER JOIN inventory_item_types ON inventory_item_types.id = inventory_item_details.type_id';
        return self::_do_sql($sql, $filters);
    }
    
    function get_list($filters = array(), $order_by = '')
    {
        $sql = 'SELECT inventory_export_details.quantity, inventory_export_details.quantity_in_details, inventory_export_details.remain_quantity,
                        inventory_item_details.name, inventory_item_details.unit, inventory_item_details.unit_in_details
                FROM inventory_export_details
                INNER JOIN inventory_item_details ON inventory_item_details.id = inventory_export_details.item_id';
        return self::_do_sql($sql, $filters, array(), $order_by);
    }
    
    function delete_export_details($filters = array())
    {
        return self::_delete('inventory_export_details', $filters);
    }
}
/* End of generated class */
