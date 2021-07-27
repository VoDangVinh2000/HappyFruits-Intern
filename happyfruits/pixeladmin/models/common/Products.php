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

require_once(ABSOLUTE_PATH. 'models/base/BaseProducts.php');

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
                INNER JOIN prices ON prices.product_id = products.product_id AND prices.type_id = '.DELIVERY_TYPE_ID;
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
                INNER JOIN prices ON prices.product_id = products.product_id AND prices.type_id = '.DELIVERY_TYPE_ID;
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
                INNER JOIN prices ON prices.product_id = products.product_id AND prices.type_id = ".DELIVERY_TYPE_ID;
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
            'products.product_id' => $id
        );
        return $this->select($filters);
    }

    /*Intern */
    function get_all_product_by_categoryID($id)
    {
        // $query = "SELECT * FROM `products` pro, categories cat, prices pri WHERE pro.category_id = cat.category_id AND pro.product_id = pri.product_id
        // AND pro.category_id = '".$id."' ";
        // return self::_do_select_sql($query);
        $filters = array(
            'select' => 'products.*, categories.name as category_name, categories.name_without_utf8 as category_name_without_utf8, categories.english_name as category_english_name,
                        prices.price,prices.type_id',
            'join' => 'INNER JOIN categories ON categories.category_id = products.category_id
                       INNER JOIN prices ON prices.product_id = products.product_id ',
            'products.category_id' => $id,
            'prices.type_id' => 1,
            'products.enabled' => 1,
            'products.is_hidden' => 0
        );
        return $this->select($filters);
    }

    function get_details($id, $filters = array())
    {
        if(USING_SAME_PRICE){
            $filters = array_merge($filters, array('products.product_id' => $id));
            if(isset($filters['deleted'])){
                $filters['products.deleted'] = $filters['deleted'];
                unset($filters['deleted']);
            }
            $filters['select'] = 'products.*, prices.price as sell_price';
            $filters['join'] = 'LEFT JOIN prices ON prices.product_id = products.product_id AND prices.type_id = 1';
        }else{
            $filters = array_merge($filters, array($this->primary_key => $id));
        }
        return self::_select_one($this->table_name, $filters);
    }
}
/* End of generated class */
