<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Inventoryexport
 * Generation date:  21/01/2015
 * Baseclass:        BaseInventoryexport
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseInventoryexport.php');

/**
 * Class declaration
 */
class Inventoryexport extends BaseInventoryexport
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Inventoryexport';
    }
    
    function get_inventory_export_records($filters = array())
    {
        $sql = 'SELECT inventory_export.*, users.fullname, warehouses.name as warehouse_name
                FROM inventory_export
                INNER JOIN users ON users.user_id = inventory_export.user_id
                INNER JOIN warehouses ON warehouses.id = inventory_export.warehouse_id';
        $filters['inventory_export.deleted'] = 0;
        return self::_do_sql($sql, $filters, array(), 'inventory_export.export_date DESC');
    }
}
/* End of generated class */
