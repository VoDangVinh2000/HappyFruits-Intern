<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Inventoryitemdetails
 * Generation date:  21/01/2015
 * Baseclass:        BaseInventoryitemdetails
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseInventoryitemdetails.php');

/**
 * Class declaration
 */
class Inventoryitemdetails extends BaseInventoryitemdetails
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Inventoryitemdetails';
    }
    
    function get_list($filters = array(), $deleted = 0, $order_by = 'inventory_item_details.type_id')
    {
        $sql = 'SELECT inventory_item_details.*, inventory_item_types.type_name
                FROM inventory_item_details
                INNER JOIN inventory_item_types ON inventory_item_types.id = inventory_item_details.type_id';
        if ($deleted != -1)
            $filters['inventory_item_details.deleted'] = $deleted;
	    if (!isset($filters['is_fruit']))
		    $filters['is_fruit'] = 0;
	    elseif($filters['is_fruit'] == -1)
            unset($filters['is_fruit']);
	    if (!isset($filters['enabled']))
		    $filters['enabled'] = 1;
        return self::_do_sql($sql, $filters, array(), $order_by);
    }
    
    function get_item_types($filters = array(), $deleted = 0, $order_by = '')
    {
        if ($deleted != -1)
            $filters['deleted'] = $deleted;
	    if (!isset($filters['is_fruit']))
		    $filters['is_fruit'] = 0;
	    if ($order_by)
		    $filters['order_by'] = $order_by;
        return self::_select('inventory_item_types', $filters);
    }

	function get_type_count($enabled = 1)
	{
		$enabled_str = '';
		if ($enabled == 1)
			$enabled_str = 'AND enabled = 1';
		$sql = 'SELECT inventory_item_details.type_id, COUNT(*) as num_of_records
                FROM inventory_item_details
                INNER JOIN inventory_item_types ON inventory_item_types.id = inventory_item_details.type_id
                WHERE inventory_item_details.deleted = 0 AND is_fruit = 0 '. $enabled_str .'
                GROUP BY inventory_item_details.type_id
                ORDER BY inventory_item_details.type_id';
		return self::_do_sql($sql);
	}

	function get_fruits_list($filters = array(), $deleted = 0, $order_by = 'inventory_item_details.type_id, inventory_item_details.name')
	{
		$sql = 'SELECT inventory_item_details.*, inventory_item_types.type_name, inventory_item_categories.category_name
                FROM inventory_item_details
                INNER JOIN inventory_item_types ON inventory_item_types.id = inventory_item_details.type_id
                LEFT JOIN inventory_item_categories  ON inventory_item_categories.id = inventory_item_details.category_id';
		if ($deleted != -1)
			$filters['inventory_item_details.deleted'] = $deleted;
		if (!isset($filters['enabled']))
			$filters['enabled'] = 1;
		elseif($filters['enabled'] == -1)
			unset($filters['enabled']);
		$filters['inventory_item_types.is_fruit'] = 1;
		return self::_do_sql($sql, $filters, array(), $order_by);
	}

    function get_fruits_types($filters = array(), $deleted = 0, $order_by = '')
    {
	    if ($deleted != -1)
		    $filters['deleted'] = $deleted;
	    $filters['is_fruit'] = 1;
	    if ($order_by)
		    $filters['order_by'] = $order_by;
	    return self::_select('inventory_item_types', $filters);
    }

    function get_fruits_type_count($enabled = 1)
    {
	    $enabled_str = '';
    	if ($enabled == 1)
		    $enabled_str = 'AND enabled = 1';
	    $sql = 'SELECT inventory_item_details.type_id, COUNT(*) as num_of_records
                FROM inventory_item_details
                INNER JOIN inventory_item_types ON inventory_item_types.id = inventory_item_details.type_id
                WHERE inventory_item_details.deleted = 0 AND is_fruit = 1 '. $enabled_str .'
                GROUP BY inventory_item_details.type_id
                ORDER BY inventory_item_details.type_id';
	    return self::_do_sql($sql);
    }

    function get_fruit_categories($filters = array(), $deleted = 0, $order_by = '')
    {
	    if ($deleted != -1)
		    $filters['deleted'] = $deleted;
	    $filters['is_fruit'] = 1;
	    if ($order_by)
		    $filters['order_by'] = $order_by;
	    return self::_select('inventory_item_categories', $filters);
    }
}
/* End of generated class */
