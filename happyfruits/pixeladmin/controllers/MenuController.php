<?php
/**
 * Class declaration
 */
class MenuController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Menus, Pages, Categories');
    }
    
    function index()
    {
        $this->plugins = 'sortable-lists, bootstrap-iconpicker, select2';
        $js = array(
            ASSET_URL. 'js/menu/index.js'
        );
        $page_title = 'Quản lý menu';
        $menus = $this->Menus->get_list();
        $pages = $this->Pages->get_list(array('deleted' => '0'));
        $categories = $this->Categories->get_list();
        $this->_merge_data(compact("js", "page_title", "menus", "pages", "categories"));
        $this->load_page('menu/index');
    }
}
/* End of MenuController class */
