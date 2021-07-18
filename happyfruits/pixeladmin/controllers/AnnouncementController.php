<?php
/**
 * Class declaration
 */
class AnnouncementController extends BaseController
{
    function __construct()
    {
        $this->not_require_logged = array('view');
        parent::__construct();
        $this->load_model('Announcements');
    }
    
    function index()
    {
        $this->plugins = 'dataTables';
        $js = array(
            ASSET_URL. 'js/announcement/index.js'
        );
        $page_title = 'Quản lý thông báo';
        $announcements = $this->Announcements->get_list(array('deleted' => '0'));
        $this->_merge_data(compact("js", "page_title", "announcements"));
        $this->load_page('announcement/index');
    }
    
    function edit()
    {
        $this->plugins = 'validator, ckeditor, icheck, datepicker, timepicker, imageselector';
        $js = array(
            ASSET_URL. 'js/announcement/announcement.js'
        );
        $page_title = 'Sửa nội dung thông báo';
        
        $id = get('id');
        $obj = null;
        if ($id)
            $obj = $this->Announcements->get_details($id, array('deleted' => 0));
        $this->_merge_data(compact("js", "page_title", "obj", "id"));
        $this->load_page('announcement/announcement');
    }
    
    function add()
    {
        $this->plugins = 'validator, ckeditor, icheck, datepicker, timepicker, imageselector';
        $js = array(
            ASSET_URL. 'js/announcement/announcement.js'
        );
        $page_title = 'Thêm thông báo';
        $id = $obj = null;
        $this->_merge_data(compact("js", "page_title", "obj", "id"));
        $this->load_page('announcement/announcement');
    }
}
/* End of AnnouncementController class */
