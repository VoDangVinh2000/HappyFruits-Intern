<?php
function init_page(&$controller)
{
    $controller->load_model('Products, Menus, Categories, Prices');
    $main_menu = $controller->Menus->get_details_by_code('main-menu');
    $category_menu = $controller->Menus->get_details_by_code('category-menu');
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
    $promotions_with_banner = $controller->Announcements->get_list(array('is_promotion' => 1,'deleted' => 0, 'enabled' => 1, 'where' => "promotion_image IS NOT NULL AND promotion_image != '' ", 'order_by' => 'id desc', 'limit' => 4));
    $lang = get('lang');
    $cat_products = $products_in_tags = array();
    if(!empty($controller->data['obj'])){
        $cat_ids = $controller->data['obj']['product_cat_ids'];
        if(!empty($cat_ids)){
            $cat_products = $controller->Products->get_products_for_sidebar(array(
                'is_additional' => '0',
                'where' => "categories.category_id IN ($cat_ids)"
            ));
        }
        $tag_ids = $controller->data['obj']['tag_ids'];
        if(!empty($tag_ids)){
            $products_in_tags = $controller->Products->get_products_in_tag(array('where' => "tag_id IN ($tag_ids)"));
            if($products_in_tags)
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
    $megaMenu_fruits_baskets = $controller->Categories->get_parentId_of_categories(14);
    $megaMenu_hamper_boxFruit = $controller->Categories->get_parentId_of_categories(15);
    //get all product by code
    $all_product = $controller->Products->get_all_product();
    
    //image null
    $imageDefault = get_child_theme_assets_url() . "img/default-product-image.png";
    //get id product
    $id = get('param2');

    //get product by id
    $product = $controller->Products->get_details($id);

    //show products with sell_price on mega-menu
    $gia = get('param2');
    $get_product_with_sell_price = $controller->Prices->get_products_with_price_with_categories($gia);

    $controller->_merge_data(compact("main_menu", "hide_menu_items", "main_tags",
    "branches", "main_branch", "categories", "lang", "homepage", "promotions_with_banner",
    "tiles", "page_code", "cat_products", "products_in_tags","traiCayDacSanViet","gioTraiCay","hopTraiCay",
    "hoaTraiCay","traiCayNhap","sanPhamKhac","id","product","imageDefault","all_product","megaMenu_fruits_baskets",
    "megaMenu_hamper_boxFruit","gia","get_product_with_sell_price"));
}

function url_slug($str, $options = array()) {
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
        'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'đ' => 'd', 'é' => 'e', 'è' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e', 'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y'
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
function page(&$controller){}

function gallery(&$controller)
{
    $controller->load_model('ImagesInGallery');
    $images_in_gallery = $controller->ImagesInGallery->get_full_list(array('gallery_id' => GALLERY_ID));
    $controller->_merge_data(compact("images_in_gallery", "js", "css"));
}

function home(&$controller)
{
    $announcements = $controller->Announcements->get_list(array('has_sales_time' => 0,'deleted' => 0, 'enabled' => 1));
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

function category(&$controller){}

function promotion(&$controller)
{
    $promotions = $controller->Announcements->get_list(array('is_promotion' => 1,'deleted' => 0, 'order_by' => 'end_dtm DESC, start_dtm DESC, id DESC'));
    $controller->_merge_data(compact("promotions"));
}

function order_assessment(&$controller)
{
    $controller->load_model('Orders');
    $js = array(
        get_theme_assets_url(). 'js/order_assessment.js',
    );

    $page_title = 'Đánh giá đơn hàng';
    $order_code = get('param2');
    $order = $controller->Orders->get_order($order_code);
    if($order){
        $error_msg = '';
        $order_items = $controller->Orders->get_full_order_items($order, $error_msg);
        $order_assessment = $controller->Orders->get_order_assessment($order['id']);
        $controller->_merge_data(compact("js", "page_title", "order", "order_items", "order_assessment"));
    }else{
        $controller->_merge_data(compact("js", "page_title", "order"));
    }
}

function view_order(&$controller)
{
    $controller->load_model('Orders, Products');
    $page_title = 'Xem đơn hàng';
    $order_code = get('param2');
    $order = $controller->Orders->get_order($order_code);
    if($order){
        $error_msg = '';
        $order_items = $controller->Orders->get_full_order_items($order, $error_msg);
<<<<<<< HEAD
=======
        // var_dump($order_items);
>>>>>>> 6db262671c647aacd52816be66f381eccdaa39d8
        $controller->_merge_data(compact("page_title", "order", "order_items"));
    }else{
        $controller->_merge_data(compact("page_title", "order"));
    }
}

function edit_order(&$controller)
{
    $controller->load_model('Orders, Products');
    $is_simple_view = get('param3', false);
    $page_title = 'Sửa đơn hàng';
    $order_code = get('param2');
    $order = $controller->Orders->get_order($order_code);
    if($order){
        $error_msg = '';
        $order_items = $controller->Orders->get_full_order_items($order, $error_msg);
        $all_products = $controller->Products->get_products_for_sidebar(array('is_additional' => '0'));
        $controller->_merge_data(compact("page_title", "order", "order_items", "all_products", "is_simple_view"));
    }else{
        $controller->_merge_data(compact("page_title", "order", "is_simple_view"));
    }
}