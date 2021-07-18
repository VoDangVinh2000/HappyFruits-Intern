<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Vouchers
 * Generation date:  12/02/2015
 * Baseclass:        BaseVouchers
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseVouchers.php');

/**
 * Class declaration
 */
class Vouchers extends BaseVouchers
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Vouchers';
    }
    
    function get_list($filters = array(), $order_by = 'vouchers.date_time DESC')
    {
        $sql = "SELECT vouchers.*, users.fullname, IF(vouchers.type='receipt','Phiếu thu','Phiếu chi') as voucher_type, branches.branch_name
                FROM vouchers 
                INNER JOIN users ON users.user_id = vouchers.user_id
                INNER JOIN branches ON branches.id = vouchers.branch_id";
        $filters['vouchers.deleted'] = 0;
        return self::_do_sql($sql, $filters, array(), $order_by);
    }
    
    function get_types()
    {
        return array(
            array('code' => 'receipt', 'name' => 'Phiếu thu'),
            array('code' => 'payment', 'name' => 'Phiếu chi')
        );
    }
    
    static function is_editable($voucher_id)
    {
        $voucher = eModel::_select_one('vouchers', array('id' => $voucher_id));
        if (!$voucher)
            return false;
        /* Admin can edit the vouchers everytime */
        $user = get_session_val('user');
        if (in_array($user['type_id'], array(ADMIN_TYPE_ID, SUPER_ADMIN_TYPE_ID)))
            return true;
        if (date('Y-m-d', strtotime($voucher['date_time'])) != date('Y-m-d'))
            return false;

	    return Users::can('edit', 'voucher');
	    /*
        if (in_array($user['type_id'], array(SHIFT_LEADER_1_TYPE_ID, SHIFT_LEADER_2_TYPE_ID)))
            return true;
        return get_shift_id() == get_shift_id($voucher['date_time']);
	    */
    }

    function get_foody_payment($foody_order_id)
    {
    	return $this->select_one(array(
    		'type' => 'payment',
		    'where' => "description LIKE '%Foody #".$foody_order_id."%'"
	    ));
    }

    function delete_foody_payment($foody_order_id)
    {
	    return $this->delete(array(
		    'type' => 'payment',
		    'where' => "description LIKE '%Foody #".$foody_order_id."%'"
	    ));
    }
}
/* End of generated class */
