<?php
/**
 * Class declaration
 */
class OrderController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Users, Orders, Branches,Customers');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, tooltipster, datepicker, bootstrap3-editable';
        $js = array(
            ASSET_URL. 'js/order/index.js'
        );
        $page_title = 'Quản lý đơn hàng';
        
        $where_str = "DATE(orders.delivery_date) = '".date('Y-m-d')."'";
        if (Users::is_shift_leader())
        {
            $start_h = '00:00:00';
            $end_h = '23:59:59';
            if ($this->logged_user['type_id'] == SHIFT_LEADER_1_TYPE_ID)
                $end_h = SHIFT_SEPARATOR_TIME.':00';
            elseif($this->logged_user['type_id'] == SHIFT_LEADER_2_TYPE_ID)
                $start_h = SHIFT_SEPARATOR_TIME.':01';
            $where_str .= " AND (DATE_FORMAT(delivery_date,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
        }

        if (Users::can('view_all', 'order'))
        
            $orders = $this->Orders->get_list(array('where' => $where_str), 'orders.delivery_date DESC');
        else
            $orders = $this->Orders->get_list(array('where' => $where_str, 'orders.branch_id' => $this->logged_user['branch_id']), 'orders.delivery_date DESC');

        $order_types = $this->Orders->get_order_types();
        $branches = $this->Branches->get_list();
        
        $this->_merge_data(compact("js", "page_title", "orders", "branches", "order_types"));
        $this->load_page('order/index');
    }
    
    function manage($selected_branch_id = '')
    {
        $page_title = 'Đơn hàng đang xử lý';
        $conditions = array('where' => "(DATE(orders.delivery_date) = '".date('Y-m-d')."' OR DATE(orders.delivery_date) = '".date('Y-m-d', strtotime('+1 day'))."' OR DATE(orders.delivery_date) = '".date('Y-m-d', strtotime('-1 day'))."') AND status NOT IN ('Completed', 'Failed')");
        if (!Users::can('view_all', 'order'))
            $conditions['orders.branch_id'] = $this->logged_user['branch_id'];
        $orders = $this->Orders->get_list($conditions, 'orders.delivery_date ASC');
        $branches = $this->Branches->get_list();
        $b_arr = array();
        foreach($branches as $br){
            $b_arr[$br['id']] = $br;
        }
        $shippers = $this->Users->get_members(array('users.do_shipping' => 1));
	    $order_types = $this->Orders->get_order_types();
        $this->_merge_data(compact("page_title", "orders", "branches", "shippers", "selected_branch_id", "b_arr", "order_types"));
        $this->load_view('order/manage');
    }

    function find()
    {
        $this->plugins = 'dataTables, tooltipster, bootstrap3-editable';
        $js = array(
            ASSET_URL. 'js/order/find.js'
        );
        $page_title = 'Tìm đơn hàng';
        $filter_array = array();
        
        if ($keyword = get('keyword'))
            
            //$filter_array = array('where' => "(shipping_info LIKE '%$keyword%')");
      
            // $orders = $this->Orders->get_list($filter_array);
        $orders = $this->Orders->get_listorder_customerID($keyword);
      
         $this->_merge_data(compact("js", "page_title", "orders"));
         $this->load_page('order/find');
    }
}
/* End of OrderController class */
