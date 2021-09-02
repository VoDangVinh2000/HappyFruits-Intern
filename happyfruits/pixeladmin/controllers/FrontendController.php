<?php
require_once(EFRUIT_ABSOLUTE_PATH. "PHPMailer/sender.php");
require_once('BasePostbackController.php');
/**
 * Class declaration
 */
class FrontendController extends BasePostbackController
{
    function __construct()
    {
        $this->require_logged = 0;
        parent::__construct();
        
        $this->action = request('action');
        $this->load_model('Customers, Products, Prices, Orders, Promotioncodes, Vouchers, ProductComponents, ProductsInBoxes');
    }
    
    /* Get the current discount campaign */
    function get_discount($order_code = ''){
        $apply_discount = '';
        if ($order_code){
            $order = $this->Orders->get_order($order_code);
            if ($order && !empty($order['prebooking_discount'])){
                $apply_discount = array(
                    'start_date' => date('Y-m-d'),
                    'description' => 'Ưu đãi khi đặt trước',
                    'en_description' => 'Discount when pre-ordering',
                    'priority' => '10',
                    'table' => array(
                        '0' => $order['prebooking_discount']
                    ),
                    'is_prebook' => 1
                );
            }
        }
        return $apply_discount;
    }
    
    function get_efruit_delivery_fees_in_short()
    {
        $shipping_fees = eModel::_select_one('shipping_fees', array('id'=>1));
        if ($shipping_fees)
        {
            $rs = array();
            $fees = json_decode($shipping_fees['fee'], true);
            foreach($fees as $district => $d_data) 
            {
                $t_arr = array();
                
                if (!empty($d_data['wards']) && is_array($d_data['wards']))
                {
                    foreach($d_data['wards'] as $ward_name => $ward_data)
                    {
                        if (!isset($t_arr[$ward_data['ward_min']]))
                        {
                            $t_arr[$ward_data['ward_min']] = array(
                                'names' => array($ward_name),
                                'data' => $ward_data
                            );
                        }
                        else
                        {
                            $t_arr[$ward_data['ward_min']]['names'][] = $ward_name;
                        }
                    }
                    if (!empty($t_arr))
                    {
                        ksort($t_arr);
                        $fees[$district]['wards'] = array();
                        foreach($t_arr as $min => $item)
                        {
                            $names = '';
                            $name_arr = $item['names'];
                            sort($name_arr);
                            foreach($name_arr as $n)
                            {
                                if ($names)
                                    $names .= ', ';
                                $names .= $n;
                            }
                            $item['data']['ward_names'] = $names;   
                            $fees[$district]['wards'][$min] = $item['data'];
                        }
                    }
                }
                
            }     
            return $fees;
        }
        else
            return '';
    }
    
    function load_products()
    {
        $page = post('page');
        if (!is_numeric($page) || $page <= 0)
        {
            $this->_error('Invalid page number');
        }
        $tag_id = post('tag_id', 1);
        
        $filters = array(
            'limit' => NUMBER_OF_ITEMS_PER_PAGE,
            'offset' => ($page-1)*NUMBER_OF_ITEMS_PER_PAGE
        );
        if ($tag_id)
            $filters['tag_id'] = $tag_id;
        $products = $this->Products->get_products_in_tag($filters);
        $this->return['products'] = $products;
        $this->return['tag_id'] = $tag_id;
        $this->return['page'] = $page;
        $this->_ok();
    }
    
