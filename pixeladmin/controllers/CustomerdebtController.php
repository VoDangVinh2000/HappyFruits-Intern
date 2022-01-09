<?php
/**
 * Class declaration
 */
class CustomerDebtController extends BaseController
{
    function __construct()
    {
        parent::__construct();
	    $this->load_model('Users, Customerdebts, Providers');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, datepicker';
        $js = array(
            ASSET_URL. 'js/customer_debt/index.js'
        );
        $page_title = 'Quản lý công nợ khách hàng';
        $debts = $this->Customerdebts->get_list(array('where' => "DATE(customer_debts.created_dtm) >= '".date('Y-m-1')."' AND customer_debts.status != 'paid'"));
        $members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
        $this->_merge_data(compact("js", "page_title", "debts", "members"));
        $this->load_page('customer_debt/index');
    }

	function done()
	{
		$this->plugins = 'dataTables, datepicker';
		$js = array(
			ASSET_URL. 'js/customer_debt/index.js'
		);
		$page_title = 'Quản lý công nợ khách hàng đã thanh toán';
		$debts = $this->Customerdebts->get_list(array('where' => "DATE(customer_debts.created_dtm) >= '".date('Y-m-1')."'", 'customer_debts.status' => 'paid'));
		$members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
		$this->_merge_data(compact("js", "page_title", "debts", "members"));
		$this->load_page('customer_debt/done');
	}
    
    function edit()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/customer_debt/customer_debt.js'
        );
        $page_title = 'Sửa công nợ khách hàng';
        $id = get('id');
        if (!Customerdebts::is_editable($id)){
            set_last_error("Bạn không có quyền công nợ khách hàng #$id.");
            redirect();
        }        
        $obj = null;
        if ($id)
            $obj = $this->Customerdebts->get_details($id);
        $members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
        $branches = $this->Branches->get_list();
        $this->_merge_data(compact("js", "page_title", "obj", "members", "branches", "id"));
        $this->load_page('customer_debt/customer_debt');
    }
    
    function add()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/customer_debt/customer_debt.js'
        );
        $page_title = 'Thêm công nợ khách hàng';
        $id = $obj = null;
        $members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
        $branches = $this->Branches->get_list();
        $this->_merge_data(compact("js", "page_title", "obj", "members", "branches", "id"));
        $this->load_page('customer_debt/customer_debt');
    }
}
/* End of CustomerDebtController class */
