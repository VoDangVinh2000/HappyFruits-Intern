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

require_once(ABSOLUTE_PATH . 'models/base/BasePrices.php');

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
        if ($prices) {
            $rs = array();
            foreach ($prices as $row) {
                $k = $row['product_id'] . '_' . $row['type_id'];
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
    //Lấy ra những sản phẩm có giá từ 200-500 hoặc 500-800 ... hoặc ...
    //Tham số: Ví du là (gia1-14) . Sẽ lấy ra những sản phẩm có category_id là 14 và giá từ .... 
     function get_products_with_price_with_categories($href)
    {
        $str = explode('-',$href);//gia1-14 (split -> -)
        $category_id = 0;
        $strGia = "";
        for($i = 0; $i < count($str); $i++){
            if($i == 0){
                $strGia = $str[$i]; //gia1
            }
            if($i == 1){
                $category_id = $str[$i];//14
                break;
            }
        }
        $gia1 = 0;$gia2 = 0;
        //href = gia-1-14 (1 là 200k-500k, 14 là category_id của bảng products)
        if($strGia == 'gia1'){
            $gia1 = 200;$gia2 = 500;
        }
        else if($strGia == 'gia2'){
            $gia1 = 500;$gia2 = 800;
        }
        else if($strGia == 'gia3'){
            $gia1 = 800;$gia2 = 1000;
        }
        else if($strGia == 'gia4'){
            $gia1 = 1100;$gia2 = 1500;
        }
        else if($strGia == 'gia5'){
            $gia1 = 1600;$gia2 = 2000;
        }
        else if($strGia == 'gia6'){
            $gia1 = 2000;$gia2 = 2500;
        }
        else if($strGia == 'gia7'){
            $gia1 = 2600;$gia2 = 4000;
        }
        $order_by = "";
        $sql = "SELECT products.*, prices.price FROM prices INNER JOIN products ON products.product_id = prices.product_id
                WHERE prices.price BETWEEN '".$gia1."' AND '".$gia2."' AND type_id = 1 
                AND products.category_id = '".$category_id."' AND products.enabled = 1 AND products.is_hidden = 0 ";
        $filters = "";
        return self::_do_sql($sql, $filters, array(), $order_by);
    }
}
/* End of generated class */