    function get_data($order_code = '')
    {
        $latest_update_dtm = post('latest_update_dtm');
        $this->return['need_to_update'] = array();
        
        $product_price_modified_dtm = get_lastest_modified_dtm(array('products', 'prices'));
        if (isset($latest_update_dtm['product_price_for_delivery']) && $latest_update_dtm['product_price_for_delivery'] != $product_price_modified_dtm)
        {
            $product_last_modified_dtm = substr($latest_update_dtm['product_price_for_delivery'], 0, 10);
            $price_last_modified_dtm = substr($latest_update_dtm['product_price_for_delivery'], 10);

            $products = $this->Products->get_products_for_delivery(array('is_additional' => '0'), -1);
            if ($products)
            {
                $this->return['products'] = array();
                $price = $this->Prices->select(array('deleted' => 0, 'type_id' => 3));
                $prices = Hash::combine($price, '{n}.product_id', '{n}');

                $components = $this->ProductComponents->get_components(array('active' => 1));
                if($components)
                    $components = Hash::combine($components, '{n}.id', '{n}', '{n}.product_id');

                $box_items = $this->ProductsInBoxes->select();
                if($box_items)
                    $box_items = Hash::combine($box_items, '{n}.id', '{n}', '{n}.box_id');

                foreach($products as $product)
                {
                    if(empty($prices[$product['product_id']]))
                        continue;
                    $price = $prices[$product['product_id']];
                    //Check if any updates
                    if (strtotime($product['modified_dtm']) <= $product_last_modified_dtm &&
                        strtotime($price['modified_dtm']) <= $price_last_modified_dtm)
                        continue;
                    $sub_products = $this->Products->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"));
                    if ($sub_products)
                    {
                        foreach($sub_products as $sp)
                        {
                            unset($sp['modified_dtm']);
                            $product['sub_products'][$sp['product_id']] = $sp;
                        }
                            
                    }
                    else 
                        $product['sub_products'] = array();

                    /* Get components */
                    if($components && isset($components[$product['product_id']]))
                        $product['components'] = $components[$product['product_id']];
                    else
                        $product['components'] = array();

                    /* Get box items */
                    if($box_items && isset($box_items[$product['product_id']]))
                        $product['box_items'] = $box_items[$product['product_id']];
                    else
                        $product['box_items'] = array();

                    unset($product['modified_dtm']);
                    $this->return['products'][] = $product;
                }

                $this->return['need_to_update']['product_price_for_delivery'] = $product_price_modified_dtm;
            }
            else
                error('Hệ thống đang bảo trì, vui lòng gọi trực tiếp cho chúng tôi. Cám ơn bạn.');
        }
        
        if (isset($latest_update_dtm['product_prices']) && $latest_update_dtm['product_prices'] != $product_price_modified_dtm)
        {
            $product_last_modified_dtm = substr($latest_update_dtm['product_prices'], 0, 10);
            $price_last_modified_dtm = substr($latest_update_dtm['product_prices'], 10);
            
            $products = $this->Products->get_list_for_selling(array('is_additional' => '0'), -1);
            if ($products)
            {
                $this->return['products'] = array();

                if(empty($components)){
                    $components = $this->ProductComponents->get_components(array('active' => 1));
                    if($components)
                        $components = Hash::combine($components, '{n}.id', '{n}', '{n}.product_id');
                }

                if(empty($box_items)){
                    $box_items = $this->ProductsInBoxes->select();
                    if($box_items)
                        $box_items = Hash::combine($box_items, '{n}.id', '{n}', '{n}.box_id');
                }

                foreach($products as $product)
                {
                    $prices = $this->Prices->select(array('product_id' => $product['product_id'], 'deleted' => 0, 'order_by' => 'type_id'));
                    $price_array = array();
                    
                    $update = 0;
                    //Check if any updates
                    if ($prices)
                    {
                        foreach($prices as $p)
                        {
                            $price_array[$p['type_id']] = $p['price'];
                            if (strtotime($p['modified_dtm']) > $price_last_modified_dtm)
                                $update = 1;
                        }
                    }
                    if (strtotime($product['modified_dtm']) > $product_last_modified_dtm)
                        $update = 1;
                    if (!$update)
                        continue;
                        
                    //For sub products, all prices are the same
                    $sub_products = $this->Products->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"));
                    if ($sub_products)
                    {
                        foreach($sub_products as $sp)
                        {
                            unset($sp['modified_dtm']);
                            $product['sub_products'][$sp['product_id']] = $sp;
                        } 
                    }
                    else 
                        $product['sub_products'] = array();

                    /* Get components */
                    if($components && isset($components[$product['product_id']]))
                        $product['components'] = $components[$product['product_id']];
                    else
                        $product['components'] = array();

                    /* Get box items */
                    if($box_items && isset($box_items[$product['product_id']]))
                        $product['box_items'] = $box_items[$product['product_id']];
                    else
                        $product['box_items'] = array();
                    
                    $product['prices'] = $price_array;
                    unset($product['modified_dtm']);
                    $this->return['products'][] = $product;
                }
                $this->return['need_to_update']['product_prices'] = $product_price_modified_dtm;
            }
            else
                error('Hệ thống đang bảo trì. Vui lòng gọi trực tiếp cho chúng tôi. Cám ơn bạn.');
        }
        
        $customer_modified_dtm = get_lastest_modified_dtm('customers');
        if (isset($latest_update_dtm['customers']) && $latest_update_dtm['customers'] != $customer_modified_dtm)
        {
            $w_arr = array();
            if ($latest_update_dtm['customers'] != -1)
                $w_arr['where'] = "UNIX_TIMESTAMP(customers.modified_dtm) >= ".$latest_update_dtm['customers'];
            $this->return['customers'] = $this->Customers->get_list_for_selling($w_arr);
            $this->return['need_to_update']['customers'] = $customer_modified_dtm;
        }
        
        $order_type_modified_dtm = get_lastest_modified_dtm('order_types');
        if (isset($latest_update_dtm['order_types']) && $latest_update_dtm['order_types'] != $order_type_modified_dtm)
        {
            $order_types = $this->Orders->get_order_types();
            $this->return['order_types'] = array();
            if ($order_types)
                foreach($order_types as $t)
                    $this->return['order_types'][$t['id']] = $t;
            $this->return['need_to_update']['order_types'] = $order_type_modified_dtm;
        }

        $this->return['shipping_fees'] = get_new_shipping_fees();
        
        //$this->return['efruit_delivery_fees_in_short'] = $this->get_efruit_delivery_fees_in_short();
        $this->return['discount_details'] = $this->get_discount($order_code);
        $this->return['server_dtm'] = time()*1000; // miliseconds
        $this->return['tasteOptions'] = get_taste_options();
        $this->_ok();
    }

    function get_order()
    {
        $code = post('code');
        $order = $this->Orders->get_order($code);
        if (!$order)
            $this->_error('Mã đơn hàng không chính xác.');
        $error_msg = '';
        $order_items = $this->Orders->get_full_order_items($order, $error_msg);
        if ($error_msg)
            $this->_error($error_msg);

        $customer = $order['shipping_info']?json_decode($order['shipping_info']):null;
        if ($customer){
            if (isset($customer->free_ship))
                $customer->free_ship = intval($customer->free_ship);
            else
                $customer->free_ship = 0;
        }
        unset($order['compressed_data']);
        $this->return['order'] = $order;
        $this->return['order_items'] = $order_items;
        $this->return['customer'] = $customer;
        $this->get_data($code);
        $this->_ok();
    }
    
