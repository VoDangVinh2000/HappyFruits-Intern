<?php

/**
 *
 * -------------------------------------------------------
 * Classname:        Blockhomepage
 * Generation date:  20/01/2015
 * Baseclass:        BaseBlockhomepage
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH . 'models/base/BaseBlockhomepage.php');

/**
 * Class declaration
 */
class Blockhomepage extends BaseBlockhomepage
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Blockhomepage';
    }

    function list_block()
    {
        $sql = 'SELECT * FROM block_homepage';
        return self::_do_sql($sql);
    }

    function getBlockByID($id)
    {
        $prod = new Products;
        $filters = array(
            'select' => 'block_homepage.*',
            'block_homepage.id' => $id,
        );
        $block = $this->select($filters);
        $listProducts = [];
        $arrayProductsID = testABC($this->select($filters));
        foreach ($arrayProductsID[0] as $item) {
           array_push($listProducts, $prod->getProductsById($item));
        }
        return [$block,$listProducts];
    }
}
/* End of generated class */
