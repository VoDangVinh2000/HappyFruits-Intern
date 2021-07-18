<?php
/**
 * Class declaration
 */
class CategoryController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Categories, Files');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, tooltipster';
        $js = array(
            ASSET_URL. 'js/category/index.js'
        );
        $page_title = 'Quản lý nhóm hàng';
        $categories = $this->Categories->get_list();
        $this->_merge_data(compact("js", "page_title", "categories"));
        $this->load_page('category/index');
    }
    
    function edit()
    {
        $this->plugins = 'icheck, validator, imageselector';
        $js = array(
            ASSET_URL. 'js/category/category.js'
        );
        $page_title = 'Sửa thông tin nhóm hàng';
        
        $id = get('id');
        $obj = $images = null;
        if ($id){
            $obj = $this->Categories->get_details($id, array('deleted' => 0));
            $images = $this->Files->get_list(array('type' => 'category_image','foreign_id' => $id));
        }
            
        $all_categories = $this->Categories->select();
        $this->_merge_data(compact("js", "page_title", "obj", "all_categories", "id", "images"));
        $this->load_page('category/category');
    }
    
    function add()
    {
        $this->plugins = 'icheck, validator';
        $js = array(
            ASSET_URL. 'js/category/category.js'
        );
        $page_title = 'Thêm nhóm hàng';
        $id = $obj = null;
        $all_categories = $this->Categories->select();
        $this->_merge_data(compact("js", "page_title", "obj", "all_categories", "id"));
        $this->load_page('category/category');
    }
}
/* End of CategoryController class */
