<?php
/**
 * Class declaration
 */
class BlockHomePageController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Categories,Products,Menus');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, tooltipster';
        $page_title = 'Block home page';
        $id = $obj = null;
        $js = array(
            ASSET_URL. 'js/block_homepage/mau1.js',
            ASSET_URL. 'js/block_homepage/main.js',
            ASSET_URL . 'js/block_homepage/index.js'
        );
        $products = $this->Products->get_list(array('products.is_additional' => "0"), -1);
        $all_categories = $this->Categories->get_all_sub_categories();
        $categories = $this->Categories->get_list();
        $menus = $this->Menus->get_details_by_code("category-menu");
        $this->_merge_data(compact("page_title", "id" , "obj", "js", 'categories',"all_categories","products","menus"));
        $this->load_page('block_homepage/index');
    }
}
/* End of MenuController class */
