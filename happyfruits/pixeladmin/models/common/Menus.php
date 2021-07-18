<?php
/**
 *
 * -------------------------------------------------------
 * Classname:        Menus
 * Generation date:  26/06/2020
 * Baseclass:        BaseMenus
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH. 'models/base/BaseMenus.php');

/**
 * Class declaration
 */
class Menus extends BaseMenus
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Menus';
    }

    function get_details_by_code($code)
    {
        $menu = self::select_one(array('code'=>$code));
        $menu['items'] = !empty($menu['items'])?json_decode($menu['items'], true):null;
        if(!empty($menu['items'])){
            foreach($menu['items'] as $index => $menu_item){
                if(!empty($menu_item['cat'])){
                    $menu['items'][$index]['sub_items'] = self::_select('categories', array('parent_id'=>$menu_item['cat'], 'enabled' => 1, 'allow_delivery' => 1, 'order_by' => 'sequence_number'));
                }elseif(!empty($menu_item['page'])){
                    $page = self::_select_one('pages', array('page_code'=>$menu_item['page']));
                    $menu['items'][$index]['sub_items'] = [];
                    if(!empty($page['product_cat_ids'])){
                        $menu['items'][$index]['sub_items'] = self::_select('categories', array('where'=> 'category_id IN ('.$page['product_cat_ids'].')', 'order_by' => 'field(category_id, '.$page['product_cat_ids'].')'));
                    }
                    if(!empty($page['tag_ids'])){
                        $tags = self::_select('tags', array('where'=> 'tag_id IN ('.$page['tag_ids'].')', 'order_by' => 'field(tag_id, '.$page['tag_ids'].')'));
                        $menu['items'][$index]['sub_items'] = array_merge($menu['items'][$index]['sub_items'], $tags);
                    }
                }
            }
        }
        return $menu;
    }
}
/* End of generated class */
