<?php
/**
 * Class declaration
 */
class ProductController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Products, Categories, Files, Inventoryitemdetails, ProductComponents, ProductsInBoxes');
    }
    
    function index()
    {
        $this->plugins = 'dataTables, tooltipster';
        $js = array(
            ASSET_URL. 'js/product/index.js'
        );
        $page_title = 'Quản lý hàng hóa';
        
        $products = $this->Products->get_list(array('products.is_additional'=>"0"), -1);
        //Only get the sub-categories
        $all_categories = $this->Categories->get_all_sub_categories();
        
        $this->_merge_data(compact("js", "page_title", "products", "all_categories"));
        $this->load_page('product/index');
    }

    function edit()
    {
        $this->plugins = 'icheck, validator, imageselector, jquery-ui, minicolors';
        $js = array(
            ASSET_URL. 'js/product/product.js'
        );
        $page_title = 'Sửa thông tin hàng hóa';
        
        $id = get('id');
        $obj = $images = $components = null;
        if ($id)
            $obj = $this->Products->get_details($id, array('deleted' => 0));
            
        if ($obj)
        {
            //Only get the sub-categories
            $all_categories = $this->Categories->get_all_sub_categories();
            if (!$obj['is_additional'])
                $options = $this->Products->get_list(array('products.is_additional'=>"1", 'products.category_id' => $obj['category_id']));
            $images = $this->Files->get_list(array('type' => 'product_image','foreign_id' => $id));
            $components = $this->ProductComponents->get_components(array('product_components.product_id' => $id));
            $inventory_items = $this->Inventoryitemdetails->get_list(array('is_fruit' => -1));
            if($obj['is_box']){
                $products_in_box = $this->ProductsInBoxes->get_products(array('box_id' => $id));
                $box_items = $this->Products->get_products_for_delivery(array('products.is_additional'=>"0", 'products.can_be_added_to_box' => 1));
            }
        }
        $this->_merge_data(compact("js", "page_title", "obj", "all_categories", "id", "options", "images", "inventory_items", "components"));
        $this->load_page('product/product');
    }
    
    function add()
    {
        $this->plugins = 'icheck, validator, imageselector, jquery-ui, minicolors';
        $js = array(
            ASSET_URL. 'js/product/product.js'
        );
        $page_title = 'Thêm hàng hóa';
        $id = $obj = null;
        $all_categories = $this->Categories->get_all_sub_categories();
        $this->_merge_data(compact("js", "page_title", "obj", "all_categories", "id"));
        $this->load_page('product/product');
    }

    function manage()
    {
        /* Copied from item_list of InventoryfruitsController */
        $this->plugins = 'dataTables';
        $js = array(
            ASSET_URL. 'js/product/manage.js'
        );
        $page_title = 'Quản lý nhanh trái cây';
        $items = $this->Inventoryitemdetails->get_fruits_list();
        $item_types = $this->Inventoryitemdetails->get_fruits_types();
        $this->_merge_data(compact("js", "page_title", "items", "item_types"));
        $this->load_page('product/manage/index');
    }

    function search(){
        $table_name = "products";
        $products = new Products;
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['searchProduct'])) {
        $query_search = $products->get_product_by_key($_GET['input-search']);
        var_dump($query_search);
        }
    }
}
/* End of ProductController class */
