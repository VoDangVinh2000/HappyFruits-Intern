<?php
/**
 * Class declaration
 */
class BlockHomePageController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Menus, Pages, Categories');
    }
    
    function index()
    {
        echo 'block';
    }
}
/* End of MenuController class */
