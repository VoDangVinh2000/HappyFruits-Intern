<?php

/**
 *
 * -------------------------------------------------------
 * Classname:        Blockhomepage
 * Generation date:  20/01/2015
 * Baseclass:        BaseBlockhomepage
 * -------------------------------------------------------
 *
 */

require_once(ABSOLUTE_PATH . 'models/base/BaseBlockhomepage.php');

/**
 * Class declaration
 */
class Blockhomepage extends BaseBlockhomepage
{

    function __construct()
    {
        parent::__construct();
        $this->class_name = 'Blockhomepage';
    }

    function list_block()
    {
        $sql = 'SELECT * FROM block_homepage';
        return self::_do_sql($sql);
    }

    function get_block_by_id($id)
    {
        $prod = new Products;
        $filters = array(
            'select' => 'block_homepage.*',
            'block_homepage.id' => $id,
        );
        $block = $this->select($filters);
        $listProducts = [];
        $arrayProductsID = testABC($this->select($filters));
        foreach ($arrayProductsID[0] as $item) {
            array_push($listProducts, $prod->getProductsById($item));
        }
        // var_dump($arrayProductsID);
        // var_dump($block, $listProducts);
        // die();
        return [$block, $listProducts];
    }

    function get_all_block_home_page()
    {
        // lấy toàn bộ 
        $result = [];
        $productModel = new Products;
        $menusModel = new Menus;
        $listInfoOfProduct = [];

        $allBlocks = $this->list_block();
        $menus = $menusModel->get_details_by_code("category-menu");

        foreach ($allBlocks as $block) {
            // lấy toàn bộ id product và tạo mảng id.
            $arrayProductsID = null;
            if ($block['products_id'] !== null) {
                $arrayProductsID = explode(',', str_replace(array('"', '[', ']'), '', $block['products_id']));
            }

            // lấy thông tin product
            if ($arrayProductsID !== null) {
                foreach ($arrayProductsID as $id) {
                    array_push($listInfoOfProduct, $productModel->getProductsById($id));
                }
                // thêm danh sách thông tin products vào một block.
                $block['products'] = $listInfoOfProduct;
            } else {
                $block['products'] = null;
            }

            // lấy thông tin category. category_id
            $category = null;
            foreach ($menus['items'] as $item) {
                // Kiểm tra chuổi, nếu id bằng nhau thì lấy và dừng kiểm tra.
                if ($item['cat'] === $block['category_id']."") {
                    $category = $item;
                    break;
                }
            }
            // gán giá trị.
            $block['category'] = $category;

            // tạo dữ liệu một block cho kết quả mong muốn.
            array_push($result, $block);
        }

        return $result;
    }
}
/* End of generated class */
