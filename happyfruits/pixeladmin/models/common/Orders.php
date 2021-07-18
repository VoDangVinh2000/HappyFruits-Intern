<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Orders
 * Generation date:  20/01/2015
 * Baseclass:        BaseOrders
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseOrders.php');

/**
 * Class declaration
 */
class Orders extends BaseOrders
{
    static $cached = array();
    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Orders';
    }
    
    function _get_cached($key)
    {
        return isset(self::$cached[$key])?self::$cached[$key]:null;
    }
    
    function _set_cached($key, $val)
    {
        self::$cached[$key] = $val;
    }
    
    function _get_key($filters = array(), $types = array())
    {
        return empty($filters)?null:md5(implode('', $filters).implode($types));
    }
    
    function get_list($filters = array(), $order_by = '')
    {
        $sql = 'SELECT orders.*, 
                customers.customer_name, customers.district as customer_district, customers.mobile as customer_mobile, customers.address as customer_address,
                order_types.type_name, order_types.id as order_type_id, order_types.need_customer_details,
                users.fullname as shipper_name, users.type_id as shipper_type_id,
                order_assessments.score, order_assessments.feedback 
                FROM orders
                INNER JOIN order_types ON order_types.id = orders.type_id
                LEFT JOIN customers ON customers.customer_id = orders.customer_id
                LEFT JOIN users ON users.user_id = orders.shipper_id
                LEFT JOIN order_assessments ON order_assessments.order_id = orders.id';
        if (empty($filters['orders.deleted']))
            $filters['orders.deleted'] = 0;
        else if ($filters['orders.deleted'] == -1)
            unset($filters['orders.deleted']);
        return self::_do_sql($sql, $filters, array(), $order_by);
    }
    
    function get_order_types($filters = array(), $deleted = 0)
    {
        if ($deleted != -1)
            $filters['deleted'] = $deleted;
        $filters['order_by'] = 'sequence_number';
        return self::_select('order_types', $filters);
    }
    
    function get_order_items($filters = array())
    {
        $sql = 'SELECT order_items.*, 
                    products.code, products.unit, products.name as product_name, products.english_name as product_english_name, products.description as product_description, products.enabled, products.free_choice, products.is_box, 
                    categories.name as category_name, categories.english_name as category_english_name,
                    orders.customer_id
                FROM order_items
                INNER JOIN orders ON orders.id = order_items.order_id
                INNER JOIN products ON products.product_id = order_items.product_id
                INNER JOIN categories ON categories.category_id = products.category_id';
        $filters['order_items.deleted'] = 0;
        return self::_do_sql($sql, $filters, array(), 'order_items.id');
    }
    /*
     * Retrieving full details for order items, such as, sub order items, box items,..
     */
    function get_full_order_items($order, &$error_msg)
    {
        $error_msg = '';
        if (!is_array($order)) {
            $order = $this->get_order($order);
            if (!$order) {
                $error_msg = 'Mã đơn hàng không chính xác.';
                return false;
            }
        }
        $order_items = $this->get_order_items(array('order_id' => $order['id'], 'where' => "(order_items.belongs_to IS NULL OR order_items.belongs_to = '')"));
        if (!$order_items) {
            $error_msg = 'Dữ liệu bị lỗi. Vui lòng liên hệ chúng tôi. [E1]';
            return false;
        }
        $return_items = array();
        foreach($order_items as $item)
        {
            $item['final_price'] = $item['price'];
            $order_sub_items = $this->get_order_items(array('order_id' => $order['id'], 'order_items.belongs_to' => $item['id']));
            if ($order_sub_items)
            {
                foreach($order_sub_items as $sub_item){
                    $item['sub_items'][$sub_item['id']] = $sub_item;
                    $item['final_price'] += $sub_item['price'];
                }
            }
            else
                $item['sub_items'] = array();
            $item['total_sub_items'] = $order_sub_items?count($order_sub_items):0;
            if(!empty($item['is_box'])){
                $order_box_items = $this->get_order_box_items(array('order_item_id' => $item['id']));
                $item['box_items'] = empty($order_box_items)?0:$order_box_items;
            }else{
                $item['box_items'] = 0;
            }
            $return_items[$item['id']] = $item;
        }
        return $return_items;
    }

    function get_order_box_items($filters = array())
    {
        $sql = 'SELECT order_box_items.*, 
                    products.code, products.unit, products.name as product_name, products.english_name as product_english_name, products.description as product_description, products.enabled, products.free_choice, 
                    categories.name as category_name, categories.english_name as category_english_name
                FROM order_box_items
                INNER JOIN products ON products.product_id = order_box_items.product_id
                INNER JOIN categories ON categories.category_id = products.category_id';
        $filters['order_box_items.deleted'] = 0;
        return self::_do_sql($sql, $filters, array(), 'order_box_items.id');
    }
    
    function get_customers($filters = array(), $order_by = '')
    {
        $sql = 'SELECT customers.*, orders.id as order_id, orders.quantity, orders.total, orders.shipping_info, orders.branch_id, customer_types.long_name as customer_type, orders.delivery_date
                FROM orders
                INNER JOIN customers ON customers.customer_id = orders.customer_id AND customers.deleted = 0
                INNER JOIN customer_types ON customer_types.type_id = customers.type_id';
        $filters['orders.deleted'] = 0;
	    if (empty($filters['orders.type_id']))
	        $filters['orders.type_id'] = 3;
	    elseif($filters['orders.type_id'] == -1)
		    unset($filters['orders.type_id']);
        return self::_do_sql($sql, $filters, array(), $order_by);
    }

    function get_order_assessment($order_id)
    {
        return self::_select_one('order_assessments', array(
            'order_id' => $order_id,
            'deleted' => 0,
            'order_by' => 'created_dtm DESC'
        ));
    }

    function add_order_assessment($data)
    {
        return self::_insert('order_assessments', $data);
    }

    function update_order_assessment($where_params, $set_params)
    {
        return self::_update('order_assessments', $where_params, $set_params);
    }
    
    function get_statistics_data($filters = array(), $types = array())
    {
        $key = $this->_get_key($filters, $types);
        $data = $this->_get_cached($key);
        if ($data !== null)
            return $data;
        $return_arr = array();
        $get_all = empty($types);
        if (!$get_all && !is_array($types))
            $types = array($types);
        if ($get_all || in_array('sold_quantities', $types))
        {
            $sql = 'SELECT order_items.quantity, order_items.product_id, products.name as product_name, categories.name as category_name, categories.category_id, order_types.id as order_type_id, CONCAT(categories.sequence_number, products.sequence_number) as sequence
                    FROM order_items
                    INNER JOIN orders ON orders.id = order_items.order_id AND orders.deleted = 0
                    INNER JOIN order_types ON order_types.id = orders.type_id AND order_types.show_in_statistics = 1
                    INNER JOIN products ON products.product_id = order_items.product_id AND (ISNULL(products.belongs_to) OR products.belongs_to = \'\')
                    INNER JOIN categories ON categories.category_id = products.category_id';
            $rs = self::_do_sql($sql, $filters, array(), 'categories.sequence_number, products.sequence_number');
            if ($rs)
            {
                $quantities = array();
                foreach($rs as $item)
                {
                    $quantity = $item['quantity'];
                    $product_name = $item['product_name'];
                    $category_name = sprintf('%02d', $item['category_id']).' - '.$item['category_name'];
                    $order_type_id = $item['order_type_id'];
                    $key = "$category_name|$product_name";
                    if (empty($quantities[$key]))
                        $quantities[$key] = array();
                    if (empty($quantities[$key][$order_type_id]))
                        $quantities[$key][$order_type_id] = 0;
                    $quantities[$key][$order_type_id] += $quantity;
                }
                $return_arr['sold_quantities'] = $quantities;
            }
            else
                $return_arr['sold_quantities'] = null;
        }
        
        if ($get_all || in_array('orders_totals', $types))
        {            
            if (!empty($filters['products.category_id']) && is_numeric($filters['products.category_id']))
            {
                /*
                $filters['where'] .= 'AND orders.id IN 
                                        (
                                         SELECT o.id 
                                         FROM orders o 
                                         INNER JOIN order_items oi ON oi.order_id = o.id 
                                         INNER JOIN products ON products.product_id = oi.product_id AND (ISNULL(products.belongs_to) OR products.belongs_to = \'\') AND products.category_id = '. $filters['products.category_id'].'
                                        )';
                unset($filters['products.category_id']);
                */
                $sql = 'SELECT order_types.id, SUM(order_items.total) as total, COUNT(DISTINCT orders.id) as number_of_orders
                        FROM order_items
                        INNER JOIN orders ON orders.id = order_items.order_id AND orders.deleted = 0
                        INNER JOIN order_types ON order_types.id = orders.type_id AND order_types.show_in_statistics = 1
                        INNER JOIN products ON products.product_id = order_items.product_id AND (ISNULL(products.belongs_to) OR products.belongs_to = \'\')
                        INNER JOIN categories ON categories.category_id = products.category_id';
            }  
            else
            {
                $sql = 'SELECT order_types.id, SUM(orders.total) as total, COUNT(orders.id) as number_of_orders
                        FROM order_types
                        INNER JOIN orders ON orders.type_id = order_types.id AND orders.deleted = 0';
            }       
            
            
            $rs = self::_do_sql($sql, $filters, array(), 'order_types.sequence_number', 'order_types.id');
            
            if ($rs)
            {
                $totals = array();
                $number_of_orders = array();
                foreach($rs as $item)
                {
                    $totals[$item['id']] = $item['total'];
                    $number_of_orders[$item['id']] = $item['number_of_orders'];
                }
                $return_arr['orders_totals'] = $totals;
                $return_arr['number_of_orders'] = $number_of_orders;
            }
            else
            {
                $return_arr['orders_totals'] = null;
                $return_arr['number_of_orders'] = null;
            }
        }
        $this->_set_cached($key, $return_arr);
        return $return_arr;
    }

    function get_order($id_code){
        if(empty($id_code))
            return '';
	    $order = $this->select_one(array('code' => $id_code));
	    if (empty($order))
		    $order = $this->get_details($id_code);
	    return $order;
    }

    function get_foody_order($id_code){
        return $this->select_one(array('code' => $id_code, 'type_id' => ORDER_TYPE_FOODY_ID));
    }

    static function get_last_modified_order_items($order_id){
	    $row = self::_select_one('order_items', array(
	    	'select' => 'MAX(modified_dtm) as last_modified_dtm',
		    'order_id' => $order_id
	    ));
	    return $row?$row['last_modified_dtm']:null;
    }

    static function get_total_quatity_of_foody($filters = array()){
	    $filters['type_id'] = ORDER_TYPE_FOODY_ID;
	    $rs = self::_do_sql("SELECT SUM(orders.quantity) as sum_of_quantity FROM orders", $filters);
	    if ($rs)
	    {
	    	return $rs[0]['sum_of_quantity'];
	    }
	    return 0;
    }

    function after_update($old, $new){
        if($old['status'] != $new['status'] ){
            if($new['status'] == 'Completed'){
                $customer = self::_select_one('customers', array('customer_id' => $new['customer_id']));
                if($customer){
                    $total_paid = $customer['total_paid'] + $new['total'];
                    self::_update('customers', array('customer_id' => $new['customer_id']), array('total_paid' => $total_paid));
                }
            }elseif($old['status'] == 'Completed'){
                $customer = self::_select_one('customers', array('customer_id' => $new['customer_id']));
                if($customer){
                    $total_paid = $customer['total_paid'] - $new['total'];
                    self::_update('customers', array('customer_id' => $new['customer_id']), array('total_paid' => $total_paid>0?$total_paid:0));
                }
            }
        }
        return true;
    }
}
/* End of generated class */
