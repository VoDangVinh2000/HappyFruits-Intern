<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Costs
 * Generation date:  05/07/2018
 * Baseclass:        BaseCosts
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseCosts.php');

/**
 * Class declaration
 */
class Costs extends BaseCosts
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Costs';
    }

	function get_list($filters = array(), $order_by = 'costs.date_time DESC')
	{
		if (!empty($filters['inventory_import_details.provider_id'])){
			$sql = "SELECT DISTINCT costs.*, users.fullname, cost_types.name as cost_type, branches.branch_name
                FROM costs 
                INNER JOIN inventory_import_details ON inventory_import_details.import_id = costs.import_id
                INNER JOIN cost_types ON cost_types.id = costs.type_id
                INNER JOIN users ON users.user_id = costs.user_id
                INNER JOIN branches ON branches.id = costs.branch_id";
		}else {
			$sql = "SELECT costs.*, users.fullname, cost_types.name as cost_type, branches.branch_name
                FROM costs 
                INNER JOIN cost_types ON cost_types.id = costs.type_id
                INNER JOIN users ON users.user_id = costs.user_id
                INNER JOIN branches ON branches.id = costs.branch_id";
		}
		$filters['costs.deleted'] = 0;
		return self::_do_sql($sql, $filters, array(), $order_by);
	}

	function get_types()
	{
		return eModel::_select('cost_types');
	}

	static function is_editable($cost_id)
	{
		$cost = eModel::_select_one('costs', array('id' => $cost_id));
		if (!$cost)
			return false;
		/* Admin can edit the costeverytime */
		if (Users::is_admin())
			return true;
		/*
		if (date('Y-m-d', strtotime($cost['created_dtm'])) != date('Y-m-d'))
			return false;
		*/
		return Users::can('edit', 'cost');
	}

	function update_type($where_params = array(), $set_params = array())
	{
		if (!empty($where_params) && !is_array($where_params))
			$where_params = array('id' => $where_params);
		return self::_update('cost_types', $where_params, $set_params);
	}

	function insert_type($data = array())
	{
		return self::_insert('cost_types', $data);
	}

	function get_type_details($type_id, $filters = array())
	{
		$filters = array_merge($filters, array('id' => $type_id));
		return self::_select_one('cost_types', $filters);
	}

	function get_details_by_import_id($import_id, $filters = array())
	{
		$filters = array_merge($filters, array('import_id' => $import_id, 'deleted' => 0));
		return self::_select_one($this->table_name, $filters);
	}

	function get_details_by_debt_id($debt_id, $filters = array())
	{
		$filters = array_merge($filters, array('debt_id' => $debt_id, 'deleted' => 0));
		return self::_select_one($this->table_name, $filters);
	}

    function get_details_by_order_id($order_id, $filters = array())
    {
        $filters = array_merge($filters, array('order_id' => $order_id, 'deleted' => 0));
        return self::_select_one($this->table_name, $filters);
    }

	static function getProvidersName($id)
	{
		$names = array();
		$sql = "SELECT DISTINCT providers.*
                FROM costs 
                INNER JOIN inventory_import_details ON inventory_import_details.import_id = costs.import_id
                INNER JOIN providers ON providers.id = inventory_import_details.provider_id";
		$providers = self::_do_sql($sql, array('costs.id' => $id), array(), 'providers.provider_name');
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
