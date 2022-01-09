<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Providers
 * Generation date:  23/04/2017
 * Baseclass:        BaseProviders
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseProviders.php');

/**
 * Class declaration
 */
class Providers extends BaseProviders
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Providers';
    }

	function get_list($filters = array())
	{
		if (!isset($filters['deleted']))
			$filters['deleted'] = 0;
		if (!isset($filters['order_by']))
			$filters['order_by'] = 'provider_name';
		return parent::select($filters);
	}

    function getTypeOptions()
    {
	    $filters = array('is_fruit' => 0, 'deleted' => 0);
	    $item_types = self::_select('inventory_item_types', $filters);
    	$rs = array(
    	    0 => 'Trái cây'
	    );
	    if (!empty($item_types)){
	    	foreach($item_types as $type){
			    $rs[$type['id']] = $type['type_name'];
		    }
	    }
	    $rs[99] = 'Khác';
	    return $rs;
    }
}
/* End of generated class */
