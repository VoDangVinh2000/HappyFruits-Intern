<?php
/**
 * Class declaration
 */
class AssessmentController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Assessment, Users');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, tooltipster, download';
        $js = array(
            ASSET_URL. 'js/assessment/index.js'
        );
        $page_title = 'Quản lý đánh giá';
        
        if (Users::is_member())
            $filter = array('where' => "SUBSTR(assessment_date, 1, 7) = '". date('Y-m'). "'", 'users.user_id' => $this->logged_user['user_id']);
        else
            $filter = array('assessment_date' => date('Y-m-d'));
        
        $assessments = $this->Assessment->get_list($filter, 'assessment.assessment_date DESC');
        
        $members = $this->Users->get_members();
        $this->_merge_data(compact("js", "page_title", "members", "assessments"));
        $this->data["assessmentmodel"] = $this->Assessment;
        $this->load_page('assessment/index');
    }
    
    function edit()
    {
        $this->plugins = 'icheck, validator';
        $js = array(
            ASSET_URL. 'js/assessment/edit.js'
        );
        $page_title = 'Sửa thông tin đánh giá';
        $id = get('id');
        $obj = null;
        if ($id)
            $obj = $this->Assessment->get_details($id, array('select' => 'assessment.*, users.fullname','join' => 'INNER JOIN users ON users.user_id = assessment.user_id'));
        $this->_merge_data(compact("js", "page_title", "obj", "id"));
        $this->load_page('assessment/edit');
    }
    
    function add()
    {
        $this->plugins = 'icheck, datepicker, validator';
        $js = array(
            ASSET_URL. 'js/assessment/add.js'
        );
        $page_title = 'Thêm đánh giá';
        $id = $obj = null;
        $is_late = get('is_late');
        if (Users::can_access($this->view, 'add_new_for_member'))
            $members = $this->Users->get_members();
        
        $this->_merge_data(compact("js", "page_title", "obj", "id", "is_late", "members"));
        $this->load_page('assessment/add');
    }

    function add_working_time()
    {
        $this->plugins = 'icheck, datepicker, validator';
        $js = array(
            ASSET_URL. 'js/assessment/add_working_time.js'
        );
        $page_title = 'Thêm chấm công';
        $id = $obj = null;
        $this->_merge_data(compact("js", "page_title", "obj", "id"));
        $this->load_page('assessment/add_working_time');
    }
    
    function calculate_kpi()
    {
        echo $this->Assessment->calculate_kpi();
    }
}
/* End of AssessmentController class */
