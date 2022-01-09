<?php
/**
 * Class declaration
 */
class TagController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Tags, Products');
    }
    
    function index()
    {
        $this->plugins = 'jquery-ui, select2, bootstrap-iconpicker, minicolors, imageselector, icheck';
        $js = array(
            ASSET_URL. 'js/tag/index.js'
        );
        $page_title = 'Quản lý nhóm hàng trên giao diện';
        $tags = $this->Tags->get_list(array('deleted' => 0));
        $products = $this->Products->get_list(array('is_additional' => '0'));
        $this->_merge_data(compact("js", "page_title", "tags", "products"));
        $this->load_page('tag/index');
    }
}
/* End of TagController class */
