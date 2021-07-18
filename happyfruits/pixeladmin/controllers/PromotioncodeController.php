<?php
/**
 * Class declaration
 */
class PromotioncodeController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Promotioncodes');
        $this->load_model('Users');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, datepicker';
        $js = array(
            ASSET_URL. 'js/promotion_code/index.js'
        );
        $page_title = 'Quản lý mã khuyến mãi';
        $filter_start_date = date('Y-m-1');
        $filter_end_date = date('Y-m-d');
        $where_str = "((start_date <= '$filter_start_date' AND end_date >= '$filter_start_date 23:59:59') OR (start_date >= '$filter_start_date' AND start_date <= '$filter_end_date 23:59:59'))";
        $promotion_codes = $this->Promotioncodes->get_list(array('where' => $where_str));
        $this->_merge_data(compact("js", "page_title", "promotion_codes"));
        $this->load_page('promotion_code/index');
    }
    
    function edit()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/promotion_code/promotion_code.js'
        );
        $page_title = 'Sửa mã khuyến mãi';
        $id = get('id');
        $obj = null;
        if ($id)
            $obj = $this->Promotioncodes->get_details($id);
        $this->_merge_data(compact("js", "page_title", "obj", "id"));
        $this->load_page('promotion_code/promotion_code');
    }
    
    function add()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/promotion_code/promotion_code.js'
        );
        $page_title = 'Thêm mã khuyến mãi';
        $id = $obj = null;
        $this->_merge_data(compact("js", "page_title", "obj", "id"));
        $this->load_page('promotion_code/promotion_code');
    }
}
/* End of PromotioncodeController class */
