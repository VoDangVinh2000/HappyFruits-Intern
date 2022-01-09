<?php
/**
 * Class declaration
 */
class UserController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Users, Branches');
    }
    
    function index()
    {
        $this->plugins = 'dataTables';
        $js = array(
            ASSET_URL. 'js/user/index.js'
        );
        $page_title = 'Quản lý người dùng';
        $users = $this->Users->get_list(array('deleted' => 0));
        $user_types = $this->Users->get_user_types();
        $this->_merge_data(compact("js", "page_title", "users", "user_types"));
        $this->load_page('user/index');
    }
    
    function edit()
    {
        $this->plugins = 'icheck, validator, ckeditor';
        $js = array(
            ASSET_URL. 'js/user/user.js'
        );
        $page_title = 'Sửa thông tin người dùng';
        $id = get('id');
        $obj = null;
        if ($id)
            $obj = $this->Users->get_details($id);
        $user_types = $this->Users->get_user_types();
        $branches = $this->Branches->get_list();
        $this->_merge_data(compact("js", "page_title", "obj", "user_types", "branches", "id"));
        $this->load_page('user/user');
    }
    
    function add()
    {
        $this->plugins = 'icheck, validator, ckeditor';
        $js = array(
            ASSET_URL. 'js/user/user.js'
        );
        $page_title = 'Thêm người dùng';
        $id = $obj = null;
        $user_types = $this->Users->get_user_types();
        $branches = $this->Branches->get_list();
        $this->_merge_data(compact("js", "page_title", "obj", "user_types", "branches", "id"));
        $this->load_page('user/user');
    }
    
    function profile()
    {
        $this->plugins = 'icheck, validator';
        $js = array(
            ASSET_URL. 'js/user/profile.js'
        );
        $page_title = 'Thông tin tài khoản';
        $this->_merge_data(compact("js", "page_title"));
        $this->load_page('user/profile');
    }
}
/* End of UserController class */
