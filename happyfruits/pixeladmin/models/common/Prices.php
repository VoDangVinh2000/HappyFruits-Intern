<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Prices
 * Generation date:  21/01/2015
 * Baseclass:        BasePrices
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BasePrices.php');

/**
 * Class declaration
 */
class Prices extends BasePrices
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Prices';
    }
    
    function get_array($filters = array())
    {
        $sql = 'SELECT prices.*
                FROM prices
                INNER JOIN products ON products.product_id = prices.product_id';
        $filters['prices.deleted'] = 0;
        $prices = self::_do_sql($sql, $filters, array(), 'type_id');
        if ($prices)
        {
            $rs = array();
            foreach($prices as $row)
            {
                $k = $row['product_id'].'_'.$row['type_id'];
                $rs[$k] = $row;
            }
            return $rs;
        }
        return array();
    }
    
    function get_price_types($filters = array())
    {
        $filters['deleted'] = 0;
        return self::_select('price_types', $filters, 'type_id');
    }
    
}
/* End of generated class */
