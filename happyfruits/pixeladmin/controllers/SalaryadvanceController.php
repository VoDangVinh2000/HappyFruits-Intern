<?php
/**
 * Class declaration
 */
class SalaryadvanceController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Salaryadvances');
        $this->load_model('Users');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, datepicker';
        $js = array(
            ASSET_URL. 'js/salary_advance/index.js'
        );
        $page_title = 'Quản lý tạm ứng';
        $records = $this->Salaryadvances->get_list();
        $this->_merge_data(compact("js", "page_title", "records"));
        $this->load_page('salary_advance/index');
    }
    
    function edit()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/salary_advance/salary_advance.js'
        );
        $page_title = 'Sửa tạm ứng';
        $id = get('id');
        $obj = null;
        if ($id)
            $obj = $this->Salaryadvances->get_details($id);
        $members = $this->Users->get_members();
        $this->_merge_data(compact("js", "page_title", "obj", "members", "id"));
        $this->load_page('salary_advance/salary_advance');
    }
    
    function add()
    {
        $this->plugins = 'bootstrap-datetimepicker, validator';
        $js = array(
            ASSET_URL. 'js/salary_advance/salary_advance.js'
        );
        $page_title = 'Thêm tạm ứng';
        $id = $obj = null;
        $members = $this->Users->get_members();
        $this->_merge_data(compact("js", "page_title", "obj", "members", "id"));
        $this->load_page('salary_advance/salary_advance');
    }
}
/* End of SalaryadvanceController class */