    function save_order()
    {
        /* No captcha
        if (empty($_REQUEST[CAPTCHA_NAME])){
            $this->_error('Có lỗi xảy ra, vui lòng tải lại trang. Xin cám ơn.');
        }
        if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST[CAPTCHA_NAME])) != $_SESSION['captcha']) {
            $e_msg = date('Y-m-d H:i:s');
            try {
                if (empty($_SESSION['captcha']))
                    $e_msg .= " - SESSION không hoạt động, mã nhập: '". trim(strtolower($_REQUEST[CAPTCHA_NAME]))."'";
                else
                    $e_msg .= " - Mã bảo vệ đã nhập '". trim(strtolower($_REQUEST[CAPTCHA_NAME]))."' so với '". $_SESSION['captcha']. "'";
                
            } catch (Exception $e) {
                $e_msg .= 'Caught exception: '.  $e->getMessage(). "\n";
            }
            $e_msg .= "\nIP: " . $_SERVER["REMOTE_ADDR"]. "\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
            debug("$e_msg \n");
        }
        else{
            $e_msg = date('Y-m-d H:i:s');
            try {
                $e_msg .= " - Mã bảo vệ đã nhập '". trim(strtolower($_REQUEST[CAPTCHA_NAME]))."' so với '". $_SESSION['captcha']. "'";
            } catch (Exception $e) {
                $e_msg .= 'Caught exception: '.  $e->getMessage(). "\n";
            }
            $e_msg .= "\nIP: " . $_SERVER["REMOTE_ADDR"]. "\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
            debug("$e_msg \n");
            //unset($_SESSION['captcha']);
        }
        */
        $this->_beginTransaction();
        $language = post('language');
        $ids = post('ids');
        $quantity = post('quantity');
        $custom = post('custom');
        $customer = post('customer');
        $description = strip_tags(post('description'));
        $shipping_description = strip_tags(post('shipping_description'));
        $delivery_datetime = post('delivery_datetime');
        $promotion_code = strip_tags(post('promotion_code'));
        $discount_amount = post('discount_amount', 0);
        $payment_method = post('payment_method');
        $vat = post('VAT', 0);
        $boxes = post('boxes');
        $is_valid_delivery_time = is_valid_delivery_time($delivery_datetime);
        if (!empty($delivery_datetime))
        {
            if (!$is_valid_delivery_time)
            {
                if ($language == 'en')
                    $this->_error('We cannot deliver your order on your expected time. Please change the time (9h - 21h).');
                else
                    $this->_error('Giờ giao hàng không phù hợp, quý khách vui lòng chọn lại giờ giao hàng (9h - 21h).');
            }
        }
        $order_code = post('code');
        
        $customer_id = '';
        $free_ship = 0;
        if ($customer)
        {
	        $customer = json_decode(strip_tags(json_encode($customer)), true);
            $customer_data = array();
            $customer_data['mobile'] = str_replace('+', '', $customer['mobile']);
            if(isset($_SESSION['user_account'])){
                $customer_data['username'] = str_replace('+', '',$_SESSION['user_account'][0]['username']);
            }
            else{
                $customer_data['username'] = str_replace('+', '','');
            }
         
            if (strpos($customer_data['mobile'], '84') === 0)
                $customer_data['mobile'] = substr($customer_data['mobile'], 2);
            if (strpos($customer_data['mobile'],'0') !== 0)
                $customer_data['mobile'] = '0'. $customer_data['mobile'];
            if (intval($customer_data['mobile']) == 0)
            {
                $existed_customer = 0;
                $customer_data['mobile'] = 0;
            }
            else   
                $existed_customer = $this->Customers->select_one(array('or' => array("mobile" => $customer_data['mobile']
                ,"username" => $customer_data['username'] ), 'deleted' => 0));
            if ($existed_customer)
            {
                $customer_id = $existed_customer['customer_id'];
                $free_ship = !empty($existed_customer['free_ship'])?1:0;
	            if (!empty($customer['email']))
	                $this->Customers->update($customer_id, array('email' => $customer['email']));
            }
            else
            {
                $address = capitalize(str_replace(', Việt Nam', '', strip_tags($customer['address'])));
                // Creates new customer
                if($customer['fullname'])
                    $customer_data['customer_name'] = capitalize(strip_tags($customer['fullname']));
                else
                    $customer_data['customer_name'] = customer_name_from_address($address);
                $customer_data['address'] = $address;
                $customer_data['district'] = $customer['district'];
                $customer_data['email'] = $customer['email'];
                $customer_data['type_id'] = 1; // eFruit type
                
                $customer_data['modified_by'] = Users::get_userdata('user_id', null);
                $customer_data['created_dtm'] = date('Y-m-d H:i:s');;
                /*
                if (empty($customer_data['lat']) || empty($customer_data['lng']))
                {
                    $geo = get_geo($customer_data['address']. ' Quận '. $customer_data['district']);
                    
                    if(!$geo)
                    {
                        $geo = get_geo($customer_data['address']. ' Hồ Chí Minh');
                        if ($geo)
                        {
                            $county = $geo->getCounty();
                            $county = str_replace('Quận','', $county);
                            $county = str_replace('District','', $county);
                            $customer_data['district'] = trim($county);
                        }
                    }
                    if($geo)
                    {
                        $customer_data['lat'] = $geo->getLatitude();
                        $customer_data['lng'] = $geo->getLongitude();
                    }
                }
                */
                $customer_id = $this->Customers->insert($customer_data);
            }
            $distance = empty($customer['distance'])?0:$customer['distance'];
            if ($distance > MAX_DISTANCE){
                if ($language == 'en')
                    $this->_error("Sorry. We do not serve in distance greater than ".MAX_DISTANCE."km.");
                else
                    $this->_error("Xin lỗi. Cửa hàng không phục vụ ở khoảng cách lớn hơn ".MAX_DISTANCE."km.");
            }else if($distance <= 0){
                if ($language == 'en')
                    $this->_error("Please select your location.");
                else
                    $this->_error("Vui lòng chọn chính xác vị trí của bạn.");
            }
            $mobile = $customer_data['mobile'];
        }
        //$ids =  implode(',', $ids);
        $product_ids = array();
        foreach($ids as $key => $val)
        {
            $keys = explode('|', $key);
            $product_id = array_pop($keys);
            if (!in_array($product_id, $product_ids))
                $product_ids[] = $product_id;
        }
        $products = $this->Products->get_products_for_delivery(array('where'=>"products.product_id IN (".implode(',', $product_ids).")"), -1);
        if($products)
        {
            if ($order_code)
            {
                $order = $this->Orders->select_one(array('code' => $order_code));
                if (!$order)
                {
                    if ($language == 'en')
                        $this->_error('Unknown error occurs. Please re-order or contact us via phone number.');
                    else
                        $this->_error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
                }
                $order_id = $order['id'];
                // Remove all old order items
                eModel::_do_sql('DELETE order_box_items FROM order_box_items JOIN order_items ON order_items.id = order_box_items.order_item_id WHERE order_items.order_id = '.$order_id);
                eModel::_delete('order_items', array('order_id' => $order_id));
                if($is_valid_delivery_time)
                {
                    if (!$this->Orders->update($order_id, array('delivery_date' => date('Y-m-d H:i:s', $delivery_datetime))))
                    {
                        if ($language == 'en')
                            $this->_error('Unknown error occurs. Please re-order or contact us via phone number.');
                        else
                            $this->_error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
                    }
                }
            }
            else
            {
                $now = date('Y-m-d H:i:s');
                $order_details = array(
                    'customer_id' => $customer_id,
                    'created_dtm' => $now,
                    'pickup_time' => $is_valid_delivery_time?date('Y-m-d H:i:s', $delivery_datetime - 1800):date('Y-m-d H:i:s', strtotime('+60 minutes')),
                    'delivery_date' => $is_valid_delivery_time?date('Y-m-d H:i:s', $delivery_datetime):date('Y-m-d H:i:s', strtotime('+90 minutes')),
                    'type_id' => 3,
                    'VAT' => $vat,
                    'payment_method' => $payment_method
                );
                $order_id = $this->Orders->insert($order_details);
                if (!$order_id)
                {
                    if ($language == 'en')
                        $this->_error('Unknown error occurs. Please re-order or contact us via phone number.');
                    else
                        $this->_error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
                }

	            $this->Customers->update($customer_id, array('last_order_dtm' => $now));
            }
            
            $tasteOptions = get_taste_options();
            $product_arr = array();
            foreach($products as $product)
            {
                $sub_products = $this->Products->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"), -1);
                if ($sub_products)
                {
                    foreach($sub_products as $sp)
                        $product['sub_products'][$sp['product_id']] = $sp;
                }
                else 
                    $product['sub_products'] = array();
                $product_arr[$product['product_id']] = $product;
                
            }    
            
            $subtotal = $total = $shipping_fee = $total_quantity = 0;
                            
            foreach($ids as $key => $sub_ids)
            {
                $custom_info = isset($custom[$key])?$custom[$key]:'';
                $keys = explode('|', $key);
                $product_id = array_pop($keys);
                $item = $product_arr[$product_id];
                
                $item_description = '';
	            /*
                if(!empty($custom_info['size']))
                {
                    if (!empty($item['sub_products'][$custom_info['size']]))
                        $item_description .= $item['sub_products'][$custom_info['size']]['name'];
                }
                if (!empty($custom_info['subItems']) && is_array($custom_info['subItems']))
                {
                    foreach($custom_info['subItems'] as $s_id => $q)
                    {
                        if (!empty($item['sub_products'][$s_id]))
                        {
                            if ($item_description)
                                $item_description .= ', ';
                            $item_description .= ($q. ' '. $item['sub_products'][$s_id]['name']);
                        }
                    }
                }
	            */
	            if($custom_info){
                    if(isset($custom_info['taste']) && $custom_info['taste'] != 6 && !empty($tasteOptions[$custom_info['taste']]))
                    {
                        if ($item_description)
                            $item_description .= '. ';
                        $item_description .= 'Khẩu vị: '. $tasteOptions[$custom_info['taste']];
                    }
                    if(!empty($custom_info['description']))
                    {
                        if ($item_description)
                            $item_description .= '. ';
                        $item_description .= $custom_info['description'];
                    }
                }
                
                $order_items = array();
                $order_items['order_id'] = $order_id;
                $order_items['product_id'] = $product_id;
                $order_items['quantity'] = $quantity[$key];
                $order_items['description'] = $item_description;
                $order_items['custom'] = json_encode($custom_info);
                if ($item['promotion_price'] > 0)
                    $order_items['price'] = $item['promotion_price'];
                else
                    $order_items['price'] = $item['price'];
                if($item['is_box'] && !empty($custom_info['boxTotal'])){
                    /* Using box total instead */
                    $order_items['price'] = $custom_info['boxTotal'];
                }
                $order_items['total'] = $order_items['price']*$order_items['quantity'];
                $order_items['created_dtm'] = date('Y-m-d H:i:s');
                $subtotal += $order_items['total'];
                $total_quantity += $order_items['quantity'];
                $order_item_id = eModel::_insert('order_items', $order_items);
                if(!$order_item_id)
                {
                    if ($language == 'en')
                        $this->_error('Unknown error occurs. Please re-order or contact us via phone number.');
                    else
                        $this->_error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
                }
                elseif(!empty($sub_ids) && is_array($sub_ids))
                {
                    foreach($sub_ids as $sub_product_id)
                    {
                        $order_sub_items = array();
                        $order_sub_items['order_id'] = $order_id;
                        $order_sub_items['belongs_to'] = $order_item_id;
                        $order_sub_items['product_id'] = $sub_product_id;
                        $order_sub_items['quantity'] = $quantity[$key];
                        $order_sub_items['price'] = $item['sub_products'][$sub_product_id]['price'];
                        $order_sub_items['total'] = $order_sub_items['price']*$order_sub_items['quantity'];
                        $order_sub_items['created_dtm'] = date('Y-m-d H:i:s');
                        $subtotal += $order_sub_items['total'];
                        //$total_quantity += $order_sub_items['quantity'];
                        $sub_item_id = eModel::_insert('order_items', $order_sub_items);
                        if(!$sub_item_id)
                        {
                            if ($language == 'en')
                                $this->_error('Unknown error occurs. Please re-order or contact us via phone number.');
                            else
                                $this->_error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
                        }
                    }
                }

                if(!empty($boxes[$product_id]) && is_array($boxes[$product_id])){
                    $box_items = $boxes[$product_id];
                    foreach($box_items as $box_item_id => $data){
                        $order_box_item = array();
                        $order_box_item['order_item_id'] = $order_item_id;
                        $order_box_item['product_id'] = $box_item_id;
                        $order_box_item['unit'] = $data['unit'];
                        $order_box_item['quantity'] = $data['quantity'];
                        $order_box_item['discount_rate'] = getvalue($item, 'box_discount_rate', 0);
                        $order_box_item['price'] = $data['price'];
                        $order_box_item['total'] = round($data['price']*(100-getvalue($item, 'box_discount_rate', 0))/100*$order_box_item['quantity'],2);
                        $order_box_item['created_dtm'] = date('Y-m-d H:i:s');
                        eModel::_insert('order_box_items', $order_box_item);
                    }
                }
            }
            
            //Discount calculating
            if ($promotion_code)
            {
                $code_details = $this->Promotioncodes->select_one(array('code' => $promotion_code));
                if (!$code_details)
                    $this->_error('Mã khuyến mãi không chính xác.');
                $now = time();
                if (strtotime($code_details['start_date']) > $now)
                    $this->_error('Mã khuyến mãi của bạn chưa tới thời gian áp dụng.');
                if (strtotime($code_details['end_date']) < $now)
                    $this->_error('Mã khuyến mãi của bạn đã hết thời hạn sử dụng.');
                $discount_amount = $subtotal*$code_details['discount'];
                /*
                if (!empty($mobile))
                {
                    $applied_orders = $this->Orders->select_one(array('where' => "shipping_info LIKE '%$mobile%'",'promotion_code' => $promotion_code));
                    if ($applied_orders)
                        $this->_error('Mã khuyến mãi đã được sử dụng cho SĐT này.');
                }
                */
            }
            else
            {
                $discount_details = $this->get_discount();
                if ($discount_details)
                {
                    $discount_table = $discount_details['table'];
                    if (!empty($discount_table) && is_array($discount_table))
                    {
                        foreach($discount_table as $min => $val)
                        {
                            if ($subtotal >= $min)
                            {
                                $val = floatval($val);
                                if ($val < 1)
                                    $discount_amount = $subtotal*$val;
                                else
                                    $discount_amount = $val;
                                break;
                            }
                        }
                    }
                }
            }
            
            /* Override discount if pre-booking discount is greater than normal discount */
            if ($is_valid_delivery_time){
                $prebooking_discount = $discount_amount/$subtotal;
                /*
                if (!empty($order) && $order['prebooking_discount']){
                    $discount_amount = $subtotal*$order['prebooking_discount'];
                    $prebooking_discount = $order['prebooking_discount'];
                }
                else if($subtotal*PRE_BOOKING_DISCOUNT > $discount_amount){
                    $prebooking_discount = PRE_BOOKING_DISCOUNT;
                    $discount_amount = $subtotal*PRE_BOOKING_DISCOUNT;
                }
                */
            }

            $vat_amount = $vat*($subtotal - $discount_amount);
            $current_total = $subtotal - $discount_amount + $vat_amount;

            if ($current_total < MIN_TOTAL){
                if ($language == 'en')
                    $this->_error("The minimum total order is ".MIN_TOTAL.".000đ. Please order more.");
                else
                    $this->_error("Tổng đơn hàng thấp nhất để giao hàng là ".MIN_TOTAL.".000đ. Vui lòng đặt hàng thêm.");
            }

            $shipping_fee = cal_shipping_fee($current_total, $customer['district'], $distance);


            if ($free_ship)
                $shipping_fee = 0;
            if ($order_code)
                $code = $order_code;
            else
            	$code = get_next_id('e');
	        //$code = 'e' . rand(1,9) . dechex(intval($order_id)). rand(0,9);
            if ($shipping_description)
                $customer['description'] = $shipping_description;
            $update_data = array(
                'subtotal' => $subtotal,
                'shipping_fee' => $shipping_fee,
                'shipping_info' => json_encode($customer, JSON_UNESCAPED_UNICODE),
                'discount' => $discount_amount,
                'quantity' => $total_quantity,
                'total' => $current_total + $shipping_fee,
                'description' => $description,
                'code' => $code,
                'promotion_code' => $promotion_code?$promotion_code:null,
                'branch_id' => post('branch_id', 1),
                'payment_method' => $payment_method,
                'is_prepaid' => in_array($payment_method, array('bank', 'moca', 'zalopay', 'vnpay'))?1:0,
                'VAT' => $vat
            );
	        if (branch_2_is_off())
		        $update_data['branch_id'] = LHP_BRANCH_ID;
            if(!empty($prebooking_discount))
                $update_data['prebooking_discount'] = $prebooking_discount;
            $this->Orders->update($order_id, $update_data);

            $test_mode = 0;
            if (!empty($customer['email']) && in_array($customer['email'], array('fish.neednt.water@gmail.com')))
                $test_mode = 1;

            // Send email to orders@...
            if ($order_code)
                $subject = 'Đơn hàng đã sửa - '. $code;
            else
                $subject = 'Đơn hàng mới - '. $code;

            $params = array(
                'code' => $code,
                'description' => $description,
                'controller' => $this
            );
            $body = include2string(ABSOLUTE_PATH.'email_templates/admin_order_notification.php', $params);
            $to_mails = 'orders@' .DOMAIN_NAME;
            if (branch_2_is_off()){
                //$to_mails .= ',order2@'.DOMAIN_NAME;
            }
            SendMail('sender@'.DOMAIN_NAME, $test_mode?'hieu.ps.nguyen@gmail.com':$to_mails, $subject, $body, get_setting('site_name').' - Order online', !empty($customer['email'])?$customer['email']:'');

            // Send email to customer
            if (!empty($customer['email']))
            {
                if ($order_code)
                    $subject = ($language=='en')?(get_setting('short_site_name').' - Your edited order - '. $code):get_setting('site_name').' - Thông tin đơn hàng đã sửa - '. $code;
                else
                    $subject = ($language=='en')?(get_setting('short_site_name').' - Your order - '. $code):get_setting('site_name').' - Thông tin đơn hàng - '. $code;
                $params = array(
                    'code' => $code,
                    'description' => $description,
                    'controller' => $this
                );
                if ($language == 'en')
                    $body = include2string(ABSOLUTE_PATH.'email_templates/customer_confirmation_en.php', $params);
                else
                    $body = include2string(ABSOLUTE_PATH.'email_templates/customer_confirmation.php', $params);
                SendMail('orders@'. DOMAIN_NAME, $customer['email'], $subject, $body, get_setting('site_name').' - Order online');
                if(env('SEND_CUSTOMER_EMAIL_TO_DEV'))
                    SendMail('orders@'. DOMAIN_NAME, 'hieu.ps.nguyen@gmail.com', $subject, $body, '['.get_setting('site_name').'] [Customer] Order online');
            }

            if ($order_id && is_prepaid_order($payment_method)){
                /* Prepaid */
                $des = 'Đơn hàng #'.$update_data['code']. (!empty($customer['fullname'])?' - '.$customer['fullname']:'');
                $des .= ' - Đã thanh toán';
                if($payment_method){
                    switch ($payment_method){
                        case 'bank':
                            $des .= ' chuyển khoản';
                            break;
                        case 'moca':
                            $des .= ' qua Moca';
                            break;
                        case 'zalopay':
                            $des .= ' qua Zalo Pay';
                            break;
                        case 'vnpay':
                            $des .= ' qua VN Pay';
                            break;
                    }
                }
                $payment_voucher_data = array(
                    'branch_id' => LHP_BRANCH_ID,
                    'type' => 'payment',
                    'description' => $des,
                    'amount' => $update_data['total'],
                    'user_id' => 1,
                    'created_dtm' => date('Y-m-d H:i:s')
                );
                $payment_voucher_data['date_time'] = empty($order_details['delivery_date'])?date('Y-m-d H:i:s'):$order_details['delivery_date'];
                $this->Vouchers->insert($payment_voucher_data);
            }else{
                $existed_voucher = $this->Vouchers->select_one(array(
                    'branch_id' => LHP_BRANCH_ID,
                    'type' => 'payment',
                    'where' => "description like 'Đơn hàng #". $update_data['code']."%'"
                ));
                if($existed_voucher)
                    $this->Vouchers->delete($existed_voucher['id']);
            }
        }
        else
        {
            if ($language == 'en')
                $this->_error('Unknown error occurs. Please re-order or contact us via phone number.');
            else
                $this->_error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
        }
        $this->return['code'] = $code;
        $this->return['customer_id'] = $customer_id;
        $this->_ok();
    }
    
