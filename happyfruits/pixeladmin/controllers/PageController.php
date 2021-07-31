<?php
/**
 * Class declaration
 */
class PageController extends BaseController
{
    function __construct()
    {
        $this->not_require_logged = array('view');
        parent::__construct();
        $this->load_model('Pages, Categories, Tags');
    }
    
    function index()
    {
        $this->plugins = 'dataTables';
        $js = array(
            ASSET_URL. 'js/page/index.js'
        );
        $page_title = 'Quản lý trang';
        $pages = $this->Pages->get_list(array('deleted' => '0'));
        $this->_merge_data(compact("js", "page_title", "pages"));
        $this->load_page('page/index');
    }
    
    function view()
    {
        $code = str_replace('/','',get('page_code'));
        $language_code = get('lang');
        $obj = $this->Pages->get_details_by_code($code);
        if ($obj)
        {
            if($obj['config'])
                $obj['config'] = json_decode($obj['config'], true);
            else
                $obj['config'] = Pages::$configFields;
            
            $this->data['page_title'] = $obj['page_title'];
            $obj['page_body'] = invokeContentMethods($obj['page_body'], $this);
            $template_name = $obj['page_template']?$obj['page_template']:'template-page.php';
            $this->_merge_data(compact("obj", "language_code"));
            $view_function = str_replace(array('.php','template-'), '', $template_name);
	        init_page($this);
            if(function_exists($view_function))
                $view_function($this);
            $this->data['template'] = $view_function;
            $this->load_template($template_name);
        }
        else
        {
            $routes = array(
                'danh-gia' => 'order_assessment',
                'don-hang' => 'view_order',
                'sua-don-hang' => 'edit_order'
            );
            $template_name = isset($routes[$code])?$routes[$code]:null;
            if($template_name && $this->is_theme_view($template_name)){
                init_page($this);
                if(function_exists($template_name))
                    $template_name($this);
                $this->data['template'] = $template_name;
                $this->data['language_code'] = $language_code;
                $this->load_template($template_name);
            }else{
                header("HTTP/1.1 404 Not Found");
                header("Status: 404 Not Found");
                $this->load_theme_file('404.php');
                //redirect(ROOT_URL.'vi/khong-tim-thay-trang');
            }
        }
    }
    
    function edit()
    {
        $this->plugins = 'validator, ckeditor, icheck';
        $js = array(
            ASSET_URL. 'js/page/page.js'
        );
        $page_title = 'Sửa nội dung trang';
        
        $id = get('id');
        $obj = null;
        if ($id){
            $obj = $this->Pages->get_details($id, array('deleted' => 0));
            if($obj){
                if($obj['config'])
                    $obj['config'] = json_decode($obj['config'], true);
                else
                    $obj['config'] = Pages::$configFields;
            }
        }

        $templates = $this->Pages->get_all_templates();
        $all_categories = $this->Categories->get_all_sub_categories();
        $tags = $this->Tags->get_list(array('deleted' => 0));
        $this->_merge_data(compact("js", "page_title", "obj", "id", "templates", "all_categories", "tags"));
        $this->load_page('page/page');
    }
    
    function add()
    {
        $this->plugins = 'validator, ckeditor, icheck';
        $js = array(
            ASSET_URL. 'js/page/page.js'
        );
        $page_title = 'Thêm trang';
        $id = $obj = null;
        $templates = $this->Pages->get_all_templates();
        $all_categories = $this->Categories->get_all_sub_categories();
        $tags = $this->Tags->get_list(array('deleted' => 0));
        $this->_merge_data(compact("js", "page_title", "obj", "id", "templates", "all_categories", "tags"));
        $this->load_page('page/page');
    }

}
/* End of PageController class */
