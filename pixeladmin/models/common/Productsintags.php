<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Productsintags
 * Generation date:  18/09/2015
 * Baseclass:        BaseProductsintags
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseProductsintags.php');

/**
 * Class declaration
 */
class Productsintags extends BaseProductsintags
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Productsintags';
    }
    
    function get_full_list($filters = array())
    {
        $sql = 'SELECT products_in_tags.*, products.name as product_name, categories.name as category_name
                FROM products_in_tags
                INNER JOIN products ON products.product_id = products_in_tags.product_id
                INNER JOIN categories ON categories.category_id = products.category_id';
        $filters['products_in_tags.deleted'] = 0;
        if (empty($filters['order_by']))
            $filters['order_by'] = 'products_in_tags.sequence_number';
        return self::_do_select_sql($sql, $filters);
    }
}
/* End of generated class */
