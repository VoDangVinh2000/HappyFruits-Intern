<?php

/**
 *
 * -------------------------------------------------------
 * Classname:        Products
 * Generation date:  20/01/2015
 * Baseclass:        BaseProducts
 * -------------------------------------------------------
 *
 */

use phpbb\help\controller\faq;

require_once(ABSOLUTE_PATH . 'models/base/BaseProducts.php');

/**
 * Class declaration
 */
class Products extends BaseProducts
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Products';
    }

    function get_list($filters = array(), $is_hidden = 0)
    {
        $sql = 'SELECT products.*, categories.name as category_name, categories.name_without_utf8 as category_name_without_utf8, categories.english_name as category_english_name
                FROM products
                INNER JOIN categories ON categories.category_id = products.category_id';
        if ($is_hidden != -1 && is_numeric($is_hidden))
            $filters['products.is_hidden'] = $is_hidden;
        $filters['products.deleted'] = 0;
        return self::_do_sql($sql, $filters, array(), 'categories.sequence_number, products.sequence_number');
    }

    function getProductsById($id){
        $filters = array(
            'select' => 'products.*',
            'products.product_id' => $id
        );
        return $this->select($filters);
    }

    function get_list_for_selling($filters = array(), $is_hidden = 0)
    {
        $sql = 'SELECT products.product_id, products.name, products.description, products.code, products.unit, products.name_without_utf8, products.modified_dtm, products.category_id, products.promotion_price, products.enabled, products.free_choice, products.is_box, products.box_discount_rate, products.can_be_added_to_box, products.not_deliver, 
                    categories.name as category_name, categories.name_without_utf8 as category_name_without_utf8, categories.english_name as category_english_name
                FROM products
                INNER JOIN categories ON categories.category_id = products.category_id';
        if ($is_hidden != -1 && is_numeric($is_hidden))
            $filters['products.is_hidden'] = $is_hidden;
        $filters['products.deleted'] = 0;
        $filters['categories.enabled'] = 1;
        return self::_do_sql($sql, $filters, array(), 'categories.sequence_number, products.sequence_number');
    }

    function get_products_for_delivery($filters = array(), $is_hidden = 0, $force_all = 0)
    {
        $sql = 'SELECT products.product_id, products.name, products.english_name, products.name_without_utf8, products.modified_dtm, products.category_id, products.enabled, products.free_choice, products.is_box, products.box_discount_rate, products.can_be_added_to_box, 
					products.type, products.promotion_price, products.image, products.description, products.code, products.unit, products.show_components_on_frontend, 
					products.ribbon_left, products.ribbon_left_color, products.ribbon_right, products.ribbon_right_color, 
                    categories.name as category_name, categories.name_without_utf8 as category_name_without_utf8, categories.english_name as category_english_name, prices.price
                FROM products
                INNER JOIN categories ON categories.category_id = products.category_id
                INNER JOIN prices ON prices.product_id = products.product_id AND prices.type_id = ' . DELIVERY_TYPE_ID;
        if (!$force_all)
            $filters['categories.allow_delivery'] = 1;
        if ($is_hidden != -1 && is_numeric($is_hidden) && !$force_all)
            $filters['products.is_hidden'] = $is_hidden;
        $filters['products.deleted'] = 0;
        if (!$force_all)
            $filters['products.not_deliver'] = 0;
        //$filters['products.enabled'] = 1;
        return self::_do_sql($sql, $filters, array(), 'categories.sequence_number, products.sequence_number');
    }

    function get_products_for_sidebar($filters = array(), $is_hidden = 0, $force_all = 0)
    {
        $sql = 'SELECT products.product_id, products.name, products.english_name, products.name_without_utf8, products.modified_dtm, products.category_id, products.enabled, products.free_choice, products.is_box, products.box_discount_rate, products.can_be_added_to_box, 
					products.type, products.promotion_price, products.image, products.description, products.description_en, products.code, products.unit, products.show_components_on_frontend, 
					products.ribbon_left, products.ribbon_left_color, products.ribbon_right, products.ribbon_right_color, 
                    IF(pc.name IS NULL, categories.name, pc.name) as category_name, IF(pc.name_without_utf8 IS NULL, categories.name_without_utf8, pc.name_without_utf8) as category_name_without_utf8, IF(pc.english_name IS NULL, categories.english_name, pc.english_name) as category_english_name,
                    prices.price, IF(pc.sequence_number IS NULL, categories.sequence_number, pc.sequence_number) as cat_sequence_order
                FROM products
                INNER JOIN categories ON categories.category_id = products.category_id
                LEFT JOIN categories pc ON pc.category_id = categories.parent_id AND categories.parent_id = 2
                INNER JOIN prices ON prices.product_id = products.product_id AND prices.type_id = ' . DELIVERY_TYPE_ID;
        if (!$force_all)
            $filters['categories.allow_delivery'] = 1;
        if ($is_hidden != -1 && is_numeric($is_hidden) && !$force_all)
            $filters['products.is_hidden'] = $is_hidden;
        $filters['products.deleted'] = 0;
        if (!$force_all)
            $filters['products.not_deliver'] = 0;
        //$filters['products.enabled'] = 1;
        return self::_do_sql($sql, $filters, array(), ' cat_sequence_order, products.sequence_number');
    }
    function get_products_in_tag($filters = array(), $is_hidden = 0)
    {
        /* Ordered number 
        $sql = "SELECT products.product_id, products.name, products.english_name, products.category_id, products.description, products.description_en,
                    prices.price, files.path, (SELECT SUM(order_items.quantity) FROM order_items WHERE order_items.product_id = products.product_id) as ordered_number
                FROM products_in_tags
                INNER JOIN products ON products.product_id = products_in_tags.product_id
                LEFT JOIN files ON files.foreign_id = products.product_id AND files.type = 'product_image' AND files.id = (
                        SELECT MIN(f.id)
                        FROM files f 
                        WHERE f.foreign_id = products.product_id AND f.type = 'product_image' 
                        LIMIT 1
                    )
                INNER JOIN categories ON categories.category_id = products.category_id
                INNER JOIN prices ON prices.product_id = products.product_id AND prices.type_id = ".DELIVERY_TYPE_ID;
        */
        $sql = "SELECT products.product_id, products.name, products.english_name, products.category_id, products.enabled, products.free_choice, products.is_box, products.box_discount_rate, products.can_be_added_to_box, products.code, products.unit,
                    products.description, products.description_en, products.promotion_price, products.not_deliver, products.image,
                    prices.price, products.ribbon_left, products.ribbon_left_color, products.ribbon_right, products.ribbon_right_color,
                    products_in_tags.tag_id 
                FROM products_in_tags
                INNER JOIN products ON products.product_id = products_in_tags.product_id
                INNER JOIN categories ON categories.category_id = products.category_id
                INNER JOIN prices ON prices.product_id = products.product_id AND prices.type_id = " . DELIVERY_TYPE_ID;
        //$filters['categories.allow_delivery'] = 1;
        $filters['is_additional'] = 0;
        if ($is_hidden != -1 && is_numeric($is_hidden))
            $filters['products.is_hidden'] = $is_hidden;
        $filters['products.deleted'] = 0;
        if (empty($filters['order_by']))
            $filters['order_by'] = 'products_in_tags.sequence_number, products.sequence_number';
        return self::_do_select_sql($sql, $filters);
    }

    function get_full_details($id)
    {
        $filters = array(
            'select' => 'products.*, categories.name as category_name, categories.name_without_utf8 as category_name_without_utf8, categories.english_name as category_english_name',
            'join' => 'INNER JOIN categories ON categories.category_id = products.category_id
                       INNER JOIN prices ON prices.product_id = products.product_id',
            'products.product_id' => eModel::matchRegexUrl($id)
        );
        return $this->select($filters);
    }

    function get_all_product()
    {
        $filters = array(
            'select' => 'products.*, prices.price,prices.type_id',
            'join' => 'INNER JOIN prices ON prices.product_id = products.product_id',
            'prices.type_id' => 1,
            'products.enabled' => 1,
            'products.is_hidden' => 0,
            'products.deleted' => 0
        );
        return $this->select($filters);
    }
    function get_all_product_by_categoryID($id)
    {
        $filters = array(
            'select' => 'products.*, categories.name as category_name, categories.name_without_utf8 as category_name_without_utf8, categories.english_name as category_english_name,
                        prices.price,prices.type_id',
            'join' => 'INNER JOIN categories ON categories.category_id = products.category_id
                       INNER JOIN prices ON prices.product_id = products.product_id',

            'products.category_id' => eModel::matchRegexUrl($id),
            'categories.allow_delivery' => 1,
            'prices.type_id' => 1,
            'products.enabled' => 1,
            'products.is_hidden' => 0,
            'products.is_additional' => 0,
            'products.not_deliver' => 0,
            'categories.deleted' => 0,
            'products.deleted' => 0
        );
        $filters['order_by'] = 'products.product_id DESC';
        return $this->select($filters);
    }

    //Hàm này chưa đúng
    function get_all_code()
    {
        $sql = "SELECT code FROM products";

        $filters['order_by'] = 'code,image';

        return $this->_do_select_sql($sql, $filters);
    }

    function get_details($id, $filters = array())
    {
        if (USING_SAME_PRICE) {
            $filters = array_merge($filters, array('products.product_id' => $id));
            if (isset($filters['deleted'])) {
                $filters['products.deleted'] = $filters['deleted'];
                unset($filters['deleted']);
            }
            $filters['select'] = 'products.*, prices.price as sell_price';
            $filters['join'] = 'LEFT JOIN prices ON prices.product_id = products.product_id AND prices.type_id = 1';
        } else {
            $filters = array_merge($filters, array($this->primary_key => $id));
        }
        return self::_select_one($this->table_name, $filters);
    }

    function get_product_by_key()
    {
        //SELECT DISTINCT * FROM products WHERE name like "Giỏ Dâu Size 1A" OR code like '%FN%'
        // header('Content-Type:text/html;charset=utf-8');
        $search = "";
        $sql = "";
        if (isset($_POST['key']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $search = eModel::matchRegex_SearchProducts($_POST['key']);
            $sql = "SELECT products.*,prices.price FROM products, prices , categories
            WHERE (products.name LIKE '%" . $search . "%' OR products.code LIKE '%" . $search . "%' 
            OR products.english_name LIKE '%" . $search . "%')
            AND products.product_id = prices.product_id 
            AND categories.category_id = products.category_id
            AND prices.type_id = 1 AND products.enabled = 1 AND products.is_hidden = 0 AND categories.allow_delivery = 1
            AND categories.deleted = 0 AND products.is_additional = 0 AND products.not_deliver = 0 AND categories.enabled = 1
            AND products.deleted = 0
            ORDER BY products.image";
            $filters = "";
            $result = self::_do_sql($sql, $filters);
            if (!empty($result)) {
                return self::_do_sql($sql, $filters);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    function get_relate_products($id)
    {

        //Lấy category_id 
        $sql = "SELECT products.category_id FROM prices 
        INNER JOIN products ON products.product_id = prices.product_id WHERE products.product_id = '" . $id . "' 
        AND products.enabled = 1 AND products.is_hidden = 0 AND prices.type_id = 1 LIMIT 1";

        $filters = "";
        $result = $this->_do_select_sql($sql, $filters);
        //Lấy ra những sản phẩm có category_id là $id
        $query = "";
        if (!empty($result)) {
            foreach ($result as $array) {
                //sản phẩm liên quan ngẫu nhiên
                $totalRows = $this->_do_select_sql("SELECT * FROM products
                INNER JOIN prices ON prices.product_id = products.product_id 
                INNER JOIN categories ON categories.category_id = products.category_id
                WHERE products.category_id = '" . $array['category_id'] . "' AND products.enabled = 1 AND 
                products.is_hidden = 0 AND prices.type_id = 1 AND products.not_deliver = 0
                AND products.is_additional = 0 AND products.deleted = 0
                AND categories.allow_delivery = 1 AND categories.enabled = 1 AND categories.deleted = 0 ", $filters);

                $max = count($totalRows) - 1; // Nếu lỗi thì liên quan đến biến $max
                //vì sản phẩm liên quan tối đa hiện ra 4 sản phẩm, nếu $query select tổng nhỏ hơn 4 thì random offset lại
                $rand_number = rand(0, $max);

                $query = "SELECT * FROM products 
                INNER JOIN prices ON products.product_id = prices.product_id 
                INNER JOIN categories ON categories.category_id = products.category_id
                WHERE products.category_id = '" . $array['category_id'] . "' 
                AND products.enabled = 1 AND products.is_hidden = 0 
                AND products.not_deliver = 0  AND products.is_additional = 0 AND products.deleted = 0
                     AND categories.allow_delivery = 1 AND categories.enabled = 1 AND categories.deleted = 0
                AND prices.type_id = 1 LIMIT $rand_number,4";

                //Lấy ra ngẫu nhiên vị trí của select
                $total = count($this->_do_select_sql($query));
                //Nếu select ngẫu nhiên vị trí nhỏ hơn 4
                if ($total < 4) {

                    $query = "SELECT products.*,prices.price FROM products 
                    INNER JOIN prices ON products.product_id = prices.product_id
                    INNER JOIN categories ON categories.category_id = products.category_id
                     WHERE products.category_id = '" . $array['category_id'] . "' 
                    AND products.enabled = 1 AND products.is_hidden = 0 
                    AND products.not_deliver = 0  AND products.is_additional = 0 AND products.deleted = 0
                     AND categories.allow_delivery = 1 AND categories.enabled = 1 AND categories.deleted = 0
                    AND prices.type_id = 1 LIMIT 4";
                    return $this->_do_select_sql($query, $filters);
                } else { //Ngược lại

                    $query = "SELECT products.*,prices.price FROM products 
                    INNER JOIN prices ON products.product_id = prices.product_id 
                    INNER JOIN categories ON categories.category_id = products.category_id
                    WHERE  products.category_id = '" . $array['category_id'] . "' 
                    AND products.enabled = 1 AND products.is_hidden = 0 
                    AND products.not_deliver = 0  AND products.is_additional = 0 AND products.deleted = 0
                     AND categories.allow_delivery = 1 AND categories.enabled = 1 AND categories.deleted = 0
                    AND prices.type_id = 1 LIMIT $rand_number,4";
                    return $this->_do_select_sql($query, $filters);
                }
            }
        } else {
            return null;
        }
    }
}
/* End of generated class */