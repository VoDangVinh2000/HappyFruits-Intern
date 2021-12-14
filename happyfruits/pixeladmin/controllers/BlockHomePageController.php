<?php
/**
 * Class declaration
 */
class BlockHomePageController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Categories, Files');
    }
    
    function index()
    {

        $page_title = 'Block home page';
        $id = $obj = null;
        $js = array(
            ASSET_URL. 'js/block_homepage/mau1.js',
            ASSET_URL. 'js/block_homepage/main.js',
        );
        $categories = $this->Categories->get_list();
        $this->_merge_data(compact("page_title", "id", "obj", "js", 'categories'));
        $this->load_page('block_homepage/index');
    }
}
/* End of MenuController class */
