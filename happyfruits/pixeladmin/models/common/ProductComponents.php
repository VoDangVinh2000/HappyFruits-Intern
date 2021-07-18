<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        ProductComponents
 * Generation date:  05/08/2019
 * Baseclass:        BaseProductComponents
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseProductComponents.php');

/**
 * Class declaration
 */
class ProductComponents extends BaseProductComponents
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'ProductComponents';
    }

    function get_components($filters = array())
    {
        $sql = 'SELECT product_components.*, inventory_item_types.type_name,
                    inventory_item_details.code, inventory_item_details.name, inventory_item_details.unit, inventory_item_details.type_id
                FROM product_components
                INNER JOIN inventory_item_details ON inventory_item_details.id = product_components.item_id
                INNER JOIN inventory_item_types ON inventory_item_types.id = inventory_item_details.type_id';
        return self::_do_sql($sql, $filters);
    }

    function delete_components($filters = array())
    {
        return self::_delete('product_components', $filters);
    }
}
/* End of generated class */
