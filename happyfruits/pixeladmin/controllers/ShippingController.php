<?php
/**
 * Class declaration
 */
class ShippingController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Users, Customers, Shippingdetails, Orders, Branches');
    }
    
    function index()
    {
        $this->plugins = 'dataTables';
        $js = array(
            ASSET_URL. 'js/shipping/index.js'
        );
        $page_title = 'Quản lý thông tin giao hàng';
        $filter_keyword = get('s');
        $filter = array();

	    if ($filter_keyword && Users::can('search', 'shipping')){
		    $search_str = "(customer_name LIKE '%$filter_keyword%' OR address LIKE '%$filter_keyword%' OR mobile LIKE '%$filter_keyword%' OR username LIKE '%$filter_keyword%' OR orders.code LIKE '%$filter_keyword%' OR orders.id LIKE '%$filter_keyword%')";
		    $filter = array('where' => "($search_str)");
	    }
        elseif (Users::is_member()){
	        $filter = array('where' => "MONTH(date_time) = '".date('m')."' AND YEAR(date_time) = '".date('Y')."'");
	        $filter['users.user_id'] = $this->logged_user['user_id'];
        }else{
            $filter = array('where' => "MONTH(date_time) = '".date('m')."' AND YEAR(date_time) = '".date('Y')."'");
        }
        global $shipping_cost, $shipping_cost2;
        $this->data['shipping_cost'] = $shipping_cost;
        $this->data['shipping_cost2'] = $shipping_cost2;

        $shipping_details = $this->Shippingdetails->get_list($filter);
        $members = $this->Users->get_members(array('users.do_shipping' => 1));

        $this->_merge_data(compact("js", "page_title", "shipping_details", "members", "filter_keyword", "filter"));
        $this->load_page('shipping/index');
    }
    
    function add()
    {
        $this->plugins = 'googleapis, datepicker, chosen, validator, growl';
        $js = array(
            ASSET_URL. 'js/shipping/add.js'
        );
        $page_title = 'Thêm thông tin giao hàng';
        
        $members = '';
        if (Users::can_access($this->view, 'add_new_for_member'))
            $members = $this->Users->get_members();
    
        $customers = $this->Orders->get_customers(array('where' => "orders.`status` != 'Failed' AND DATE(orders.delivery_date) = '".date('Y-m-d')."'", 'is_shipped' => 0), 'orders.delivery_date DESC');
        $customer_types = $this->Customers->get_customer_types();
        $branches = $this->Branches->get_list();
        
        $this->_merge_data(compact("js", "page_title", "members", "customer_types", "customers", "branches"));
        $this->load_page('shipping/add');
    }
    
    function fees()
    {
        $this->plugins = 'dataTables, growl, select2';
        $js = array(
            ASSET_URL. 'js/shipping/fees.js'
        );
        $page_title = 'Quản lý phí giao hàng';
        
        $items = eModel::_select('shipping_fees');

        $this->_merge_data(compact("js", "page_title", "items"));
        $this->load_page('shipping/fees');
    }

    function fees_with_wards()
    {
        $this->plugins = 'dataTables, growl';
        $js = array(
            ASSET_URL. 'js/shipping/fees_with_wards.js'
        );
        $page_title = 'Quản lý phí giao hàng';

        $types = eModel::_select('shipping_fees_with_wards', array('deleted' => 0));

        $this->_merge_data(compact("js", "page_title", "types"));
        $this->load_page('shipping/fees_with_wards');
    }
    
    function statistics()
    {
        $this->plugins = 'dataTables, datepicker';
        $js = array(
            ASSET_URL. 'js/shipping/statistics.js'
        );
        $page_title = 'Thống kê giao hàng';
        
        $statistics_data = $this->Shippingdetails->get_statistics_data(array('start_date' => date('Y-m-01'), 'end_date' => date('Y-m-d')));
        $members = $this->Users->get_members(array('users.do_shipping' => 1));
        $this->_merge_data(compact("js", "page_title", "statistics_data", "members"));
        $this->load_page('shipping/statistics');
    }
}
/* End of ShippingController class */
