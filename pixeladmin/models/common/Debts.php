<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Debts
 * Generation date:  05/07/2018
 * Baseclass:        BaseDebts
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseDebts.php');

/**
 * Class declaration
 */
class Debts extends BaseDebts
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Debts';
    }

	function get_list($filters = array(), $order_by = 'debts.payment_date DESC')
	{
		if (!empty($filters['inventory_import_details.provider_id'])){
			$sql = "SELECT DISTINCT debts.*, users.fullname, cost_types.name as debt_type, branches.branch_name, inventory_import.has_invoice
                FROM debts 
                INNER JOIN inventory_import_details ON inventory_import_details.import_id = debts.import_id
                INNER JOIN inventory_import ON inventory_import.id = debts.import_id
                INNER JOIN cost_types ON cost_types.id = debts.type_id
                INNER JOIN users ON users.user_id = debts.user_id
                INNER JOIN branches ON branches.id = debts.branch_id";
		}else {
			$sql = "SELECT debts.*, users.fullname, cost_types.name as debt_type, branches.branch_name, inventory_import.has_invoice
                FROM debts 
                INNER JOIN cost_types ON cost_types.id = debts.type_id
                INNER JOIN inventory_import ON inventory_import.id = debts.import_id
                INNER JOIN users ON users.user_id = debts.user_id
                INNER JOIN branches ON branches.id = debts.branch_id";
		}
		/*
		$sql = "SELECT DISTINCT debts.*, users.fullname, cost_types.name as debt_type, branches.branch_name, providers.provider_name
                FROM debts 
                INNER JOIN inventory_import_details ON inventory_import_details.import_id = debts.import_id
                LEFT JOIN providers ON providers.id = inventory_import_details.provider_id
                INNER JOIN cost_types ON cost_types.id = debts.type_id
                INNER JOIN users ON users.user_id = debts.user_id
                INNER JOIN branches ON branches.id = debts.branch_id";
		*/
		$filters['debts.deleted'] = 0;
		return self::_do_sql($sql, $filters, array(), $order_by);
	}

	function get_types()
	{
		return eModel::_select('cost_types');
	}

	static function is_editable($debt_id)
	{
		$debt = eModel::_select_one('debts', array('id' => $debt_id));
		if (!$debt)
			return false;
		/* Admin can edit the debt any time */
		if (Users::is_admin())
			return true;
		/*
		if (date('Y-m-d', strtotime($debt['created_dtm'])) != date('Y-m-d'))
			return false;
		*/
		return Users::can('edit', 'debt');
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

	function get_details_by_order_id($order_id, $filters = array())
	{
		$filters = array_merge($filters, array('order_id' => $order_id, 'deleted' => 0));
		return self::_select_one($this->table_name, $filters);
	}

	static function getProvidersName($id)
	{
		$names = array();
		$sql = "SELECT DISTINCT providers.*
                FROM debts 
                INNER JOIN inventory_import_details ON inventory_import_details.import_id = debts.import_id
                INNER JOIN providers ON providers.id = inventory_import_details.provider_id";
		$providers = self::_do_sql($sql, array('debts.id' => $id), array(), 'providers.provider_name');
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
