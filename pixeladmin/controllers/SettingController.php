<?php
/**
 * Class declaration
 */
class SettingController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Settings');
    }
    
    function index()
    {
	    $this->plugins = 'bootstrap-datetimepicker, ckeditor';
        $js = array(
            ASSET_URL. 'js/setting/index.js'
        );
        $page_title = 'Quản lý cấu hình';
        $settings = eModel::_select('settings', array('is_hide' => 0, 'order_by' => 'seq_no, id'));
        $settings = Hash::combine($settings, '{n}.id', '{n}', '{n}.category');
        ksort($settings);
        $this->_merge_data(compact("js", "page_title", "settings"));
        $this->load_page('setting/index');
    }
}
/* End of SettingController class */
