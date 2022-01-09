<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        ProductsInBoxes
 * Generation date:  10/05/2020
 * Baseclass:        BaseProductsInBoxes
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseProductsInBoxes.php');

/**
 * Class declaration
 */
class ProductsInBoxes extends BaseProductsInBoxes
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'ProductsInBoxes';
    }

    function get_products($filters = array())
    {
        if(USING_SAME_PRICE){
            $sql = 'SELECT products_in_boxes.*, item.*, prices.price as sell_price
                FROM products_in_boxes
                INNER JOIN products as item ON item.product_id = products_in_boxes.item_id
                INNER JOIN prices ON prices.product_id = item.product_id AND prices.type_id = 1';
        }else{
            $sql = 'SELECT products_in_boxes.*, item.*
                FROM products_in_boxes
                INNER JOIN products as item ON item.id = products_in_boxes.item_id';
        }
        return self::_do_sql($sql, $filters);
    }

    function delete_products($filters = array())
    {
        return self::_delete('products_in_boxes', $filters);
    }
}
/* End of generated class */
