<?php
/**
 * Class declaration
 */
class PriceController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Products, Categories, Prices');
    }
    
    function index()
    {
        $this->plugins = 'dataTables';
        $js = array(
            ASSET_URL. 'js/price/index.js'
        );
        $page_title = 'Quản lý bảng giá';
        
        $products = $this->Products->get_list(array('products.category_id' => FRUIT_FREE_CHOICES_CAT_ID), -1);
        $prices = $this->Prices->get_array(array('products.category_id' => FRUIT_FREE_CHOICES_CAT_ID));
        
        $price_types = $this->Prices->get_price_types(); 
        //Only get the sub-categories
        $all_categories = $this->Categories->get_all_sub_categories();
        
        $this->_merge_data(compact("js", "page_title", "products", "prices", "price_types", "all_categories"));
        $this->load_page('price/index');
    }
}
/* End of PriceController class */
