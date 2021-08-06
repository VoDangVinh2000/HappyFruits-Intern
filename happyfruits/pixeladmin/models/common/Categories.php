<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Categories
 * Generation date:  20/01/2015
 * Baseclass:        BaseCategories
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseCategories.php');

/**
 * Class declaration
 */
class Categories extends BaseCategories
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Categories';
    }
    
    function get_list($filters = array(), $order_by = 'categories.sequence_number')
    {
        $sql = 'SELECT categories.*, parent.name as parent_name 
                FROM categories
                LEFT JOIN categories parent ON parent.category_id = categories.parent_id';
        $filters['categories.deleted'] = 0;
        return self::_do_sql($sql, $filters, array(), $order_by);
    }
    
    function get_list_with_image($filters = array(), $order_by = 'categories.sequence_number')
    {
        $sql = 'SELECT categories.*, files.path
                FROM categories
                LEFT JOIN files ON files.foreign_id = categories.category_id AND files.type = \'category_image\' AND files.id = (
                        SELECT MIN(f.id)
                        FROM files f 
                        WHERE f.foreign_id = categories.category_id AND f.type = \'category_image\'
                        LIMIT 1
                )';
        $filters['categories.deleted'] = 0;
        return self::_do_sql($sql, $filters, array(), $order_by);
    }

    function get_all_sub_categories($filters = array())
    {
        if(!isset($filters['enabled']))
            $filters['enabled'] = 1;
        if(!isset($filters['deleted']))
            $filters['deleted'] = 0;
        if(!isset($filters['where']))
            $filters['where'] = 'parent_id <> 0';
        if(!isset($filters['order_by']))
            $filters['order_by'] = 'sequence_number';
        return $this->select($filters);
    }

    function get_parentId_of_categories($id){
        //Hàm này để lấy ra danh sách các loại giỏ của 1 loại cha tại bảng category_id
        $filters = array(
            'select' => 'categories.*',
            'categories.parent_id' => $id,
            'categories.enabled' => 1,
        );
        return $this->select($filters);
    }   
}
/* End of generated class */
