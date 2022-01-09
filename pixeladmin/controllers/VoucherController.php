<?php
/**
 * Class declaration
 */
class VoucherController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Vouchers');
        $this->load_model('Users');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, datepicker';
        $js = array(
            ASSET_URL. 'js/voucher/index.js'
        );
        $page_title = 'Quản lý phiếu thu chi';
        $vouchers = $this->Vouchers->get_list(array('where' => "vouchers.date_time >= '".date('Y-m-1')."'"));
        $types = $this->Vouchers->get_types();
        $this->_merge_data(compact("js", "page_title", "vouchers", "types"));
        $this->load_page('voucher/index');
    }
    
    function edit()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/voucher/voucher.js'
        );
        $page_title = 'Sửa phiếu thu chi';
        $id = get('id');
        if (!Vouchers::is_editable($id)){
            set_last_error("Bạn không có quyền sửa phiếu thu chi #$id.");
            redirect();
        }        
        $obj = null;
        if ($id)
            $obj = $this->Vouchers->get_details($id);
        $types = $this->Vouchers->get_types();
        $members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
        $branches = $this->Branches->get_list();
        $this->_merge_data(compact("js", "page_title", "obj", "types", "members", "branches", "id"));
        $this->load_page('voucher/voucher');
    }
    
    function add()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/voucher/voucher.js'
        );
        $page_title = 'Thêm phiếu thu chi';
        $id = $obj = null;
        $types = $this->Vouchers->get_types();
        $members = $this->Users->get_members(array('where' => 'users.type_id > 0'));
        $branches = $this->Branches->get_list();
        $this->_merge_data(compact("js", "page_title", "obj", "types", "members", "branches", "id"));
        $this->load_page('voucher/voucher');
    }
}
/* End of VoucherController class */
