<?php
function init_page(&$controller)
{
    $controller->load_model('Products, Menus, Categories, Prices,Pages, Customers, Blockhomepage');
    $main_menu = $controller->Menus->get_details_by_code('main-menu');
    $category_menu = $controller->Menus->get_details_by_code('category-menu');
    $all_block_home_page = $controller->Blockhomepage->get_all_block_home_page();
    $tiles = $category_menu['items'];
    $page_code = get('page_code');
    $hide_menu_items = 0;
    $controller->load_model('Categories, Tags, Branches, Pages, Announcements');
    //$main_tags = $controller->Tags->get_list(array('deleted' => 0, 'is_main' => 1));
    $main_tags = null; /* Disable main tags view */
    $branches = $controller->Branches->get_list(array('select' => 'id,lat,lng'));
    $main_branch = $controller->Branches->get_details(LHP_BRANCH_ID);
    $categories = $controller->Categories->get_list(array('categories.allow_delivery' => 1, 'categories.parent_id' => 1));
    $homepage = $controller->Pages->get_details_by_code('trang-chu');
    $promotions_with_banner = $controller->Announcements->get_list(array('is_promotion' => 1, 'deleted' => 0, 'enabled' => 1, 'where' => "promotion_image IS NOT NULL AND promotion_image != '' ", 'order_by' => 'id desc', 'limit' => 4));
    $lang = get('lang');
    $cat_products = $products_in_tags = array();
    if (!empty($controller->data['obj'])) {
        $cat_ids = $controller->data['obj']['product_cat_ids'];
        if (!empty($cat_ids)) {
            $cat_products = $controller->Products->get_products_for_sidebar(array(
                'is_additional' => '0',
                'where' => "categories.category_id IN ($cat_ids)"
            ));
        }
        $tag_ids = $controller->data['obj']['tag_ids'];
        if (!empty($tag_ids)) {
            $products_in_tags = $controller->Products->get_products_in_tag(array('where' => "tag_id IN ($tag_ids)"));
            if ($products_in_tags)
                $products_in_tags = Hash::combine($products_in_tags, '{n}.product_id', '{n}', '{n}.tag_id');
        }
    }
    //get_full_details for home page
    $traiCayDacSanViet = $controller->Products->get_all_product_by_categoryID(6);
    $gioTraiCay = $controller->Products->get_all_product_by_categoryID(14);
    $hopTraiCay = $controller->Products->get_all_product_by_categoryID(15);
    $hoaTraiCay = $controller->Products->get_all_product_by_categoryID(8);
    $traiCayNhap = $controller->Products->get_all_product_by_categoryID(12);
    $sanPhamKhac = $controller->Products->get_all_product_by_categoryID(7);

    //get parent_id of categories table to see mega-menu
    $megaMenu_fruit_baskets = $controller->Categories->get_parentId_of_categories(14);
    $megaMenu_hamper_boxFruit = $controller->Categories->get_parentId_of_categories(15);
    $megaMenu_fruit_bouquet = $controller->Categories->get_parentId_of_categories(8);
    $megaMenu_Viet_Nam_Fruit_Special  = $controller->Categories->get_parentId_of_categories(6);
    $megaMenu_fresh_fruit  = $controller->Categories->get_parentId_of_categories(12);
    $megaMenu_orther_products  = $controller->Categories->get_parentId_of_categories(7);
    
   

    //image null
    $imageDefault = get_child_theme_assets_url() . "img/default-product-image.png";
    //get id product
    $id = eModel::matchRegexUrl(get('param2'));//mathRegexurl remove nh???ng k?? t??? kh??ng ph??? ?????nh th??nh ""

    //get product by id
    $product = $controller->Products->get_details($id);

    //relate products
    $relateProducts = $controller->Products->get_relate_products($id);
    
    //get session for function get_history_order_customer
    $history_order_code_completed = $controller->Customers->get_history_order_customer_completed();
    //
    $history_order_code_unfinished = $controller->Customers->get_history_order_customer_unfinished();
    //
    $history_order_code_failed = $controller->Customers->get_history_order_customer_failed();
    //show products with sell_price on mega-menu
    $choose_mega_menu = eModel::matchRegexUrl(get('param2'));
    $get_product_with_mega_menu = $controller->Prices->get_products_with_mega_menu($choose_mega_menu);

    // get key of search function
    $get_product_by_search_key = $controller->Products->get_product_by_key();

    //  
    $controller->_merge_data(compact("main_menu", "hide_menu_items", "main_tags",
    "branches", "main_branch", "categories", "lang", "homepage", "promotions_with_banner",
    "tiles", "all_block_home_page", "page_code", "cat_products", "products_in_tags","traiCayDacSanViet","gioTraiCay","hopTraiCay",
    "hoaTraiCay","traiCayNhap","sanPhamKhac","id","product","imageDefault","megaMenu_fruit_baskets",
    "megaMenu_hamper_boxFruit","choose_mega_menu","get_product_with_mega_menu","relateProducts","megaMenu_fruit_bouquet"
    ,"megaMenu_Viet_Nam_Fruit_Special","megaMenu_fresh_fruit","megaMenu_orther_products"
    ,"get_product_by_search_key","history_order_code_completed","history_order_code_unfinished",
    "history_order_code_failed"));
}

