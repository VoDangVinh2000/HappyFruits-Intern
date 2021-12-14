<?php
/**
 * Class declaration
 */
class BlockHomePageController extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        $page_title = 'Block home page';
        $this->_merge_data(compact("page_title"));
        $this->load_page('block_homepage/index');
    }
}
/* End of MenuController class */
