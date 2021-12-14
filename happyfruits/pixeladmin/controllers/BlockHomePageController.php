<?php
/**
 * Class declaration
 */
class BlockHomePageController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        //$this->load_model('Menus, Pages, Categories','Customer');
    }
    
    function index()
    {
        $this->plugins = 'googleapis, validator, icheck';
        $js = array(
            ASSET_URL . 'js/customer/customer.js'
        );
        $page_title = 'Block home page';
        $id = $obj = null;
        // $customer_types = $this->Customers->get_customer_types();
        $this->_merge_data(compact("js", "page_title", "obj", "id"));
        $this->load_page('block_homepage/index.php');
    }
}
/* End of MenuController class */