    function subscribe_email()
    {
        $subscribe_url = 'http://efruit.us8.list-manage.com/subscribe/post?u=835f111c95c2c0a231f48c48f&id=cf2ae7fb8e&EMAIL=';
        $this->return = array('status' => 'OK', 'message' => '');
        $honey_name = md5("subscribe to info@". DOMAIN_NAME . date("WY"));
        $honeypot = $_POST[$honey_name];
        if (isset($honeypot) && $honeypot == '')
        {
            $email = post('email');
            $lang_code = post('language_code');
            if (!empty($email) && validate_email($email))
            {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $subscribe_url. $email);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                $output = curl_exec($ch);
                curl_close($ch);
                if ($lang_code == 'en')
                    $this->return['message']= "Please check your mailbox for the confirmation email.";
                else
                    $this->return['message']= "Email xác nhận đã được gửi cho bạn.\r\nVui lòng kiểm tra hộp thư để hoàn tất đăng ký.";
                if(strstr($output, 'Too many subscribe attempts for this email address. Please try again in about 5 minutes.'))
                {
                    $this->return['status']= 'MANY_ATTEMPTS';
                    if ($lang_code == 'en')
                        $this->return['message']= 'Too many subscribe attempts for this email address. Please try again in about 5 minutes.';
                    else
                        $this->return['message']= 'Email của bạn đã được gửi nhiều lần. Vui lòng thử lại sau 5 phút.';
                }
            }
            else
            {
                $this->return['status']= 'INVALID_EMAIL';
                if ($lang_code == 'en')
                    $this->return['message']= 'Your email is not valid. Please double check your input.';
                else
                    $this->return['message']= 'Email không hợp lệ. Vui lòng kiểm tra lại.';
            }
        }
        else
        {
            $this->return['status']= 'BOT_DETECTED';
            $this->return['message']= 'Bot detected!';
        }
        $this->_send();
    }
    
    function send_contact()
    {
        // User settings
        $to = "info@". DOMAIN_NAME;
        $subject = "Message from contact form - ". DOMAIN_NAME;
        
        // Include extra form fields and/or submitter data?
        // false = do not include
        $extra = array(
        	"form_subject"	=> true,
        	"form_cc"		=> true,
        	"ip"			=> true,
        	"user_agent"	=> true
        );
        // Send the email
    	$name = isset($_POST["name"]) ? $_POST["name"] : "";
    	$email = isset($_POST["email"]) ? $_POST["email"] : "";
    	$subject = isset($_POST["subject"]) ? $_POST["subject"] : $subject;
    	$message = isset($_POST["message"]) ? $_POST["message"] : "";
    	$cc = isset($_POST["cc"]) ? $_POST["cc"] : "";
    	$token = isset($_POST["token"]) ? $_POST["token"] : "";
        $smcf_token = md5("smcf-" . $to . date("WY"));
        
        $valid_honey = isset($_POST[$smcf_token]) && $_POST[$smcf_token]=='' ? 1 : 0;
    	// make sure the token matches
    	if ($token === $smcf_token && $valid_honey) {
            $pattern = array("/\n/","/\r/","/content-type:/i","/to:/i", "/from:/i", "/cc:/i");
            // Filter and validate fields
        	$name = preg_replace($pattern, "", $name);
            $subject = preg_replace($pattern, "", $subject);
            $email = preg_replace($pattern, "", $email);
        	if (!validate_email($email)) {
        		$subject .= " - invalid email";
        		$message .= "<br/>Bad email: $email";
        		$email = $to;
        		$cc = 0; // do not CC "sender"
        	}
            $message = str_replace("\n",'<br/>', $message);
            
        	// Add additional info to the message
        	if ($extra["ip"]) {
        		$message .= "<br/><br/><br/>IP: " . $_SERVER["REMOTE_ADDR"];
        	}
        	if ($extra["user_agent"]) {
        		$message .= "<br/>USER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
        	}
        
        	// Set and wordwrap message body
        	$body = "<b>Tên:</b> $name <br/>";
        	$body .= "<b>Thông điệp:</b> <br/>$message";
        	$body = wordwrap($body, 70);
            
        
        	// UTF-8
        	if (function_exists('mb_encode_mimeheader')) {
        		$subject = mb_encode_mimeheader($subject, "UTF-8", "B", "\n");
        	}
        	else {
        		// you need to enable mb_encode_mimeheader or risk 
        		// getting emails that are not UTF-8 encoded
        	}
        
        	// Send email
            if (SendMail($email, $to, $subject, $body, $name)){
                $this->_ok('Thông điệp của bạn đã được gửi. Xin cám ơn.');
            }else{
                $this->_error('Thông điệp của bạn không thể gửi được vào lúc này. Vui lòng thử lại sau. Xin cám ơn.');
            }
            exit;
    	}
    	else {
    		$this->_error("Rất tiếc, có lỗi xảy ra, vui lòng gửi lại thông điệp sau vài phút.", 'BOT');
    	}
    }

    function send_voucher_request()
    {
        $to = get_setting('to_emails_for_requests');
        if(empty($to))
            $this->_error('Yêu cầu của bạn không thể gửi được vào lúc này. Vui lòng thử lại sau hoặc gọi trực tiếp cho chúng tôi. Xin cám ơn.');

        $subject = "Có khách đăng ký nhận voucher từ ". DOMAIN_NAME;

        $findus_options = array(
            'friend' => 'Bạn bè',
            'facebook' => 'Facebook',
            'google' => 'Google',
            'email' => 'Email',
            'online' => 'Quảng cáo online',
            'broucher' => 'Tờ rơi',
            'other' => 'Khác'
        );
        $receive_options = array(
            'at_shop' => 'Voucher giấy tại cửa hàng',
            'when_booking' => 'Voucher giấy khi có đặt hàng online',
            'email' => 'Voucher điện tử qua email'
        );
        $fields = array(
            'v_name' => 'Họ tên',
            'v_email' => 'Email',
            'v_mobile' => 'Số điện thoại',
            'v_company' => 'Công ty',
            'v_address' => 'Địa chỉ',
            'v_findus' => 'Bạn biết đến chúng tôi qua kênh nào?',
            'v_recieve' => 'Bạn muốn nhận voucher bằng cách nào?',
            'v_message' => 'Yêu cầu khác'
        );
        // Send the email
        $token = isset($_POST["token"]) ? $_POST["token"] : "";
        $smcf_token = md5("smcf-info@". DOMAIN_NAME . date("WY"));

        $valid_honey = isset($_POST[$smcf_token]) && $_POST[$smcf_token]=='' ? 1 : 0;
        // make sure the token matches
        if ($token === $smcf_token && $valid_honey) {
            $pattern = array("/\n/","/\r/","/content-type:/i","/to:/i", "/from:/i", "/cc:/i");
            $body = 'Có khách hàng gửi yêu cầu nhận Voucher với thông tin sau:<br/><br/>';
            foreach($fields as $f => $lbl){
                $$f = post($f, '--');
                switch($f){
                    case 'v_message':
                        $body .= "<b>$lbl:</b><br/>".preg_replace($pattern, "", $$f).'<br/>';
                        break;
                    case 'v_findus':
                        $body .= "<b>$lbl</b><br/>".(isset($findus_options[$$f])?$findus_options[$$f]:'').'<br/>';
                        break;
                    case 'v_recieve':
                        $body .= "<b>$lbl</b><br/>".(isset($receive_options[$$f])?$receive_options[$$f]:'').'<br/>';
                        break;
                    default:
                        $body .= "<b>$lbl:</b> ".preg_replace($pattern, "", $$f). '<br/>';
                        break;
                }
            }
            if(!empty($_SERVER['HTTP_REFERER']))
                $body .= '<i>Từ trang '. $_SERVER['HTTP_REFERER'].'</i>';
            $body .= "<br/>System Autobot.";
            
            // UTF-8
            if (function_exists('mb_encode_mimeheader')) {
                $subject = mb_encode_mimeheader($subject, "UTF-8", "B", "\n");
            }

            // Send email
            if (SendMail($v_email, $to, $subject, $body, $v_name)){
                $this->_ok('Yêu cầu của bạn đã được gửi. Xin cám ơn.');
            }else{
                $this->_error('Yêu cầu của bạn không thể gửi được vào lúc này. Vui lòng thử lại sau hoặc gọi trực tiếp cho chúng tôi. Xin cám ơn.');
            }
            exit;
        }
        else {
            $this->_error("Rất tiếc, có lỗi xảy ra, vui lòng gửi lại yêu cầu sau vài phút.", 'BOT');
        }
    }

    function send_package_request()
    {
        $to = get_setting('to_emails_for_requests');
        if(empty($to))
            $this->_error('Yêu cầu của bạn không thể gửi được vào lúc này. Vui lòng thử lại sau hoặc gọi trực tiếp cho chúng tôi. Xin cám ơn.');

        $subject = "Có khách hàng đăng ký sử dụng gói sản phẩm mỗi ngày từ ". DOMAIN_NAME;

        $packages_options = get_package_options();

        $fields = array(
            'p_package' => 'Tên gói',
            'p_quantity' => 'Số lượng',
            'p_name' => 'Họ tên',
            'p_email' => 'Email',
            'p_mobile' => 'Số điện thoại',
            'p_address' => 'Địa chỉ',
            'p_shipping_fee' => 'Hình thức nhận hàng',
            'p_delivery_time' => 'Thời gian giao hàng',
            'p_payment_method' => 'Hình thức thanh toán',
            'p_bottle_return' => 'Hình thức trả chai',
            'p_message' => 'Yêu cầu khác'
        );
        // Send the email
        $token = isset($_POST["token"]) ? $_POST["token"] : "";
        $smcf_token = md5("smcf-info@". DOMAIN_NAME . date("WY"));

        $valid_honey = isset($_POST[$smcf_token]) && $_POST[$smcf_token]=='' ? 1 : 0;
        // make sure the token matches
        if ($token === $smcf_token && $valid_honey) {
            $pattern = array("/\n/","/\r/","/content-type:/i","/to:/i", "/from:/i", "/cc:/i");
            $body = 'Có khách hàng gửi yêu cầu nhận Voucher với thông tin sau:<br/><br/>';
            foreach($fields as $f => $lbl){
                $$f = post($f, '--');
                switch($f){
                    case 'p_message':
                        $body .= "<b>$lbl:</b><br/>".preg_replace($pattern, "", $$f).'<br/>';
                        break;
                    case 'p_package':
                        $body .= "<b>$lbl:</b> ".(isset($packages_options['products'][$$f])?$packages_options['products'][$$f]['name']:'').'<br/>';
                        break;
                    case 'p_shipping_fee':
                        $body .= "<b>$lbl:</b> ".(isset($packages_options['shipping_fees'][$$f])?$packages_options['shipping_fees'][$$f]:'').'<br/>';
                        break;
                    case 'p_delivery_time':
                        $body .= "<b>$lbl:</b> ".(isset($packages_options['delivery_time'][$$f])?$packages_options['delivery_time'][$$f]:'').'<br/>';
                        break;
                    case 'p_payment_method':
                        $body .= "<b>$lbl:</b> ".(isset($packages_options['payment_methods'][$$f])?$packages_options['payment_methods'][$$f]:'').'<br/>';
                        break;
                    case 'p_bottle_return':
                        $body .= "<b>$lbl:</b> ".(isset($packages_options['bottle_return'][$$f])?$packages_options['bottle_return'][$$f]:'').'<br/>';
                        break;
                    default:
                        $body .= "<b>$lbl:</b> ".preg_replace($pattern, "", $$f). '<br/>';
                        break;
                }
            }
            if(!empty($_SERVER['HTTP_REFERER']))
                $body .= '<i>Từ trang '. $_SERVER['HTTP_REFERER'].'</i>';
            $body .= "<br/>System Autobot.";

            // UTF-8
            if (function_exists('mb_encode_mimeheader')) {
                $subject = mb_encode_mimeheader($subject, "UTF-8", "B", "\n");
            }

            // Send email
            if (SendMail($p_email, $to, $subject, $body, $p_name)){
                $this->_ok('Cảm ơn quý anh/chị đã đặt <b/>"'.$packages_options['products'][$p_package]['name'].'"</b>. Nhân viên cửa hàng sẽ liên hệ xác nhận lại sớm nhất. Hi vọng bạn sẽ hài lòng với sản phẩm và dịch vụ của chúng tôi.');
            }else{
                $this->_error('Yêu cầu của bạn không thể gửi được vào lúc này. Vui lòng thử lại sau hoặc gọi trực tiếp cho chúng tôi. Xin cám ơn.');
            }
            exit;
        }
        else {
            $this->_error("Rất tiếc, có lỗi xảy ra, vui lòng gửi lại yêu cầu sau vài phút.", 'BOT');
        }
    }

    function send_company_request()
    {
        $to = get_setting('to_emails_for_requests');
        if(empty($to))
            $this->_error('Yêu cầu của bạn không thể gửi được vào lúc này. Vui lòng thử lại sau hoặc gọi trực tiếp cho chúng tôi. Xin cám ơn.');

        $subject = "Có khách đăng ký nhận voucher từ ". DOMAIN_NAME;

        $findus_options = array(
            'friend' => 'Bạn bè',
            'facebook' => 'Facebook',
            'google' => 'Google',
            'email' => 'Email',
            'online' => 'Quảng cáo online',
            'broucher' => 'Tờ rơi',
            'other' => 'Khác'
        );
        $product_options = array(
            'cut' => 'Trái cây cắt',
            'raw' => 'Trái cây theo kilogram'
        );
        $fields = array(
            'v_name' => 'Họ tên',
            'v_company' => 'Công ty',
            'v_number_of_customer' => 'Số khách sử dụng',
            'v_mobile' => 'Số điện thoại',
            'v_email' => 'Email',
            'v_address' => 'Địa chỉ',
            'v_product' => 'Dịch vụ trái cây muốn đặt?',
            'v_findus' => 'Bạn biết đến chúng tôi qua kênh nào?',
            'v_budget' => 'Chi phí dự kiến/tháng',
            'v_message' => 'Yêu cầu khác'
        );
        // Send the email
        $token = isset($_POST["token"]) ? $_POST["token"] : "";
        $smcf_token = md5("smcf-info@". DOMAIN_NAME . date("WY"));

        $valid_honey = isset($_POST[$smcf_token]) && $_POST[$smcf_token]=='' ? 1 : 0;
        // make sure the token matches
        if ($token === $smcf_token && $valid_honey) {
            $pattern = array("/\n/","/\r/","/content-type:/i","/to:/i", "/from:/i", "/cc:/i");
            $body = 'Có khách hàng gửi yêu cầu đặt hàng cho công ty với thông tin sau:<br/><br/>';
            foreach($fields as $f => $lbl){
                $$f = post($f, '--');
                switch($f){
                    case 'v_message':
                        $body .= "<b>$lbl:</b><br/>".preg_replace($pattern, "", $$f).'<br/>';
                        break;
                    case 'v_findus':
                        $body .= "<b>$lbl</b><br/>".(isset($findus_options[$$f])?$findus_options[$$f]:'').'<br/>';
                        break;
                    case 'v_product':
                        $body .= "<b>$lbl</b><br/>".(isset($product_options[$$f])?$product_options[$$f]:'').'<br/>';
                        break;
                    default:
                        $body .= "<b>$lbl:</b> ".preg_replace($pattern, "", $$f). '<br/>';
                        break;
                }
            }
            if(!empty($_SERVER['HTTP_REFERER']))
                $body .= '<i>Từ trang '. $_SERVER['HTTP_REFERER'].'</i>';
            $body .= "<br/>System Autobot.";

            // UTF-8
            if (function_exists('mb_encode_mimeheader')) {
                $subject = mb_encode_mimeheader($subject, "UTF-8", "B", "\n");
            }

            // Send email
            if (SendMail($v_email, $to, $subject, $body, $v_name)){
                $this->_ok('Cảm ơn quý anh/chị gửi yêu cầu đặt hàng. Nhân viên cửa hàng sẽ liên hệ lại sớm nhất. Hi vọng quý khách sẽ hài lòng với sản phẩm và dịch vụ của chúng tôi.');
            }else{
                $this->_error('Yêu cầu của bạn không thể gửi được vào lúc này. Vui lòng thử lại sau hoặc gọi trực tiếp cho chúng tôi. Xin cám ơn.');
            }
            exit;
        }
        else {
            $this->_error("Rất tiếc, có lỗi xảy ra, vui lòng gửi lại yêu cầu sau vài phút.", 'BOT');
        }
    }
    
    function is_free_ship()
    {
        $this->return['free_ship'] = 0;
        $mobile = post('mobile');
        $mobile = str_replace('+', '', $mobile);
        if (strpos($mobile, '84') === 0)
            $mobile = substr($mobile, 2);
        if (strpos($mobile,'0') !== 0)
            $mobile = '0'. $mobile;
        if (intval($mobile) != 0)
        {
            $existed_customer = $this->Customers->select_one(array("mobile" => $mobile, 'deleted' => 0));
            if ($existed_customer && $existed_customer['free_ship'])
                $this->return['free_ship'] = 1;
        }
        $this->_ok();  
    }
    
    function check_promotion_code()
    {
        $promotion_code = post('promotion_code');
        $mobile = post('mobile');
        $obj = $this->Promotioncodes->select_one(array('code' => $promotion_code, 'order_by' => 'end_date DESC'));
        if (!$obj)
            $this->_error('Mã khuyến mãi không chính xác.');
        $now = time();
        if (strtotime($obj['start_date']) > $now)
            $this->_error('Mã khuyến mãi của bạn chưa tới thời gian áp dụng.');
        if (strtotime($obj['end_date']) < $now)
            $this->_error('Mã khuyến mãi của bạn đã hết thời hạn sử dụng.');
        
        if ($mobile && 0)
        {
            $applied_orders = $this->Orders->select_one(array('where' => "shipping_info LIKE '%$mobile%'",'promotion_code' => $promotion_code));
            if ($applied_orders)
                $this->_error('Mã khuyến mãi đã được sử dụng cho SĐT này.');
        }
            
        $this->return['discount'] = $obj['discount'];
        $this->return['description'] = $obj['description'];
        $this->return['promotion_code'] = $promotion_code;
        $this->_ok();  
    }

    function assess_order()
    {
        $assessment_id = post('assessment_id');
        $data = array();
        $fields = array('order_id', 'score', 'criteria', 'feedback');
        foreach($fields as $field)
            $data[$field] = post($field);
        if(empty($data['order_id']))
            $this->_error('Mã đơn hàng không chính xác');

        $order = $this->Orders->get_order($data['order_id']);
        if(empty($order))
            $this->_error('Mã đơn hàng không chính xác');

        if($data['score'] === '')
            $this->_error('Vui lòng chọn sao để đánh giá');

        $now = date('Y-m-d H:i:s');
        if($assessment_id){
            $ok = $this->Orders->update_order_assessment(array('id' => $assessment_id), $data);
        }else{
            $data['created_dtm'] = $now;
            $ok = $this->Orders->add_order_assessment($data);
        }
        $this->return['discount_code'] = '';
        if($ok && get_setting('send_discount_code_after_assessing_order') == 1){
            $code_details = $this->Promotioncodes->select_one(array('where' => "description LIKE '%#".$order['code']."%'"));
            if(empty($code_details)){
                $code = random_string(5, 0, 1);
                while($existed_code = $this->Promotioncodes->select(array('code' => $code)))
                {
                    $code = random_string(5, 0, 1);
                }
                $data = array(
                    'start_date' => date('Y-m-d'),
                    'end_date' => date('Y-m-d', strtotime('+11 days')),
                    'discount' => 0.1,
                    'code' => $code,
                    'description' => 'Mã cho khách đánh giá đơn hàng #'.$order['code'],
                    'created_dtm' => $now,
                    'created_by' => 0
                );
                $success = $this->Promotioncodes->insert($data);
                if($success){
                    $this->return['discount_code'] = $code;
                }
            }
        }
        $this->_ok();
    }
}
/* End of FrontendController class */
