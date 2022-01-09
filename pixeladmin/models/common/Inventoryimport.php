<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Inventoryimport
 * Generation date:  21/01/2015
 * Baseclass:        BaseInventoryimport
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseInventoryimport.php');

/**
 * Class declaration
 */
class Inventoryimport extends BaseInventoryimport
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Inventoryimport';
    }
    
    function get_inventory_import_records($filters = array())
    {
    	if (!empty($filters['inventory_import_details.provider_id'])){
		    $sql = 'SELECT DISTINCT inventory_import.*, users.fullname, warehouses.name as warehouse_name
                FROM inventory_import
                INNER JOIN inventory_import_details ON inventory_import_details.import_id = inventory_import.id
                INNER JOIN users ON users.user_id = inventory_import.user_id
                INNER JOIN warehouses ON warehouses.id = inventory_import.warehouse_id';
	    }else{
		    $sql = 'SELECT inventory_import.*, users.fullname, warehouses.name as warehouse_name
                FROM inventory_import
                INNER JOIN users ON users.user_id = inventory_import.user_id
                INNER JOIN warehouses ON warehouses.id = inventory_import.warehouse_id';
	    }

        $filters['inventory_import.deleted'] = 0;
        return self::_do_sql($sql, $filters, array(), 'inventory_import.import_date DESC');
    }

	static function getProvidersName($id)
	{
		$names = array();
		$sql = "SELECT DISTINCT providers.*
                FROM inventory_import 
                INNER JOIN inventory_import_details ON inventory_import_details.import_id = inventory_import.id
                INNER JOIN providers ON providers.id = inventory_import_details.provider_id";
		$providers = self::_do_sql($sql, array('inventory_import.id' => $id), array(), 'providers.provider_name');
		if ($providers){
			foreach($providers as $provider)
				$names[] = $provider['provider_name'];
		}
		if (empty($names))
			return 'Không nhà cung cấp';
		return implode(', ', $names);
	}
}
/* End of generated class */
