<?php

/**
 * Class declaration
 */
class BlockhomepageController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load_model('Categories,Products,Menus,Blockhomepage');
    }

    function index()
    {
        $js = array(
            ASSET_URL . 'js/block_homepage/indexpage.js',
        );
        $page_title = 'List available themes';
        $all_block = $this->Blockhomepage->list_block();
        if ($all_block == "") {
            $all_block = [];
        }
        $this->_merge_data(compact("page_title", "all_block", "js"));
        $this->load_page('block_homepage/index');
    }

    function edit()
    {
        $this->plugins = 'dataTables, tooltipster';
        $page_title = 'Block home page';
        $id = $obj = null;
        $js = array(
            ASSET_URL . 'js/block_homepage/index.js',
            ASSET_URL . 'js/block_homepage/main.js',
            ASSET_URL . 'js/block_homepage/saveblock.js',
        );
        $products = $this->Products->get_list(array('products.is_additional' => "0"), -1);
        $all_categories = $this->Categories->get_all_sub_categories();
        $categories = $this->Categories->get_list();
        $menus = $this->Menus->get_details_by_code("category-menu");

        $id = get('id');
        $blockID = $this->Blockhomepage->get_block_by_id($id);

        $catOfItems = $this->Menus->getAllCatNumberOfItems();
        $this->_merge_data(compact(
            "page_title",
            "id",
            "obj",
            "js",
            'categories',
            "all_categories",
            "products",
            "menus",
            "catOfItems",
            "blockID"
        ));
        $this->load_page('block_homepage/edit');
    }
}
/* End of MenuController class */
