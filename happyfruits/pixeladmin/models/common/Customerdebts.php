<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Customerdebts
 * Generation date:  08/10/2018
 * Baseclass:        BaseCustomerdebts
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseCustomerdebts.php');

/**
 * Class declaration
 */
class Customerdebts extends BaseCustomerdebts
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Customerdebts';
    }

	function get_list($filters = array(), $order_by = 'customer_debts.payment_date DESC')
	{
		$sql = "SELECT DISTINCT customer_debts.*, users.fullname, branches.branch_name, orders.code as order_code, orders.shipping_info 
                FROM customer_debts 
                INNER JOIN orders ON orders.id = customer_debts.order_id
                INNER JOIN users ON users.user_id = customer_debts.user_id
                INNER JOIN branches ON branches.id = customer_debts.branch_id";
		$filters['customer_debts.deleted'] = 0;
		return self::_do_sql($sql, $filters, array(), $order_by);
	}

	static function is_editable($debt_id)
	{
		$debt = eModel::_select_one('customer_debts', array('id' => $debt_id));
		if (!$debt)
			return false;
		/* Admin can edit the debt any time */
		if (Users::is_admin())
			return true;
		/*
		if (date('Y-m-d', strtotime($debt['created_dtm'])) != date('Y-m-d'))
			return false;
		*/
		return Users::can('edit', 'customer_debts');
	}

	function get_details_by_order_id($order_id, $filters = array())
	{
		$filters = array_merge($filters, array('order_id' => $order_id, 'deleted' => 0));
		return self::_select_one($this->table_name, $filters);
	}
}
/* End of generated class */
