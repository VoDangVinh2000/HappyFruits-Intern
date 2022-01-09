<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Branches
 * Generation date:  16/03/2017
 * Baseclass:        BaseBranches
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseBranches.php');

/**
 * Class declaration
 */
class Branches extends BaseBranches
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Branches';
    }

    function get_list($filters = array(), $order_by = '', $limit = '')
    {
        if (!isset($filters['deleted']))
            $filters['deleted'] = 0;
	    if (!isset($filters['enabled']))
		    $filters['enabled'] = 1;
	    elseif ($filters['enabled'] == -1)
		    unset($filters['enabled']);
	    if (!empty($order_by))
		    $filters['order_by'] = $order_by;
	    if (!empty($limit))
		    $filters['limit'] = $limit;
        return parent::select($filters);
    }

    public function get_list_with_id_as_key($filters = array(), $order_by = '', $limit = '')
    {
        if (!isset($filters['deleted']))
            $filters['deleted'] = 0;
	    if (!isset($filters['enabled']))
		    $filters['enabled'] = 1;
	    elseif ($filters['enabled'] == -1)
		    unset($filters['enabled']);
        $rs = parent::select($filters, $order_by, $limit);
        $return_arr = array();
        if (!empty($rs)){
            foreach($rs as $r){
                $return_arr[$r['id']] = $r;
            }
        }
        return $return_arr;
    }
}
/* End of generated class */
