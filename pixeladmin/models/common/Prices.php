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

    function get_products_with_mega_menu($href)
    {
        $str = explode('-', $href); //gia-1-14 (split -> -)
        if ($str[0] == 'nhomhang') {
            $category_id = 0;
            $str_split = explode("-", $href);
            if (count($str_split) == 2) { // Kiểm tra khi cắt chuỗi thì vẫn chỉ có nhomhang và id, lenght = 2 mới được xử lý
                for ($i = 0; $i < count($str_split); $i++) {
                    if ($i == 1) {
                        $category_id = $str_split[$i];
                    }
                }
                $order_by = "";
                $sql = "SELECT products.*,prices.price FROM `products` INNER JOIN categories ON categories.category_id = products.category_id 
                        INNER JOIN prices ON prices.product_id = products.product_id AND
                            products.category_id = '" . $category_id . "' 
                            AND products.enabled = 1 AND products.is_hidden = 0 AND prices.type_id =1 
                            AND products.not_deliver = 0 AND categories.allow_delivery = 1 
                            AND products.is_additional = 0 AND categories.deleted = 0 AND categories.enabled = 1 "; //ORDER BY products.image 
                $filters = "";
                return self::_do_sql($sql, $filters, array(), $order_by);
            } else {
                return null;
            }
        } else if ($str[0] == 'gia') {
            $category_id = 0;
            $gia = "";
            $gia1 = 0;
            $gia2 = 0;
            $str_split = explode("-", $href);
            if (count($str_split) == 3) { // Kiểm tra khi cắt chuỗi thì vẫn chỉ có gia và id, lenght = 3 mới được xử lý
                for ($i = 0; $i < count($str_split); $i++) {
                    if ($i == 1) {
                        $gia = $str_split[$i];
                    }
                    if ($i == 2) {
                        $category_id = $str_split[$i];
                    }
                }
                $sql = "";
                $order_by = "";
                $filters = "";
                if ($gia == '1') {
                    $gia1 = 0;
                    $gia2 = 499;
                    $sql = "SELECT products.*, prices.price FROM prices INNER JOIN products ON products.product_id = prices.product_id
                    INNER JOIN categories ON categories.category_id = products.category_id 
                    WHERE prices.price BETWEEN '" . $gia1 . "' AND '" . $gia2 . "' AND prices.type_id = 1 
                    AND products.category_id = '" . $category_id . "' AND products.enabled = 1 AND products.is_hidden = 0 
                    AND products.not_deliver = 0 AND categories.allow_delivery = 1 
                    AND products.is_additional = 0 AND categories.deleted = 0 AND categories.enabled = 1";
                } else if ($gia == '2') {
                    $gia1 = 500;
                    $gia2 = 799;
                    $sql = "SELECT products.*, prices.price FROM prices INNER JOIN products ON products.product_id = prices.product_id
                    INNER JOIN categories ON categories.category_id = products.category_id 
                    WHERE prices.price BETWEEN '" . $gia1 . "' AND '" . $gia2 . "' AND prices.type_id = 1 
                    AND products.category_id = '" . $category_id . "' AND products.enabled = 1 AND products.is_hidden = 0 
                    AND products.not_deliver = 0 AND categories.allow_delivery = 1 
                    AND products.is_additional = 0 AND categories.deleted = 0 AND categories.enabled = 1";
                
                } else if ($gia == '3') {
                    $gia1 = 800;
                    $gia2 = 999;
                    $sql = "SELECT products.*, prices.price FROM prices INNER JOIN products ON products.product_id = prices.product_id
                    INNER JOIN categories ON categories.category_id = products.category_id 
                    WHERE prices.price BETWEEN '" . $gia1 . "' AND '" . $gia2 . "' AND prices.type_id = 1 
                    AND products.category_id = '" . $category_id . "' AND products.enabled = 1 AND products.is_hidden = 0 
                    AND products.not_deliver = 0 AND categories.allow_delivery = 1 
                    AND products.is_additional = 0 AND categories.deleted = 0 AND categories.enabled = 1";
                
                } else if ($gia == '4') {
                    $gia1 = 1000;
                    $gia2 = 1499;
                    $sql = "SELECT products.*, prices.price FROM prices INNER JOIN products ON products.product_id = prices.product_id
                    INNER JOIN categories ON categories.category_id = products.category_id 
                    WHERE prices.price BETWEEN '" . $gia1 . "' AND '" . $gia2 . "' AND prices.type_id = 1 
                    AND products.category_id = '" . $category_id . "' AND products.enabled = 1 AND products.is_hidden = 0 
                    AND products.not_deliver = 0 AND categories.allow_delivery = 1 
                    AND products.is_additional = 0 AND categories.deleted = 0 AND categories.enabled = 1";
                
                } else if ($gia == '5') {
                    $gia1 = 1500;
                    $gia2 = 1999;
                    $sql = "SELECT products.*, prices.price FROM prices INNER JOIN products ON products.product_id = prices.product_id
                    INNER JOIN categories ON categories.category_id = products.category_id 
                    WHERE prices.price BETWEEN '" . $gia1 . "' AND '" . $gia2 . "' AND prices.type_id = 1 
                    AND products.category_id = '" . $category_id . "' AND products.enabled = 1 AND products.is_hidden = 0 
                    AND products.not_deliver = 0 AND categories.allow_delivery = 1 
                    AND products.is_additional = 0 AND categories.deleted = 0 AND categories.enabled = 1";
                
                } else if ($gia == '6') {
                    $gia1 = 2000;
                    $gia2 = 2499;
                    $sql = "SELECT products.*, prices.price FROM prices INNER JOIN products ON products.product_id = prices.product_id
                    INNER JOIN categories ON categories.category_id = products.category_id 
                    WHERE prices.price BETWEEN '" . $gia1 . "' AND '" . $gia2 . "' AND prices.type_id = 1 
                    AND products.category_id = '" . $category_id . "' AND products.enabled = 1 AND products.is_hidden = 0 
                    AND products.not_deliver = 0 AND categories.allow_delivery = 1 
                    AND products.is_additional = 0 AND categories.deleted = 0 AND categories.enabled = 1";
                
                } else if ($gia == '7') {
                    $gia1 = 2500;
                    $gia2 = 3499;
                    $sql = "SELECT products.*, prices.price FROM prices INNER JOIN products ON products.product_id = prices.product_id
                    INNER JOIN categories ON categories.category_id = products.category_id 
                    WHERE prices.price BETWEEN '" . $gia1 . "' AND '" . $gia2 . "' AND prices.type_id = 1 
                    AND products.category_id = '" . $category_id . "' AND products.enabled = 1 AND products.is_hidden = 0 
                    AND products.not_deliver = 0 AND categories.allow_delivery = 1 
                    AND products.is_additional = 0 AND categories.deleted = 0 AND categories.enabled = 1";
                
                }
                else if ($gia == '8') {
                    $gia1 = 3500;
                    $gia2 = 0;
                    $sql = "SELECT products.*, prices.price FROM prices INNER JOIN products ON products.product_id = prices.product_id
                    INNER JOIN categories ON categories.category_id = products.category_id 
                    WHERE prices.price >= 3500 AND prices.type_id = 1 
                    AND products.category_id = '" . $category_id . "' AND products.enabled = 1 AND products.is_hidden = 0 
                    AND products.not_deliver = 0 AND categories.allow_delivery = 1 
                    AND products.is_additional = 0 AND categories.deleted = 0 AND categories.enabled = 1";
                } 
                
                return self::_do_sql($sql, $filters, array(), $order_by);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
/* End of generated class */
