<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Files
 * Generation date:  30/05/2015
 * Baseclass:        BaseFiles
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseFiles.php');

/**
 * Class declaration
 */
class Files extends BaseFiles
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Files';
    }
    
    function get_images($params)
    {
        $params['where'] = "(files.type LIKE '%_image')";
        $params['order_by'] = 'files.sequence_number, files.id';
        return $this->get_list($params);
    }
}
/* End of generated class */