function url_slug($str, $options = array())
{
    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true,
    );

    // Merge options
    $options = array_merge($defaults, $options);

    // Lowercase
    if ($options['lowercase']) {
        $str = mb_strtolower($str, 'UTF-8');
    }

    $char_map = array(
        // Latin
        '??' => 'a', '??' => 'a', '???' => 'a', '??' => 'a', '???' => 'a', '??' => 'a', '???' => 'a', '???' => 'a', '???' => 'a', '???' => 'a', '???' => 'a', '??' => 'a', '???' => 'a', '???' => 'a', '???' => 'a', '???' => 'a', '???' => 'a', '??' => 'd', '??' => 'e', '??' => 'e', '???' => 'e', '???' => 'e', '???' => 'e', '??' => 'e', '???' => 'e', '???' => 'e', '???' => 'e', '???' => 'e', '???' => 'e', '??' => 'i', '??' => 'i', '???' => 'i', '??' => 'i', '???' => 'i', '??' => 'o', '??' => 'o', '???' => 'o', '??' => 'o', '???' => 'o', '??' => 'o', '???' => 'o', '???' => 'o', '???' => 'o', '???' => 'o', '???' => 'o', '??' => 'o', '???' => 'o', '???' => 'o', '???' => 'o', '???' => 'o', '???' => 'o', '??' => 'u', '??' => 'u', '???' => 'u', '??' => 'u', '???' => 'u', '??' => 'u', '???' => 'u', '???' => 'u', '???' => 'u', '???' => 'u', '???' => 'u', '??' => 'y', '???' => 'y', '???' => 'y', '???' => 'y', '???' => 'y'
    );

    // Make custom replacements
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

    // Transliterate characters to ASCII
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }

    // Replace non-alphanumeric characters with our delimiter
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

    // Remove duplicate delimiters
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

    // Truncate slug to max. characters
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

    // Remove delimiter from ends
    $str = trim($str, $options['delimiter']);

    return $str;
}
function page(&$controller)
{
}

function gallery(&$controller)
{
    $controller->load_model('ImagesInGallery');
    $images_in_gallery = $controller->ImagesInGallery->get_full_list(array('gallery_id' => GALLERY_ID));
    // $controller->_merge_data(compact("images_in_gallery", "js", "css"));
    $controller->_merge_data(compact("images_in_gallery"));
}

function home(&$controller)
{
    $announcements = $controller->Announcements->get_list(array('has_sales_time' => 0, 'deleted' => 0, 'enabled' => 1));
    $sales_anns = $controller->Announcements->get_list(array('has_sales_time' => 1, 'deleted' => 0, 'enabled' => 1));
    $controller->_merge_data(compact("announcements", "sales_anns"));
}

function menu(&$controller)
{
    $controller->load_model('Products');
    $all_products = $controller->Products->get_products_for_sidebar(array('is_additional' => '0'));
    $controller->_merge_data(compact("all_products"));
}

function contactForm(&$controller)
{
    return $controller->load_theme_file('forms/contact', 1);
}

function category(&$controller)
{
}

function promotion(&$controller)
{
    $promotions = $controller->Announcements->get_list(array('is_promotion' => 1, 'deleted' => 0, 'order_by' => 'end_dtm DESC, start_dtm DESC, id DESC'));
    $controller->_merge_data(compact("promotions"));
}

function order_assessment(&$controller)
{
    $controller->load_model('Orders');
    $js = array(
        get_theme_assets_url() . 'js/order_assessment.js',
    );

    $page_title = '????nh gi?? ????n h??ng';
    $order_code = get('param2');
    $order = $controller->Orders->get_order($order_code);
    if ($order) {
        $error_msg = '';
        $order_items = $controller->Orders->get_full_order_items($order, $error_msg);
        $order_assessment = $controller->Orders->get_order_assessment($order['id']);
        $controller->_merge_data(compact("js", "page_title", "order", "order_items", "order_assessment"));
    } else {
        $controller->_merge_data(compact("js", "page_title", "order"));
    }
}

function view_order(&$controller)
{
    $controller->load_model('Orders, Products');
    $page_title = 'Xem ????n h??ng';
    $order_code = get('param2');
    $order = $controller->Orders->get_order($order_code);
    if ($order) {
        $error_msg = '';
        $order_items = $controller->Orders->get_full_order_items($order, $error_msg);
        // var_dump($order_items);
        $controller->_merge_data(compact("page_title", "order", "order_items"));
    } else {
        $controller->_merge_data(compact("page_title", "order"));
    }
}


// function view_search(&$controller)
// {

//     $controller->load_model('Products');
//     $page_title = 'Search';
//     $search = $controller->Products->get_product_by_key();
//     $controller->_merge_data(compact("page_title","search"));
// }


function edit_order(&$controller)
{
    $controller->load_model('Orders, Products');
    $is_simple_view = get('param3', false);
    $page_title = 'S???a ????n h??ng';
    $order_code = get('param2');
    $order = $controller->Orders->get_order($order_code);
    if ($order) {
        $error_msg = '';
        $order_items = $controller->Orders->get_full_order_items($order, $error_msg);
        $all_products = $controller->Products->get_products_for_sidebar(array('is_additional' => '0'));
        $controller->_merge_data(compact("page_title", "order", "order_items", "all_products", "is_simple_view"));
    } else {
        $controller->_merge_data(compact("page_title", "order", "is_simple_view"));
    }
}
