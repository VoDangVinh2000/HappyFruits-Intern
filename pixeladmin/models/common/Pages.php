<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Pages
 * Generation date:  02/06/2015
 * Baseclass:        BasePages
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BasePages.php');

/**
 * Class declaration
 */
class Pages extends BasePages
{
    public static $configFields = array(
        'number_of_cols_in_frontend' => 4,
        'has_voucher_form' => 0,
        'has_package_form' => 0,
        'has_company_request_form' => 0
    );
    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Pages';
    }
    
    function get_all_templates()
    {
        $files = array();
        $templates = get_directory_list(TEMPLATE_FILES_PATH);
        if (!empty($templates))
        {
            foreach($templates as $file)
            {
                if (is_dir(TEMPLATE_FILES_PATH.$file))
                    continue;
                if (!strstr($file, 'template-'))
                    continue;
                $item = array();
                $item['file'] = $file;
                $file = str_replace('.php','', $file);
                $file = ucwords(str_replace(array('_','-'),' ', $file));
                $item['name'] = $file;
                $files[] = $item;
            }
        }
        return $files;
    }
    
    function get_details_by_code($code, $deleted = 0)
    {
        return self::select_one(array('page_code'=>$code, 'deleted' => $deleted, 'enabled' => 1));
    }
}
/* End of generated class */
