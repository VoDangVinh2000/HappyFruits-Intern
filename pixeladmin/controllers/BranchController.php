<?php
/**
 * Class declaration
 */
class BranchController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Branches');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, tooltipster';
        $js = array(
            ASSET_URL. 'js/branch/index.js'
        );
        $page_title = 'Quản lý chi nhánh';
        
        $filter_keyword = get('s');
        $filter_array = "";
        if ($filter_keyword)
        {
            $search_str = "(branch_name LIKE '%$filter_keyword%' OR branch_address LIKE '%$filter_keyword%')";
            $filter_array = array('where' => "($search_str)");
        }
            
        $branches = $this->Branches->get_list(array('enabled' => -1));
        
        $this->_merge_data(compact("js", "page_title", "branches", "filter_keyword", "filter_array"));
        $this->load_page('branch/index');
    }
    
    function edit()
    {
        $this->plugins = 'googleapis, validator, icheck';
        $js = array(
            ASSET_URL. 'js/branch/branch.js'
        );
        $page_title = 'Sửa thông tin chi nhánh';
        $id = get('id');
        $obj = null;
        if ($id)
            $obj = $this->Branches->get_details($id);
        $this->_merge_data(compact("js", "page_title", "obj", "id"));
        $this->load_page('branch/branch');
    }
    
    function add()
    {
        $this->plugins = 'googleapis, validator, icheck';
        $js = array(
            ASSET_URL. 'js/branch/branch.js'
        );
        $page_title = 'Thêm chi nhánh';
        $id = $obj = null;
        $this->_merge_data(compact("js", "page_title", "obj", "id"));
        $this->load_page('branch/branch');
    }
}
/* End of BranchController class */
