<?php
/**
 * Class declaration
 */
class ProviderController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Providers');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, tooltipster';
        $js = array(
            ASSET_URL. 'js/provider/index.js'
        );
        $page_title = 'Quản lý nhà cung cấp';
            
        $providers = $this->Providers->get_list();
	    $types = $this->Providers->getTypeOptions();
        
        $this->_merge_data(compact("js", "page_title", "providers", "types"));
        $this->load_page('provider/index');
    }
    
    function edit()
    {
        $this->plugins = 'googleapis, validator, icheck';
        $js = array(
            ASSET_URL. 'js/provider/provider.js'
        );
        $page_title = 'Sửa thông tin nhà cung cấp';
        $id = get('id');
        $obj = null;
        if ($id)
            $obj = $this->Providers->get_details($id);
		$types = $this->Providers->getTypeOptions();
        $this->_merge_data(compact("js", "page_title", "obj", "id", "types"));
        $this->load_page('provider/provider');
    }
    
    function add()
    {
        $this->plugins = 'googleapis, validator, icheck';
        $js = array(
            ASSET_URL. 'js/provider/provider.js'
        );
        $page_title = 'Thêm nhà cung cấp';
        $id = $obj = null;
	    $types = $this->Providers->getTypeOptions();
        $this->_merge_data(compact("js", "page_title", "obj","id", "types"));
        $this->load_page('provider/provider');
    }
}
/* End of ProviderController class */
