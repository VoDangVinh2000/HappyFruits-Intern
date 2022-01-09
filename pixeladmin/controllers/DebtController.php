<?php
/**
 * Class declaration
 */
class DebtController extends BaseController
{
    function __construct()
    {
        parent::__construct();
	    $this->load_model('Users, Debts, Providers');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, datepicker';
        $js = array(
            ASSET_URL. 'js/debt/index.js'
        );
        $page_title = 'Quản lý công nợ';
        $debts = $this->Debts->get_list(array('where' => "DATE(debts.created_dtm) >= '2018-07-01' AND debts.status != 'paid'"));
        $types = $this->Debts->get_types();
	    $providers = $this->Providers->get_list();
	    $members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
        $this->_merge_data(compact("js", "page_title", "debts", "types", "providers", "members"));
        $this->load_page('debt/index');
    }

	function done()
	{
		$this->plugins = 'dataTables, datepicker';
		$js = array(
			ASSET_URL. 'js/debt/done.js'
		);
		$page_title = 'Quản lý công nợ đã thanh toán';
		$debts = $this->Debts->get_list(array('where' => "DATE(debts.created_dtm) >= '".date('Y-m-01')."'", 'status' => 'paid'));
		$types = $this->Debts->get_types();
		$providers = $this->Providers->get_list();
		$members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
		$this->_merge_data(compact("js", "page_title", "debts", "types", "providers", "members"));
		$this->load_page('debt/done');
	}
    
    function edit()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/debt/debt.js'
        );
        $page_title = 'Sửa bảng lưu công nợ';
        $id = get('id');
        if (!Debts::is_editable($id)){
            set_last_error("Bạn không có quyền sửa bản lưu công nợ #$id.");
            redirect();
        }        
        $obj = null;
        if ($id)
            $obj = $this->Debts->get_details($id);
        $types = $this->Debts->get_types();
        $members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
        $branches = $this->Branches->get_list();
        $this->_merge_data(compact("js", "page_title", "obj", "types", "members", "branches", "id"));
        $this->load_page('debt/debt');
    }
    
    function add()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/debt/debt.js'
        );
        $page_title = 'Thêm công nợ';
        $id = $obj = null;
        $types = $this->Debts->get_types();
        $members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
        $branches = $this->Branches->get_list();
        $this->_merge_data(compact("js", "page_title", "obj", "types", "members", "branches", "id"));
        $this->load_page('debt/debt');
    }

    function types_list()
    {
	    $this->plugins = 'dataTables, datepicker';
	    $js = array(
		    ASSET_URL. 'js/debt/types.js'
	    );
	    $page_title = 'Quản lý loại công nợ';
	    $types = $this->Debts->get_types();
	    $this->_merge_data(compact("js", "page_title", "types"));
	    $this->load_page('debt/types');
    }

	function edit_type()
	{
		$this->plugins = 'bootstrap-datetimepicker, validator';
		$js = array(
			ASSET_URL. 'js/debt/type.js'
		);
		$page_title = 'Sửa loại công nợ';
		$id = get('id');
		if (!Users::can_access('debt', 'type')){
			set_last_error("Bạn không có quyền sửa loại công nợ #$id.");
			redirect();
		}
		$obj = null;
		if ($id)
			$obj = $this->Debts->get_type_details($id);
		$this->_merge_data(compact("js", "page_title", "obj", "id"));
		$this->load_page('debt/type');
	}

	function add_type()
	{
		$this->plugins = 'bootstrap-datetimepicker, validator';
		$js = array(
			ASSET_URL. 'js/debt/type.js'
		);
		$page_title = 'Thêm loại công nợ';
		$id = $obj = null;
		$this->_merge_data(compact("js", "page_title", "obj", "id"));
		$this->load_page('debt/type');
	}
}
/* End of DebtController class */
