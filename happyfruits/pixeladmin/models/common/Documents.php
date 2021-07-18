<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Documents
 * Generation date:  22/05/2015
 * Baseclass:        BaseDocuments
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseDocuments.php');

/**
 * Class declaration
 */
class Documents extends BaseDocuments
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Documents';
    }
    
    function get_list($filters = array(), $order_by = '', $limit = '')
    {
        if (!isset($filters['deleted']))
            $filters['deleted'] = 0;
	    if (!empty($order_by))
		    $filters['order_by'] = $order_by;
	    if (!empty($limit))
		    $filters['limit'] = $limit;
        return parent::select($filters);
    }
    
    function get_details_by_code($code, $deleted = 0)
    {
        return self::select_one(array('code'=>$code, 'deleted' => $deleted));
    }
}
/* End of generated class */
