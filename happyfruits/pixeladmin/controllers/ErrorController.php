<?php
require_once('BaseController.php');

/**
 * Class declaration
 */
class ErrorController extends BaseController
{
    function __construct()
    {
        $this->not_require_logged = array('index');
        parent::__construct();
    }
    
    function index()
    {
        $page_title = 'Không tìm thấy trang - 404';
        $this->data['page_title'] = $page_title;
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        $this->load_page('error/index', 0);
    }
}
/* End of ErrorController class */
