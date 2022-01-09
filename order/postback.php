<?php
    $not_destroy_session = 1;
    include("../pixeladmin/includes/main_order.inc.php");
    /* Orders and Users are included in main_order.inc.php*/
    require_once("../PHPMailer/sender.php");
    require_once(ABSOLUTE_PATH. 'models/common/Prices.php');
    require_once(ABSOLUTE_PATH. 'models/common/Customers.php');
    require_once(ABSOLUTE_PATH. 'models/common/Products.php');
    require_once(ABSOLUTE_PATH. 'models/common/Vouchers.php');
    require_once(ABSOLUTE_PATH. 'models/common/Salaryadvances.php');
    require_once(ABSOLUTE_PATH. 'models/common/Promotioncodes.php');
	require_once(ABSOLUTE_PATH. 'models/common/Customerdebts.php');
    require_once(ABSOLUTE_PATH. 'models/common/Costs.php');
    require_once(ABSOLUTE_PATH. 'models/common/ProductComponents.php');
    require_once(ABSOLUTE_PATH. 'models/common/ProductsInBoxes.php');

    $action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
    $return = array();
    global $beginTransaction;
    global $models;
    $models->price = new Prices();
    $models->customer = new Customers();
    $models->product = new Products();
    $models->voucher = new Vouchers();
    $models->salary_advance = new Salaryadvances();
    $models->promotion_codes = new Promotioncodes();
	$models->customer_debt = new Customerdebts();
    $models->cost = new Costs();
    $models->product_component = new ProductComponents();
    $models->product_in_boxes = new ProductsInBoxes();
    
    /* Get the current discount campaign */
    function get_discount($code = ''){
        global $discount_table, $models;        
        $apply_discount = '';
        /*
        if ($discount_table && is_array($discount_table))
        {
            $last_priority = -1;
            foreach($discount_table as $row)
            {
                extract($row);
                if ($end_date && strtotime($end_date) < strtotime(date('Y-m-d')))
                    continue;
                if ($start_date && strtotime($start_date) > strtotime(date('Y-m-d')))
                    continue;
                if ($priority > $last_priority){
                    $apply_discount = $row;
                    $last_priority = $priority;
                }
            }
        }
        */
        
        if ($code){
            $order = $models->order->get_order($code);
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
    
    function get_data($code = '', $is_local = 0)
    {
        global $return, $order_items_update_time, $models;
        
        $latest_update_dtm = post('latest_update_dtm');
        $return['need_to_update'] = array();
        
        $product_price_modified_dtm = get_lastest_modified_dtm(array('products', 'prices'));
        if ((isset($latest_update_dtm['product_price_for_delivery']) && $latest_update_dtm['product_price_for_delivery'] != $product_price_modified_dtm)
        || $is_local)
        {
            $product_last_modified_dtm = substr($latest_update_dtm['product_price_for_delivery'], 0, 10);
            $price_last_modified_dtm = substr($latest_update_dtm['product_price_for_delivery'], 10);
            if($is_local){
                /* Get all products when editing local orders */
                $products = $models->product->get_products_for_delivery(array('is_additional' => '0'), -1, 1);
            }else
                $products = $models->product->get_products_for_delivery(array('is_additional' => '0'), -1);
            if ($products)
            {
                $return['products'] = array();

                $price = $models->price->select(array('deleted' => 0, 'type_id' => 3));
                $prices = Hash::combine($price, '{n}.product_id', '{n}');

                $components = $models->product_component->get_components(array('active' => 1));
                if($components)
                    $components = Hash::combine($components, '{n}.id', '{n}', '{n}.product_id');

                $box_items = $models->product_in_boxes->select();
                $box_items = $box_items?Hash::combine($box_items, '{n}.id', '{n}', '{n}.box_id'):array();

                foreach($products as $product)
                {
                    if(empty($prices[$product['product_id']]))
                        continue;
                    //Check if any updates
                    if (strtotime($product['modified_dtm']) <= $product_last_modified_dtm &&
                        strtotime($prices[$product['product_id']]['modified_dtm']) <= $price_last_modified_dtm && !$is_local)
                        continue;
                    if($is_local)
                        $sub_products = $models->product->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"), -1, 1);
                    else
                        $sub_products = $models->product->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"));
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
                    if(isset($box_items[$product['product_id']]))
                        $product['box_items'] = $box_items[$product['product_id']];
                    else
                        $product['box_items'] = array();

                    unset($product['modified_dtm']);
                    $return['products'][] = $product;
                }
                $return['need_to_update']['product_price_for_delivery'] = $product_price_modified_dtm;
            }
            else
                error('Hệ thống đang bảo trì, vui lòng gọi trực tiếp cho chúng tôi. Cám ơn bạn.');
        }
        
        if (isset($latest_update_dtm['product_prices']) && $latest_update_dtm['product_prices'] != $product_price_modified_dtm)
        {
            $product_last_modified_dtm = substr($latest_update_dtm['product_prices'], 0, 10);
            $price_last_modified_dtm = substr($latest_update_dtm['product_prices'], 10);
            
            $products = $models->product->get_list_for_selling(array('is_additional' => '0'), -1);
            if ($products)
            {
                $return['products'] = array();
                if(empty($components)){
                    $components = $models->product_component->get_components(array('active' => 1));
                    if($components)
                        $components = Hash::combine($components, '{n}.id', '{n}', '{n}.product_id');
                }

                if(empty($box_items)){
                    $box_items = $models->product_in_boxes->select();
                    $box_items = $box_items?Hash::combine($box_items, '{n}.id', '{n}', '{n}.box_id'):array();
                }
                foreach($products as $product)
                {
                    $prices = $models->price->select(array('product_id' => $product['product_id'], 'deleted' => 0, 'order_by' => 'type_id'));
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
                    $sub_products = $models->product->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"));
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
                    if(isset($box_items[$product['product_id']]))
                        $product['box_items'] = $box_items[$product['product_id']];
                    else
                        $product['box_items'] = array();

                    $product['prices'] = $price_array;
                    unset($product['modified_dtm']);
                    $return['products'][] = $product;
                }
                $return['need_to_update']['product_prices'] = $product_price_modified_dtm;
            }
            else
                error('Hệ thống đang bảo trì, vui lòng gọi trực tiếp cho chúng tôi. Cám ơn bạn.');
        }
        
        $customer_modified_dtm = get_lastest_modified_dtm('customers');
        if (isset($latest_update_dtm['customers']) && $latest_update_dtm['customers'] != $customer_modified_dtm)
        {
            $w_arr = array();
            if ($latest_update_dtm['customers'] != -1)
                $w_arr['where'] = "UNIX_TIMESTAMP(customers.modified_dtm) >= ".$latest_update_dtm['customers'];
            $return['customers'] = $models->customer->get_list_for_selling($w_arr);
            $return['need_to_update']['customers'] = $customer_modified_dtm;
        }
        
        $order_type_modified_dtm = get_lastest_modified_dtm('order_types');
        if (isset($latest_update_dtm['order_types']) && $latest_update_dtm['order_types'] != $order_type_modified_dtm)
        {
            $order_types = $models->order->get_order_types();
            $return['order_types'] = array();
            if ($order_types)
                foreach($order_types as $t)
                    $return['order_types'][$t['id']] = $t;
            $return['need_to_update']['order_types'] = $order_type_modified_dtm;
        }
        
        $return['shipping_fees'] = get_new_shipping_fees();
        $return['discount_details'] = get_discount($code);
        $return['server_dtm'] = time()*1000; // miliseconds
        $return['tasteOptions'] = get_taste_options();
    }
    
    switch($action)
    {
        case 'get_data':
        case 'get_selling_data':
            get_data();
            ok();
        break;
        case 'get_order':
            $code = post('code');
            $is_local = post('is_local', 0);
            $order = $models->order->get_order($code);
            if (!$order)
                error('Mã đơn hàng không chính xác.');
            $order_items = $models->order->get_full_order_items($order, $error_msg);
            if ($error_msg)
                error($error_msg);
            
            $customer = $order['shipping_info']?json_decode($order['shipping_info']):null;
            if ($customer){
                if (isset($customer->free_ship))
                    $customer->free_ship = intval($customer->free_ship);
                else
                    $customer->free_ship = 0;
            }
            unset($order['compressed_data']);
            $return['order'] = $order;
            $return['order_items'] = $order_items;
            $return['customer'] = $customer;
            
            // Get data
            get_data($code, $is_local);
            ok();
        break;
        case 'get_order_details':
            $code = post('code');
            $order = $models->order->get_order($code);
	        if (!$order)
		        error('Mã đơn hàng không chính xác.');
	        unset($order['compressed_data']);
            $return['order'] = $order;
            $return['customer'] = json_decode($order['shipping_info']);
            ok();
        break;
        case 'update_order_discount':
            $code = post('code');
            $order = $models->order->get_order($code);
	        if (!$order)
		        error('Mã đơn hàng không chính xác.');
            $discount_amount = post('discount_amount');
            $VAT = post('VAT');
            $update_data = array(
                                'discount' => $discount_amount,
                                'VAT' => $VAT, 
                                'total' => $order['subtotal'] + $order['shipping_fee'] - $discount_amount + ($order['subtotal']-$discount_amount)*$VAT,
                            );
            beginTransaction();
            if (!$models->order->update($order['id'], $update_data))
                error('Không thể lưu đơn hàng, vui lòng liên hệ cửa hàng.');
            ok();
        break;
        case 'update_order_delivery_date':
            $code = post('code');
            $order = $models->order->get_order($code);
	        if (!$order)
		        error('Mã đơn hàng không chính xác.');
            $delivery_date = post('delivery_date');
            if (!$delivery_date)
                error('Ngày không hợp lệ.');
            $update_data = array('delivery_date' => date('Y-m-d H:i:s', $delivery_date));
            beginTransaction();
            if (date('Y-m-d', strtotime($order['created_dtm'])) == $update_data['delivery_date']){
	            $update_data['delivery_date'] = $order['created_dtm'];
            }
            if ($order['delivery_date'] != $update_data['delivery_date']){
	            if ($order['is_prepaid']){
		            /* Prepaid */
		            $voucher = $models->voucher->select_one(array('type' => 'payment', 'where' => "description like '%#".$order['id']."%' AND description like '%Đã thanh toán%'"));
		            if ($voucher){
			            $payment_voucher_data = array(
				            'date_time' => $update_data['delivery_date']
			            );
			            $models->voucher->update($voucher['id'], $payment_voucher_data);
		            }
	            }
            }
            $update_data['pickup_time'] = date('Y-m-d H:i:s', $delivery_date - 30*60);
            if (!$models->order->update($order['id'], $update_data))
                error('Không thể lưu đơn hàng, vui lòng liên hệ cửa hàng.');
            ok('Thời gian giao hàng đã được cập nhật.');
        break;
        case 'update_order_pickup_time':
            $code = post('code');
            $order = $models->order->get_order($code);
            if (!$order)
                error('Mã đơn hàng không chính xác.');
            $pickup_time = post('pickup_time');
            if (!$pickup_time)
                error('Ngày không hợp lệ.');
            $update_data = array('pickup_time' => date('Y-m-d H:i:s', $pickup_time));
            beginTransaction();
            if (date('Y-m-d', strtotime($order['created_dtm'])) == $update_data['pickup_time']){
                $update_data['pickup_time'] = $order['created_dtm'];
            }
            $update_data['delivery_date'] = date('Y-m-d H:i:s', $pickup_time + 30*60);
            if ($order['delivery_date'] != $update_data['delivery_date']){
                if ($order['is_prepaid']){
                    /* Prepaid */
                    $voucher = $models->voucher->select_one(array('type' => 'payment', 'where' => "description like '%#".$order['id']."%' AND description like '%Đã thanh toán%'"));
                    if ($voucher){
                        $payment_voucher_data = array(
                            'date_time' => $update_data['delivery_date']
                        );
                        $models->voucher->update($voucher['id'], $payment_voucher_data);
                    }
                }
            }
            if (!$models->order->update($order['id'], $update_data))
                error('Không thể lưu đơn hàng, vui lòng liên hệ cửa hàng.');
            ok('Thời gian lấy hàng đã được cập nhật.');
        break;
	    case 'update_order_status':
		    $code = post('code');
		    $order = $models->order->get_order($code);
		    if (!$order)
			    error('Mã đơn hàng không chính xác.');
		    $status = post('status');
		    if (!$status)
			    error('Ngày không hợp lệ.');
		    $update_data = array('status' => $status);
		    beginTransaction();
		    if (!$models->order->update($order['id'], $update_data))
			    error('Không thể lưu đơn hàng, vui lòng liên hệ cửa hàng.');
		    ok('Tình trạng đơn hàng đã được cập nhật.');
		    break;
        case 'lock_order':
            $code = post('code');
            $order = $models->order->get_order($code);
            if (!$order)
                error('Mã đơn hàng không chính xác.');
            beginTransaction();
            $update_data = array('is_locked' => $order['is_locked']?0:1);
            if (!$models->order->update($order['id'], $update_data))
                error('Không thể lưu đơn hàng, vui lòng liên hệ cửa hàng.');
            ok();    
        break;
        case 'save_order':
            $is_local = post('is_local', 0);
            if (!$is_local){
                if (empty($_REQUEST[CAPTCHA_NAME])){
                    error('Có lỗi xảy ra, vui lòng tải lại trang. Xin cảm ơn.');
                }
                /** Validate captcha */
                if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST[CAPTCHA_NAME])) != $_SESSION['captcha']) {
                    $e_msg = date('Y-m-d H:i:s');
                    try {
                        if (empty($_SESSION['captcha']))
                            $e_msg .= " - SESSION không hoạt động, mã nhập: '". trim(strtolower($_REQUEST[CAPTCHA_NAME]))."'";
                        else
                            $e_msg .= " - Mã bảo vệ không đúng: nhập '". trim(strtolower($_REQUEST[CAPTCHA_NAME]))."' so với '". $_SESSION['captcha']. "'";

                    } catch (Exception $e) {
                        $e_msg .= 'Caught exception: '.  $e->getMessage(). "\n";
                    }
                    $e_msg .= "\nIP: " . $_SERVER["REMOTE_ADDR"]. "\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
                    debug("$e_msg \n");
                }
                else{
                    $e_msg = date('Y-m-d H:i:s');
                    try {
                        $e_msg .= " - Mã bảo vệ hoạt động: nhập '". trim(strtolower($_REQUEST[CAPTCHA_NAME]))."' so với '". $_SESSION['captcha']. "'";
                    } catch (Exception $e) {
                        $e_msg .= 'Caught exception: '.  $e->getMessage(). "\n";
                    }
                    $e_msg .= "\nIP: " . $_SERVER["REMOTE_ADDR"]. "\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
                    debug("$e_msg \n");
                    //unset($_SESSION['captcha']);
                }
            }
            beginTransaction();
            $ids = post('ids');
            $quantity = post('quantity');
            $custom = post('custom');
	        $item_descriptions = post('descriptions');
            $customer = post('customer');
            $description = post('description');
            $order_code = post('code');
            $language = post('language');
            $delivery_datetime = post('delivery_datetime');
            $promotion_code = post('promotion_code');
			$discount_amount = post('discount_amount', 0);
            $payment_method = post('payment_method');
            $VAT = post('VAT', 0);
            $boxes = post('boxes');
            $customer_id = '';
            $free_ship = 0;
            if ($customer)
            {
                $customer_data = array();
                $customer_data['mobile'] = str_replace('+', '', $customer['mobile']);
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
                    $existed_customer = $models->customer->select_one(array('or' => array("mobile" => $customer_data['mobile']), 'deleted' => 0));
                if ($existed_customer)
                {
                    $customer_id = $existed_customer['customer_id'];
                    $free_ship = !empty($existed_customer['free_ship'])?1:0;
                }
                else
                {
                    $address = capitalize($customer['address']);
                    // Creates new customer
                    if($customer['fullname'])
                        $customer_data['customer_name'] = capitalize($customer['fullname']);
                    else
                        $customer_data['customer_name'] = customer_name_from_address($address);
                    $customer_data['address'] = $address;
                    $customer_data['district'] = $customer['district'];
	                //$customer_data['building'] = getvalue($customer, 'building');
                    $customer_data['email'] = $customer['email'];
                    $customer_data['type_id'] = 1; // eFruit type

                    $customer_data['modified_by'] = Users::get_userdata('user_id')?Users::get_userdata('user_id'):0;
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
                    $customer_id = $models->customer->insert($customer_data);
                }
                $distance = $customer['distance'];
            }
            //$ids =  implode(',', $ids);
            $sub_product_ids = $ids;
            $product_ids = array();
            foreach($ids as $key => $val)
            {
                $keys = explode('|', $key);
                $product_id = array_pop($keys);
                if (!in_array($product_id, $product_ids))
                    $product_ids[] = $product_id;
            }
            $products = $models->product->get_products_for_delivery(array('where'=>"products.product_id IN (".implode(',', $product_ids).")"), -1, 1);
            if($products)
            {
                $discount = 0;
                if ($order_code)
                {
                    $order = $models->order->get_order($order_code);
                    if (!$order)
                    {
                        if ($language == 'en')
                            error('Unknown error occurs. Please re-order or contact us via phone number.');
                        else
                            error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E1]');
                    }
                    $order_id = $order['id'];
                    //$discount = $order['discount']/$order['subtotal'];
                    // Remove all old order items
                    eModel::_delete('order_items', array('order_id' => $order_id));
                    
                    if(is_valid_delivery_time($delivery_datetime, 1))
                    {
                        if (!$models->order->update($order_id, array('delivery_date' => date('Y-m-d H:i:s', $delivery_datetime))))
                        {
                            if ($language == 'en')
                                error('Unknown error occurs. Please re-order or contact us via phone number.');
                            else
                                error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E2]');
                        }
                    }
                    else if(!empty($delivery_datetime))
                    {
                        if ($language == 'en')
                            error('We cannot deliver your order on your expected time. Please change the time (8h30 - 21h).');
                        else
                            error('Giờ giao hàng không phù hợp, quý khách vui lòng chọn lại giờ giao hàng (8h30 - 21h).');
                    }
                    $order_type = $order['type_id'];
                }
                else
                {
                    $now = date('Y-m-d H:i:s');
                    if (!empty($delivery_datetime))
                    {
                        if (!is_valid_delivery_time($delivery_datetime))
                        {
                            if ($language == 'en')
                                error('We cannot deliver your order on your expected time. Please change the time.');
                            else
                                error('Giờ giao hàng không phù hợp, quý khách vui lòng chọn lại giờ giao hàng.');
                        }
                    }
                    $order_details = array(
                        'customer_id' => $customer_id,
                        'created_dtm' => $now,
                        'delivery_date' => $now,
                        'type_id' => 3,
                        'VAT' => $VAT,
                        'payment_method' => $payment_method
                    );
                    $order_type = 3;
                    $order_id = $models->order->insert($order_details);
                    if (!$order_id)
                    {
                        if ($language == 'en')
                            error('Unknown error occurs. Please re-order or contact us via phone number.');
                        else
                            error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E3]');
                    }

	                $models->customer->update($customer_id, array('last_order_dtm' => $now));
                }
                
                
                $product_arr = array();
                foreach($products as $product)
                {
                    $sub_products = $models->product->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"), -1, 1);
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
                    $order_items['product_id'] = $item['product_id'];
                    $order_items['quantity'] = $quantity[$key];
	                $order_items['description'] = empty($item_descriptions[$key])?$item_description:$item_descriptions[$key];
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
                            error('Unknown error occurs. Please re-order or contact us via phone number.');
                        else
                            error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E4]');
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
                            if(!$order_item_id)
                            {
                                if ($language == 'en')
                                    error('Unknown error occurs. Please re-order or contact us via phone number.');
                                else
                                    error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E5]');
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
	            /*
                if ($promotion_code)
                {
                    $code_details = $models->promotion_codes->select_one(array('code' => $promotion_code));
                    if (!$code_details)
                        error('Mã khuyến mãi không chính xác.');
                    $now = time();
                    if (strtotime($code_details['start_date']) > $now)
                        error('Mã khuyến mãi của bạn chưa tới thời gian áp dụng.');
                    if (strtotime($code_details['end_date']) < $now)
                        error('Mã khuyến mãi của bạn đã hết thời hạn sử dụng.');
                    $discount_amount = $subtotal*$code_details['discount'];
                }
                else
                {
                    if ($discount)
                        $discount_amount = $subtotal*$discount;
                    else{
                        $discount_details = get_discount();
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
                }
	            */

                /* Override discount if pre-booking discount is greater than normal discount */
                if (is_valid_delivery_time($delivery_datetime)){
                    $prebooking_discount = $discount_amount/$subtotal;
                    /*
                    if (!empty($order) && $order['prebooking_discount'] && $subtotal*$order['prebooking_discount'] > $discount_amount)
                        $discount_amount = $subtotal*$order['prebooking_discount'];
                    else if($subtotal*PRE_BOOKING_DISCOUNT > $discount_amount){
                        $prebooking_discount = PRE_BOOKING_DISCOUNT;
                        $discount_amount = $subtotal*PRE_BOOKING_DISCOUNT;
                    }
                    */
                }
                if (!empty($order) && $order['type_id'] == ORDER_TYPE_FOODY_ID){
	                $VAT_amount = $subtotal*$VAT;
                }else{
	                $VAT_amount = ($subtotal - $discount_amount)*$VAT;
                }

                $current_total = $subtotal - $discount_amount + $VAT_amount;
                if ($free_ship)
                    $shipping_fee = 0;
                else {
                    if(empty($customer['district']))
                        $shipping_fee = 0;
                    else
                        $shipping_fee = cal_shipping_fee($current_total, $customer['district'], $distance);
                }

                if ($order_code)
                    $code = $order_code;
                else
	                $code = get_next_id('e');
                //$code = 'e' . rand(1,9) . dechex(intval($order_id)). rand(0,9);
                $update_data = array(
                    'subtotal' => $subtotal,
                    'shipping_fee' => $shipping_fee,
                    'discount' => $discount_amount,
                    'quantity' => $total_quantity,
                    'total' => $current_total + $shipping_fee,
                    'description' => $description,
                    'code' => $code,
                    'VAT' => $VAT,
                    'branch_id' => post('branch_id', LHP_BRANCH_ID),
                    'payment_method' => $payment_method,
                    'is_prepaid' => in_array($payment_method, array('bank', 'moca', 'zalopay', 'vnpay','momo'))?1:0
                );
	            if (branch_2_is_off())
		            $update_data['branch_id'] = LHP_BRANCH_ID;
                if ($customer)
                    $update_data['shipping_info'] = json_encode($customer, JSON_UNESCAPED_UNICODE);
                if(!empty($prebooking_discount))
                    $update_data['prebooking_discount'] = $prebooking_discount;
                $models->order->update($order_id, $update_data);
                
                if (IS_LIVE)
                {
	                $logged_user = Users::get_logged_user();
                    $test_mode = 0;
                    if (!empty($customer['email']) && in_array($customer['email'], array('fish.neednt.water@gmail.com')))
                        $test_mode = 1;
                    
                    // Send email to orders@...
                    if ($order_code){
                        if ($is_local || !empty($logged_user))
                            $subject = 'Đơn hàng cửa hàng đã sửa - '. $code;
                        else
                            $subject = 'Đơn hàng đã sửa - '. $code;
                    }
                    else
                        $subject = 'Đơn hàng mới - '. $code;

                    $params = array(
                        'code' => $code,
                        'description' => $description,
                        'is_foody' => $order_type == ORDER_TYPE_FOODY_ID,
	                    'user' => $logged_user,
	                    'is_edit' => $order_code?1:0
                    );
                    $body = include2string('email_templates/admin_order_notification.php', $params);

	                $to_mails = 'orders@'. DOMAIN_NAME;
	                if (branch_2_is_off()){
		                //$to_mails .= ',order2@'. DOMAIN_NAME;
	                }

                    SendMail('sender@'. DOMAIN_NAME, $test_mode?'hieu.ps.nguyen@gmail.com':$to_mails, $subject, $body, get_setting('site_name').' - Order online', !empty($customer['email'])?$customer['email']:'');
                
                    // Send email to customer
                    if (!empty($customer['email']))
                    {
                        if ($order_code)
                            $subject = ($language=='en')?(get_setting('short_site_name').' - Your edited order - '. $code):get_setting('site_name').' - Thông tin đơn hàng đã sửa - '. $code;
                        else
                            $subject = ($language=='en')?(get_setting('short_site_name').' - Your order - '. $code):get_setting('site_name').' - Thông tin đơn hàng - '. $code;
                        $params = array(
                            'code' => $code,
                            'description' => $description
                        );
                        if ($language == 'en')
                            $body = include2string('email_templates/customer_confirmation_en.php', $params);
                        else
                            $body = include2string('email_templates/customer_confirmation.php', $params);
                        SendMail('orders@'. DOMAIN_NAME, $customer['email'], $subject, $body, get_setting('site_name'). ' - Order online');
                    }
                }
            }
            else
            {
                if ($language == 'en')
                    error('Unknown error occurs. Please re-order or contact us via phone number.');
                else
                    error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E6]');
            }
            $return['code'] = $code;
            $return['customer_id'] = $customer_id;
            ok();
        break;
        case 'save_g_order':
            $is_local = post('is_local', 0);
            if (!$is_local){
                if (empty($_REQUEST[CAPTCHA_NAME])){
                    error('Có lỗi xảy ra, vui lòng tải lại trang. Xin cảm ơn.');
                }
                /** Validate captcha */
                if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST[CAPTCHA_NAME])) != $_SESSION['captcha']) {
                    $e_msg = date('Y-m-d H:i:s');
                    try {
                        if (empty($_SESSION['captcha']))
                            $e_msg .= " - SESSION không hoạt động, mã nhập: '". trim(strtolower($_REQUEST[CAPTCHA_NAME]))."'";
                        else
                            $e_msg .= " - Mã bảo vệ không đúng: nhập '". trim(strtolower($_REQUEST[CAPTCHA_NAME]))."' so với '". $_SESSION['captcha']. "'";

                    } catch (Exception $e) {
                        $e_msg .= 'Caught exception: '.  $e->getMessage(). "\n";
                    }
                    $e_msg .= "\nIP: " . $_SERVER["REMOTE_ADDR"]. "\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
                    debug("$e_msg \n");
                }
                else{
                    $e_msg = date('Y-m-d H:i:s');
                    try {
                        $e_msg .= " - Mã bảo vệ hoạt động: nhập '". trim(strtolower($_REQUEST[CAPTCHA_NAME]))."' so với '". $_SESSION['captcha']. "'";
                    } catch (Exception $e) {
                        $e_msg .= 'Caught exception: '.  $e->getMessage(). "\n";
                    }
                    $e_msg .= "\nIP: " . $_SERVER["REMOTE_ADDR"]. "\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
                    debug("$e_msg \n");
                    //unset($_SESSION['captcha']);
                }
            }
            beginTransaction();
            $ids = post('ids');
            $quantity = post('quantity');
            $item_descriptions = post('descriptions');
            $customer = post('customer');
            $description = post('description');
            $order_code = post('code');
            $group_code = post('g_code');
            $language = post('language');
            $delivery_datetime = post('delivery_datetime');
            $promotion_code = post('promotion_code');
            $discount_amount = post('discount_amount', 0);
            $customer_id = '';
            $free_ship = 0;
            if ($customer)
            {
                $customer_data = array();
                $customer_data['mobile'] = str_replace('+', '', $customer['mobile']);
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
                    $existed_customer = $models->customer->select_one(array('or' => array("mobile" => $customer_data['mobile']), 'deleted' => 0));
                if ($existed_customer)
                {
                    $customer_id = $existed_customer['customer_id'];
                    $free_ship = !empty($existed_customer['free_ship'])?1:0;
                }
                else
                {
                    $address = capitalize($customer['address']);
                    // Creates new customer
                    if($customer['fullname'])
                        $customer_data['customer_name'] = capitalize($customer['fullname']);
                    else
                        $customer_data['customer_name'] = customer_name_from_address($address);
                    $customer_data['address'] = $address;
                    $customer_data['district'] = $customer['district'];

                    $customer_data['email'] = $customer['email'];
                    $customer_data['type_id'] = 1; // eFruit type

                    $customer_data['modified_by'] = Users::get_userdata('user_id')?Users::get_userdata('user_id'):0;
                    $customer_data['created_dtm'] = date('Y-m-d H:i:s');
                    $customer_id = $models->customer->insert($customer_data);
                }
                $distance = $customer['distance'];
            }

            $sub_product_ids = $ids;
            $product_ids = array();
            foreach($ids as $key => $val)
            {
                $keys = explode('|', $key);
                $product_id = array_pop($keys);
                if (!in_array($product_id, $product_ids))
                    $product_ids[] = $product_id;
            }
            $products = $models->product->get_products_for_delivery(array('where'=>"products.product_id IN (".implode(',', $product_ids).")"), -1, 1);
            if($products)
            {
                $VAT = $discount = 0;
                if ($order_code)
                {
                    $order = $models->order->get_order($order_code);
                    if (!$order)
                    {
                        if ($language == 'en')
                            error('Unknown error occurs. Please re-order or contact us via phone number.');
                        else
                            error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E1]');
                    }
                    $order_id = $order['id'];
                    $VAT = $order['VAT'];

                    // Remove all old order items
                    eModel::_delete('order_items', array('order_id' => $order_id));

                    if(is_valid_delivery_time($delivery_datetime, 1))
                    {
                        if (!$models->order->update($order_id, array('delivery_date' => date('Y-m-d H:i:s', $delivery_datetime))))
                        {
                            if ($language == 'en')
                                error('Unknown error occurs. Please re-order or contact us via phone number.');
                            else
                                error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E2]');
                        }
                    }
                    else if(!empty($delivery_datetime))
                    {
                        if ($language == 'en')
                            error('We cannot deliver your order on your expected time. Please change the time (8h30 - 21h).');
                        else
                            error('Giờ giao hàng không phù hợp, quý khách vui lòng chọn lại giờ giao hàng (8h30 - 21h).');
                    }
                    $order_type = $order['type_id'];
                }
                else
                {
                    $now = date('Y-m-d H:i:s');
                    if (!empty($delivery_datetime))
                    {
                        if (!is_valid_delivery_time($delivery_datetime))
                        {
                            if ($language == 'en')
                                error('We cannot deliver your order on your expected time. Please change the time.');
                            else
                                error('Giờ giao hàng không phù hợp, quý khách vui lòng chọn lại giờ giao hàng.');
                        }
                    }
                    $order_details = array(
                        'customer_id' => $customer_id,
                        'created_dtm' => $now,
                        'delivery_date' => $now,
                        'type_id' => 3
                    );
                    $order_type = 3;
                    $order_id = $models->order->insert($order_details);
                    if (!$order_id)
                    {
                        if ($language == 'en')
                            error('Unknown error occurs. Please re-order or contact us via phone number.');
                        else
                            error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E3]');
                    }

                    $models->customer->update($customer_id, array('last_order_dtm' => $now));
                }


                $product_arr = array();
                foreach($products as $product)
                {
                    $sub_products = $models->product->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"), -1, 1);
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

                foreach($sub_product_ids as $key => $sub_ids)
                {
                    $keys = explode('|', $key);
                    $product_id = array_pop($keys);
                    $item = $product_arr[$product_id];
                    $order_items = array();
                    $order_items['order_id'] = $order_id;
                    $order_items['product_id'] = $item['product_id'];
                    $order_items['quantity'] = $quantity[$key];
                    $order_items['description'] = empty($item_descriptions[$key])?null:$item_descriptions[$key];
                    if ($item['promotion_price'] > 0)
                        $order_items['price'] = $item['promotion_price'];
                    else
                        $order_items['price'] = $item['price'];
                    $order_items['total'] = $order_items['price']*$order_items['quantity'];
                    $order_items['created_dtm'] = date('Y-m-d H:i:s');
                    $subtotal += $order_items['total'];
                    $total_quantity += $order_items['quantity'];
                    $item_id = eModel::_insert('order_items', $order_items);
                    if(!$item_id)
                    {
                        if ($language == 'en')
                            error('Unknown error occurs. Please re-order or contact us via phone number.');
                        else
                            error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E4]');
                    }
                    elseif(!empty($sub_ids) && is_array($sub_ids))
                    {
                        foreach($sub_ids as $sub_product_id)
                        {
                            $order_sub_items = array();
                            $order_sub_items['order_id'] = $order_id;
                            $order_sub_items['belongs_to'] = $item_id;
                            $order_sub_items['product_id'] = $sub_product_id;
                            $order_sub_items['quantity'] = $quantity[$key];
                            $order_sub_items['price'] = $item['sub_products'][$sub_product_id]['price'];
                            $order_sub_items['total'] = $order_sub_items['price']*$order_sub_items['quantity'];
                            $order_sub_items['created_dtm'] = date('Y-m-d H:i:s');
                            $subtotal += $order_sub_items['total'];
                            //$total_quantity += $order_sub_items['quantity'];
                            $sub_item_id = eModel::_insert('order_items', $order_sub_items);
                            if(!$item_id)
                            {
                                if ($language == 'en')
                                    error('Unknown error occurs. Please re-order or contact us via phone number.');
                                else
                                    error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E5]');
                            }
                        }
                    }
                }

                /* Override discount if pre-booking discount is greater than normal discount */
                if (is_valid_delivery_time($delivery_datetime)){
                    if (!empty($order) && $order['prebooking_discount'] && $subtotal*$order['prebooking_discount'] > $discount_amount)
                        $discount_amount = $subtotal*$order['prebooking_discount'];
                    else if($subtotal*PRE_BOOKING_DISCOUNT > $discount_amount){
                        $prebooking_discount = PRE_BOOKING_DISCOUNT;
                        $discount_amount = $subtotal*PRE_BOOKING_DISCOUNT;
                    }
                }
                $VAT_amount = ($subtotal - $discount_amount)*$VAT;
                $current_total = $subtotal - $discount_amount + $VAT_amount;

                if ($free_ship)
                    $shipping_fee = 0;
                else {
                    if(empty($customer['district']))
                        $shipping_fee = 0;
                    else
                        $shipping_fee = cal_shipping_fee($current_total, $customer['district'], $distance);
                }

                if ($order_code)
                    $code = $order_code;
                else
                    $code = get_next_id('g');

                $update_data = array(
                    'subtotal' => $subtotal,
                    'shipping_fee' => $shipping_fee,
                    'discount' => $discount_amount,
                    'quantity' => $total_quantity,
                    'total' => $current_total + $shipping_fee,
                    'description' => $description,
                    'code' => $code,
                    'branch_id' => post('branch_id', LHP_BRANCH_ID)
                );

                if ($customer)
                    $update_data['shipping_info'] = json_encode($customer, JSON_UNESCAPED_UNICODE);
                if(!empty($prebooking_discount))
                    $update_data['prebooking_discount'] = $prebooking_discount;
                $models->order->update($order_id, $update_data);

                eModel::_update('g_booking', array('g_code' => $group_code), array('order_code' => $code));

                if (IS_LIVE)
                {
                    $logged_user = Users::get_logged_user();
                    $test_mode = 0;
                    if (!empty($customer['email']) && in_array($customer['email'], array('fish.neednt.water@gmail.com')))
                        $test_mode = 1;

                    // Send email to orders@...
                    if ($order_code){
                        if ($is_local || !empty($logged_user))
                            $subject = 'Đơn hàng cửa hàng đã sửa - '. $code;
                        else
                            $subject = 'Đơn hàng đã sửa - '. $code;
                    }
                    else
                        $subject = 'Đơn hàng mới - '. $code;

                    $params = array(
                        'code' => $code,
                        'description' => $description,
                        'is_foody' => $order_type == ORDER_TYPE_FOODY_ID,
                        'user' => $logged_user,
                        'is_edit' => $order_code?1:0
                    );
                    $body = include2string('email_templates/admin_order_notification.php', $params);

                    $to_mails = 'orders@'. DOMAIN_NAME;
                    if (branch_2_is_off()){
                        //$to_mails .= ',order2@'. DOMAIN_NAME;
                    }

                    SendMail('sender@'. DOMAIN_NAME, $test_mode?'hieu.ps.nguyen@gmail.com':$to_mails, $subject, $body, get_setting('site_name'). ' - Order online', !empty($customer['email'])?$customer['email']:'');

                    // Send email to customer
                    if (!empty($customer['email']))
                    {
                        if ($order_code)
                            $subject = ($language=='en')?(get_setting('short_site_name').' - Your edited order - '. $code):get_setting('site_name').' - Thông tin đơn hàng nhóm đã sửa - '. $code;
                        else
                            $subject = ($language=='en')?(get_setting('short_site_name').' - Your order - '. $code):get_setting('site_name').' - Thông tin đơn hàng nhóm - '. $code;
                        $params = array(
                            'code' => $code,
                            'description' => $description
                        );
                        if ($language == 'en')
                            $body = include2string('email_templates/customer_confirmation_en.php', $params);
                        else
                            $body = include2string('email_templates/customer_confirmation.php', $params);
                        SendMail('orders@'. DOMAIN_NAME, $customer['email'], $subject, $body, get_setting('site_name'). ' - Order online');
                    }
                }
            }
            else
            {
                if ($language == 'en')
                    error('Unknown error occurs. Please re-order or contact us via phone number.');
                else
                    error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại. [E6]');
            }
            $return['code'] = $code;
            $return['customer_id'] = $customer_id;
            ok();
            break;
        case 'save_selling_order':
            $order_id = post('order_id');
            $posted_code = post('code');
            $pre_save = post('pre_save');
            $shipping_in = post('shipping_in');
            $pickup_time =  date('Y-m-d H:i:s', post('pickup_time'));
	        $delivery_date =  date('Y-m-d H:i:s', post('delivery_date'));
            $ids = post('ids');
            $quantity = post('quantity');
            $item_descriptions = post('descriptions');
            $created_dtm = post('created_dtm');
            if (empty($created_dtm) || $created_dtm/1000 > time())
                $created_dtm = time();
            else
                $created_dtm = $created_dtm/1000;
            $customer = post('customer');
            $description = post('description');
            $discount_amount = post('discount_amount');
            if (empty($discount_amount))
                $discount_amount = 0;
            $order_type_id = post('order_type');

	        $payment_date = post('payment_date');
			if ($payment_date)
				$payment_date =  date('Y-m-d H:i:s', post('payment_date'));
	        $payment_description = post('payment_description');
	        $payment_method = post('payment_method');

            $order_type = eModel::_select_one('order_types', array('id'=>$order_type_id));
            $customer_id = 0;
            $free_ship = 0;
            //beginTransaction();
            if (!empty($customer)) {
                /* Booker and receiver are the same */
                if (isset($customer['booker_mobile']) && empty($customer['mobile'])) {
                    $customer['mobile'] = $customer['booker_mobile'];
                }
                if (isset($customer['booker_fullname']) && empty($customer['fullname'])) {
                    $customer['fullname'] = $customer['booker_fullname'];
                }
            }
            if (!empty($customer) && !empty($customer['mobile']))
            {
                $customer_data = array();
                if (!empty($customer['ex_description'])){
                    $customer_data['description'] = $customer['ex_description'];
                    //unset($customer['ex_description']);
                }
                    
                $existed_customer = $models->customer->select_one(array('or' => array("mobile" => $customer['mobile']), 'deleted' => 0));
                if ($existed_customer)
                {
                    $customer_id = $existed_customer['customer_id'];
                    $free_ship = !empty($existed_customer['free_ship'])?1:0;
                    $new_address = capitalize($customer['address']);
                    if ($existed_customer['address'] != $new_address)
                        $customer_data['address'] = $new_address;
                    if ($existed_customer['district'] != $customer['district'])
                        $customer_data['district'] = $customer['district'];
	                if ($existed_customer['building'] != $customer['building'])
		                $customer_data['building'] = $customer['building'];
	                if (!empty($customer['company_name']) && $existed_customer['company_name'] != $customer['company_name'])
		                $customer_data['company_name'] = $customer['company_name'];
	                if (!empty($customer['company_tax_code']) && $existed_customer['company_tax_code'] != $customer['company_tax_code'])
		                $customer_data['company_tax_code'] = $customer['company_tax_code'];
	                if (!empty($customer['company_address']) && $existed_customer['company_address'] != $customer['company_address'])
		                $customer_data['company_address'] = $customer['company_address'];
                    if (isset($customer['new_exchange_points']) && $existed_customer['exchange_points'] != $customer['new_exchange_points'])
                        $customer_data['exchange_points'] = $customer['new_exchange_points'];
                    $new_name = capitalize($customer['fullname']);
                    if ($existed_customer['customer_name'] != $new_name)
                        $customer_data['customer_name'] = $new_name;
                    if (!empty($customer['email']) && $existed_customer['email'] != $customer['email'])
                        $customer_data['email'] = $customer['email'];
                    if (!empty($customer_data))
                        $models->customer->update($customer_id, $customer_data);
                }
                else
                {
                    $address = capitalize($customer['address']);
                    // Creates new customer
                    $customer_data['address'] = $address;
                    $customer_data['district'] = $customer['district'];
	                $customer_data['building'] = getvalue($customer, 'building');
	                $customer_data['company_name'] = getvalue($customer, 'company_name');
	                $customer_data['company_tax_code'] = getvalue($customer, 'company_tax_code');
	                $customer_data['company_address'] = getvalue($customer, 'company_address');
                    $customer_data['email'] = getvalue($customer, 'email');
                    $customer_data['type_id'] = $order_type['id'] == ORDER_TYPE_FOODY_ID?FOODY_CUSTOMER_TYPE_ID:EFRUIT_CUSTOMER_TYPE_ID; // eFruit type
                    $customer_data['mobile'] = $customer['mobile'];
                    if (strpos($customer_data['mobile'],'0') !== 0)
                        $customer_data['mobile'] = '0'. $customer_data['mobile'];

                    if (intval($customer_data['mobile']) == 0)
                        $customer_data['mobile'] = 0;
                    if($customer['fullname'])
                        $customer_data['customer_name'] = capitalize($customer['fullname']);
                    else{
                        //$customer_data['customer_name'] = customer_name_from_address($address);
                        $customer_data['customer_name'] = $customer_data['mobile'];
                    }

                    $customer_data['exchange_points'] = getvalue($customer, 'new_exchange_points', 0);
                    $customer_data['modified_by'] = Users::get_userdata('user_id')?Users::get_userdata('user_id'):0;
                    $customer_data['created_dtm'] = date('Y-m-d H:i:s', $created_dtm);

                    if (empty($customer_data['lat']) || empty($customer_data['lng']))
                    {
                        /*
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
                        */
                    }
                    $customer_id = $models->customer->insert($customer_data);
                }
                $distance = $customer['distance'];
            }
            //$ids =  implode(',', $ids);
            $sub_product_ids = $ids;
            $product_ids = array();
            if (empty($ids))
                error('Đơn hàng bị lỗi, vui lòng đặt hàng lại.');
            foreach($ids as $key => $val)
            {
                $keys = explode('|', $key);
                $product_id = array_pop($keys);
                if (!in_array($product_id, $product_ids))
                    $product_ids[] = $product_id;
            }
            $products = $models->product->get_list_for_selling(array('where'=>"products.product_id IN (".implode(',', $product_ids).")"), -1);
            if($products)
            {
                /* Check if any order duplicated - unknown bug */
                $filter_arr = array();
                $filter_arr['select'] = 'id';
                if ($customer_id)
                    $filter_arr['customer_id'] = $customer_id;
                $filter_arr['created_dtm'] = date('Y-m-d H:i:s', $created_dtm);
                $dup_order = $models->order->select_one($filter_arr);
                if ($dup_order)
                    $order_id = $dup_order['id'];

                $vat = post('VAT', 0);
                if (!empty($order_id) && is_numeric($order_id))
                {
                    $order_details = array(
                        'customer_id' => $customer_id,
                        'type_id' => $order_type_id,
                        'is_prepaid' => post('is_prepaid')?1:0,
                        'VAT' => $vat,
                        'payment_method' => $payment_method,
                    );
                    if($payment_method == 'shipnow'){
                        $order_details['shipper_id'] = SHIPNOW_USER_ID;
                    }
                    $table_name = post('table_name');
                    if ($table_name)
                        $order_details['table_name'] = $table_name;
                    /*
	                if ($order_type['need_customer_details'] == 0 && $order_type['id'] != ORDER_TYPE_FOODY_ID)
		                $order_details['status'] = 'In Process';
                    */
	                if ($delivery_date)
		                $order_details['delivery_date'] = $delivery_date;
	                elseif($shipping_in){
		                $order_details['delivery_date'] = date('Y-m-d H:i:s', strtotime('+ '. $shipping_in. ' minutes'));
	                }

                    $order_details['pickup_time'] = $pickup_time;
	                if (strtotime($order_details['pickup_time']) < $created_dtm){
		                $order_details['pickup_time'] = date('Y-m-d H:i:s', $created_dtm);
	                }
                    if (strtotime($order_details['delivery_date']) < $created_dtm){
                        $order_details['delivery_date'] = date('Y-m-d H:i:s', $created_dtm);
                    }
	                if ($payment_date){
                        $order_details['payment_date'] = $payment_date;
		                if (strtotime($order_details['payment_date']) < $created_dtm){
			                $order_details['payment_date'] = date('Y-m-d H:i:s', $created_dtm);
		                }
	                }else{
		                $order_details['payment_date'] = null;
	                }
	                if ($payment_description){
		                $order_details['payment_description'] = $payment_description;
	                }else{
		                $order_details['payment_description'] = null;
	                }
                    $models->order->update($order_id, $order_details);
                    eModel::_delete('order_items', array('order_id' => $order_id));
                }
                else
                {
                    $order_details = array(
                        'customer_id' => $customer_id,
                        'type_id' => $order_type_id,
                        'is_prepaid' => post('is_prepaid')?1:0,
                        'VAT' => $vat,
                        'payment_method' => $payment_method,
                        'created_dtm' => date('Y-m-d H:i:s', $created_dtm)
                    );
                    if($payment_method == 'shipnow'){
                        $order_details['shipper_id'] = SHIPNOW_USER_ID;
                    }
	                if ($delivery_date)
		                $order_details['delivery_date'] = $delivery_date;
	                elseif($shipping_in){
		                $order_details['delivery_date'] = date('Y-m-d H:i:s', strtotime('+ '. $shipping_in. ' minutes'));
	                }else{
		                $order_details['delivery_date'] = $order_details['created_dtm'];
	                }

                    $order_details['pickup_time'] = $pickup_time;
                    if (strtotime($order_details['pickup_time']) < $created_dtm){
                        $order_details['pickup_time'] = date('Y-m-d H:i:s', $created_dtm);
                    }
	                if (strtotime($order_details['delivery_date']) < $created_dtm){
		                $order_details['delivery_date'] = date('Y-m-d H:i:s', $created_dtm);
	                }
	                if ($payment_date){
                        $order_details['payment_date'] = $payment_date;
		                if (strtotime($order_details['payment_date']) < $created_dtm){
			                $order_details['payment_date'] = date('Y-m-d H:i:s', $created_dtm);
		                }
	                }
	                if ($payment_description){
		                $order_details['payment_description'] = $payment_description;
	                }
                    $table_name = post('table_name');
                    if ($table_name)
                        $order_details['table_name'] = $table_name;
                    /*
                    if ($order_type['need_customer_details'] == 0 && $order_type['id'] != ORDER_TYPE_FOODY_ID)
                        $order_details['status'] = $pre_save?'Wait for Staff Confirm':'Completed';
                    else if ($order_type['id'] == ORDER_TYPE_FOODY_ID || $order_type['need_customer_details'] == 1)
	                    $order_details['status'] = 'Wait for Staff Confirm';
                    */
                    $order_details['status'] = 'In Process';

                    $order_id = $models->order->insert($order_details);
                }

                if (!$order_id)
                    error('Đơn hàng bị lỗi, vui lòng đặt hàng lại.');

	            if ($customer_id)
	                $models->customer->update($customer_id, array('last_order_dtm' => date('Y-m-d H:i:s', $created_dtm)));
                
                $product_arr = array();
                foreach($products as $product)
                {
                    $sub_products = $models->product->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"), -1);
                    if ($sub_products)
                    {
                        foreach($sub_products as $sp)
                            $product['sub_products'][$sp['product_id']] = $sp;
                    }
                    else 
                        $product['sub_products'] = array();
                    
                    $price = $models->price->select_one(array('product_id' => $product['product_id'], 'type_id' => $order_type['price_type'], 'deleted' => 0, 'order_by' => 'type_id'));
                    $product['price'] = $price?$price['price']:0;
                    $product_arr[$product['product_id']] = $product;
                    
                }    
                
                $subtotal = $total = $shipping_fee = $total_quantity = 0;
                
                foreach($sub_product_ids as $key => $sub_ids)
                {
                    $keys = explode('|', $key);
                    $product_id = array_pop($keys);
                    $item = $product_arr[$product_id];
                    $order_items = array();
                    $order_items['order_id'] = $order_id;
                    $order_items['product_id'] = $item['product_id'];
                    $order_items['quantity'] = $quantity[$key];
                    $order_items['description'] = empty($item_descriptions[$key])?null:$item_descriptions[$key];
                    if ($item['promotion_price'] > 0 && $order_type_id <= 3)
                        $order_items['price'] = $item['promotion_price'];
                    else
                        $order_items['price'] = $item['price'];
                    $order_items['total'] = $order_items['price']*$order_items['quantity'];
                    $order_items['created_dtm'] = date('Y-m-d H:i:s', $created_dtm);
                    $subtotal += $order_items['total'];
                    $total_quantity += $order_items['quantity'];
                    $item_id = eModel::_insert('order_items', $order_items);
                    if(!$item_id)
                        error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
                    elseif(!empty($sub_ids) && is_array($sub_ids))
                    {
                        foreach($sub_ids as $sub_product_id)
                        {
                            $order_sub_items = array();
                            $order_sub_items['order_id'] = $order_id;
                            $order_sub_items['belongs_to'] = $item_id;
                            $order_sub_items['product_id'] = $sub_product_id;
                            $order_sub_items['quantity'] = $quantity[$key];
                            $order_sub_items['price'] = $item['sub_products'][$sub_product_id]['price'];
                            $order_sub_items['total'] = $order_sub_items['price']*$order_sub_items['quantity'];
                            $order_sub_items['created_dtm'] = date('Y-m-d H:i:s', $created_dtm);
                            $subtotal += $order_sub_items['total'];
                            //$total_quantity += $order_sub_items['quantity'];
                            $sub_item_id = eModel::_insert('order_items', $order_sub_items);
                            if(!$item_id)
                                error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
                        }
                    }
                }
                if ($order_type_id == ORDER_TYPE_FOODY_ID){
	                $vat_amount = $vat*$subtotal;
                }else{
	                $vat_amount = $vat*($subtotal - $discount_amount);
                }
                $current_total = $subtotal - $discount_amount + $vat_amount;
                //Calculating shipping fee
                if ($free_ship)
                    $shipping_fee = 0;
                else if ($customer_id) {
                    if(empty($customer['district']))
                        $shipping_fee = 0;
                    else
                        $shipping_fee = cal_shipping_fee($current_total, $customer['district'], $distance);
                }

                $update_data = array(
                                    'subtotal' => $subtotal,
                                    'shipping_fee' => $shipping_fee,
                                    'shipping_info' => $customer_id || $order_type['id'] == ORDER_TYPE_FOODY_ID?json_encode($customer, JSON_UNESCAPED_UNICODE):null,
                                    'discount' => $discount_amount,
                                    'quantity' => $total_quantity,
                                    'total' => $current_total + $shipping_fee,
                                    'description' => $description,
                                    'code' => $posted_code?$posted_code:get_order_code($order_type['id']),
                                    'branch_id' => post('branch_id', LHP_BRANCH_ID)
                                );
	            if (branch_2_is_off())
		            $update_data['branch_id'] = LHP_BRANCH_ID;
                $models->order->update($order_id, $update_data);
                if (!$pre_save)
                {
                    $logged_user = Users::get_logged_user();
                    if ($order_type['need_customer_details'] > 0 || $order_type['id'] == ORDER_TYPE_FOODY_ID ){
                        /*
                        $to_mails = array();
						if ($logged_user){
							if(($logged_user['branch_id'] == HTC_BRANCH_ID && $update_data['branch_id'] == LHP_BRANCH_ID) || Users::is_admin()){
								//$to_mails[] = 'order2@'. DOMAIN_NAME;
							}
							if($logged_user['branch_id'] == LHP_BRANCH_ID && $update_data['branch_id'] == HTC_BRANCH_ID){
								$to_mails[] = 'orders@'. DOMAIN_NAME;
							}
						}

                        if (!empty($to_mails)){
                            // Send email to orders@...
                            $params = array(
                                'code' => $update_data['code'],
                                'description' => $description,
                                'is_foody' => $order_type['id'] == ORDER_TYPE_FOODY_ID,
	                            'user' => $logged_user
                            );
                            $body = include2string('email_templates/admin_order_notification.php', $params);
                            SendMail('sender@'. DOMAIN_NAME, $to_mails, 'Đơn hàng cửa hàng đã thêm - '. $update_data['code'], $body, 'eFruit - Order from store');
                        }
                        */

                        // Send email to customer
                        if (!empty($customer['email']))
                        {
                            // Send email to orders@...
                            $params = array(
                                'code' => $update_data['code'],
                                'description' => $description,
                                'is_foody' => $order_type['id'] == ORDER_TYPE_FOODY_ID,
                                'user' => $logged_user
                            );
                            $body = include2string('email_templates/admin_order_notification.php', $params);
                            SendMail('sender@'. DOMAIN_NAME, 'orders@'. DOMAIN_NAME, 'Đơn hàng cửa hàng đã thêm - '. $update_data['code'], $body, get_setting('site_name').' - Order from store');

                            $subject = get_setting('site_name').' - Thông tin đơn hàng - '. $update_data['code'];
                            $params = array(
                                'code' => $update_data['code'],
                                'description' => $description
                            );
                            $body = include2string('email_templates/customer_confirmation.php', $params);
                            SendMail('orders@'. DOMAIN_NAME, $customer['email'], $subject, $body, get_setting('site_name'). ' - Order online');
                        }
                    }

                    if ($order_id && is_prepaid_order($payment_method)){
                        /* Prepaid */
                        if ($order_type['id'] == ORDER_TYPE_FOODY_ID)
                            $des = 'Đơn hàng #'.$update_data['code']. (!empty($customer['fullname'])?' - '.$customer['fullname']:''). ' (Foody) - Đã thanh toán';
                        else
                            $des = 'Đơn hàng #'.$update_data['code']. (!empty($customer['fullname'])?' - '.$customer['fullname']:'') . ' - '. get_payment_method_string($payment_method);

                        $payment_voucher_data = array(
                            'branch_id' => LHP_BRANCH_ID,
                            'type' => 'payment',
                            'description' => $des,
                            'amount' => $update_data['total'],
                            'user_id' => $logged_user?$logged_user['user_id']:1
                        );
                        $payment_voucher_data['date_time'] = $payment_voucher_data['created_dtm'] = empty($order_details['delivery_date'])?date('Y-m-d H:i:s'):$order_details['delivery_date'];
                        $models->voucher->insert($payment_voucher_data);
                    }else{
                        $existed_voucher = $models->voucher->select_one(array(
                            'branch_id' => LHP_BRANCH_ID,
                            'type' => 'payment',
                            'where' => "description like 'Đơn hàng #". $update_data['code']."%'"
                        ));
                        if($existed_voucher)
                            $models->voucher->delete($existed_voucher['id']);
                    }

                    $debt = $models->customer_debt->get_details_by_order_id($order_id);
                    if ($payment_date){
                        if ($debt){
                            $models->customer_debt->update($debt['id'], array(
                                'name' => 'Công nợ order # '. $order_id . ' - '.$update_data['code'],
                                'payment_date' => $payment_date,
                                'amount' => $update_data['total']*1000,
                                'user_id' => $logged_user['user_id'],
                                'order_id' => $order_id
                            ));
                        }else{
                            $models->customer_debt->insert(array(
                                'name' => 'Công nợ order #'. $order_id . ' - '.$update_data['code'],
                                'type_id' => CUSTOMER_DEBT_TYPE_ID,
                                'payment_date' => $payment_date,
                                'amount' => $update_data['total']*1000,
                                'user_id' => $logged_user['user_id'],
                                'order_id' => $order_id,
                                'created_by' => $logged_user['user_id'],
                                'created_dtm' => date('Y-m-d H:i:s')
                            ));
                        }
                        $des = 'Đơn hàng #'.$update_data['code']. (!empty($customer['fullname'])?' - '.$customer['fullname']:'');
                        $payment_voucher_data = array(
                            'branch_id' => LHP_BRANCH_ID,
                            'type' => 'payment',
                            'description' => $des. ' - Thanh toán sau, vào ngày '.date('d/m/Y', strtotime($payment_date)),
                            'amount' => $update_data['total'],
                            'user_id' => $logged_user?$logged_user['user_id']:1
                        );
                        $payment_voucher_data['date_time'] = $payment_voucher_data['created_dtm'] = empty($order_details['delivery_date'])?date('Y-m-d H:i:s'):$order_details['delivery_date'];
                        $models->voucher->insert($payment_voucher_data);
                    }else{
                        if ($debt){
                            $models->customer_debt->delete($debt['id']);
                            $voucher = $models->voucher->select_one(array('type' => 'payment', 'where' => "description like '%#".$update_data['code']."%' AND description like '%Thanh toán sau%'"));
                            $models->voucher->delete($voucher['id']);
                        }
                    }
                }
            }
            else
            {
                error('Đơn hàng bị lỗi, vui lòng đặt hàng lại.');
            }
            $return['key'] = post('key');
            $return['order_type_id'] = $order_type_id;
            $return['order_id'] = $order_id;
            $return['code'] = empty($update_data['code'])?$posted_code:$update_data['code'];
            $return['seq_no'] = get_seq_no($return['code']);
            $customer = $models->customer->get_list_for_selling(array('customers.customer_id' => $customer_id));
            $return['customer'] = $customer;
            ok();
        break;
        case 'get_g_order_items':
            $g_item_code = post('g_item_code');
            if (!$g_item_code)
                error('Mã đơn hàng không chính xác.');
            $order_items = get_g_order_items(array('g_item_code' => $g_item_code, 'where' => "(g_order_items.belongs_to IS NULL OR g_order_items.belongs_to = '')"));
            
            $return['order_items'] = array();
            if ($order_items)
                foreach($order_items as $item)
                {
                    $item['final_price'] = $item['price'];
                    $order_sub_items = get_g_order_items(array('g_item_code' => $g_item_code, 'g_order_items.belongs_to' => $item['id']));
                    if ($order_sub_items)
                    {
                        foreach($order_sub_items as $sub_item){
                            $item['sub_items'][$sub_item['id']] = $sub_item;
                            $item['final_price'] += $sub_item['price'];
                        }
                    }
                    else
                        $item['sub_items'] = array();
                    $item['total_sub_items'] = $order_sub_items?count($order_sub_items):0;
                    $return['order_items'][$item['id']] = $item;
                }
            
            // Get data
            get_data();
            ok();
        break;
        case 'save_g_order_item':
            $ids = post('ids');
            $quantity = post('quantity');
            $item_descriptions = post('descriptions');
            $g_code = post('g_code');
            $g_item_code = post('g_item_code');
            $member = post('member');
            if (!$g_code || !$g_item_code)
                error('Đơn hàng bị lỗi, quý khách vui lòng tải lại trang.');
                
            $sub_product_ids = $ids;
            $product_ids = array();
            foreach($ids as $key => $val)
            {
                $keys = explode('|', $key);
                $product_id = array_pop($keys);
                if (!in_array($product_id, $product_ids))
                    $product_ids[] = $product_id;
            }
            beginTransaction();
            $products = $models->product->get_products_for_delivery(array('where'=>"products.product_id IN (".implode(',', $product_ids).")"));
            if($products)
            {
                eModel::_delete('g_order_items', array('g_item_code' => $g_item_code));
                $product_arr = array();
                foreach($products as $product)
                {
                    $sub_products = $models->product->get_products_for_delivery(array('where' => "belongs_to LIKE '%,".$product['product_id'].",%'"));
                    if ($sub_products)
                    {
                        foreach($sub_products as $sp)
                            $product['sub_products'][$sp['product_id']] = $sp;
                    }
                    else 
                        $product['sub_products'] = array();
                    $product_arr[$product['product_id']] = $product;
                    
                }    
                foreach($sub_product_ids as $key => $sub_ids)
                {
                    $keys = explode('|', $key);
                    $product_id = array_pop($keys);
                    $item = $product_arr[$product_id];
                    $order_items = array();
                    $order_items['g_code'] = $g_code;
                    $order_items['g_item_code'] = $g_item_code;
                    $order_items['member_name'] = $member['name'];
                    $order_items['member_description'] = $member['description'];
                    $order_items['description'] = empty($item_descriptions[$key])?null:$item_descriptions[$key];
                    $order_items['product_id'] = $item['product_id'];
                    $order_items['quantity'] = $quantity[$key];
                    $order_items['price'] = $item['price'];
                    $order_items['total'] = $order_items['price']*$order_items['quantity'];
                    $order_items['created_dtm'] = date('Y-m-d H:i:s');
                    $item_id = eModel::_insert('g_order_items', $order_items);
                    if(!$item_id)
                        error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
                    elseif(!empty($sub_ids) && is_array($sub_ids))
                    {
                        foreach($sub_ids as $sub_product_id)
                        {
                            $order_sub_items = array();
                            $order_sub_items['g_code'] = $g_code;
                            $order_sub_items['g_item_code'] = $g_item_code;
                            $order_sub_items['belongs_to'] = $item_id;
                            $order_sub_items['product_id'] = $sub_product_id;
                            $order_sub_items['quantity'] = $quantity[$key];
                            $order_sub_items['price'] = $item['sub_products'][$sub_product_id]['price'];
                            $order_sub_items['total'] = $order_sub_items['price']*$order_sub_items['quantity'];
                            $order_sub_items['created_dtm'] = date('Y-m-d H:i:s');
                            $sub_item_id = eModel::_insert('g_order_items', $order_sub_items);
                            if(!$item_id)
                                error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
                        }
                    }
                }
            }
            else
            {
                error('Đơn hàng bị lỗi, quý khách vui lòng đặt hàng lại.');
            }
            ok();
        break;
        case 'get_g_order':
            $g_code = post('g_code');
            $active_group = eModel::_select_one('g_booking', array('g_code' => $g_code));
            if (!$active_group)
                error('Mã đơn hàng không chính xác.');
            $order_items = get_g_order_items(array('g_code' => $g_code, 'where' => "(g_order_items.belongs_to IS NULL OR g_order_items.belongs_to = '')"));
            $return['order_items'] = array();
            if ($order_items)
                foreach($order_items as $item)
                {
                    $item['final_price'] = $item['price'];
                    $order_sub_items = get_g_order_items(array('g_code' => $g_code, 'g_order_items.belongs_to' => $item['id']));
                    if ($order_sub_items)
                    {
                        foreach($order_sub_items as $sub_item){
                            $item['sub_items'][$sub_item['id']] = $sub_item;
                            $item['final_price'] += $sub_item['price'];
                        }
                    }
                    else
                        $item['sub_items'] = array();
                    $item['total_sub_items'] = $order_sub_items?count($order_sub_items):0;
                    $return['order_items'][$item['id']] = $item;
                }
            
            // Get data
            get_data();
            ok();
        break;
        case 'get_captcha':
            include('captcha/captcha.php');
            $captcha = new SimpleCaptcha();
            $captcha->wordsFile = '';
            $captcha->width = 100;
            $captcha->height = 50;
            $captcha->minWordLength = 4;
            $captcha->maxWordLength = 4;
            $captcha->maxRotation = 0;
            $captcha->Yperiod    = 10;
            $captcha->Yamplitude = 0;
            $captcha->Xperiod    = 10;
            $captcha->Xamplitude = 0;
            $captcha->imageFormat = 'png';
            $captcha->colors = array(
                array(108,195,88), // green
            );
            $captcha->resourcesPath = __DIR__.DIRECTORY_SEPARATOR .'captcha'.DIRECTORY_SEPARATOR .'resources';
            // Image generation
            $captcha->CreateImage();
        break;
        case 'save_voucher':
            $member = Users::get_logged_user();
            if (empty($member))
                error('Bạn chưa đăng nhập. Vui lòng tải lại trang và đăng nhập.');
            if (!Users::can('modify_shift_data', 'frontend'))
                error('Bạn không có quyền. Vui lòng đăng nhập lại.');

            $fields = $required_fields = array('type', 'amount', 'description');
            $data = array();
            foreach($fields as $f)
            {
                $data[$f] = post($f);
                if (in_array($f, $required_fields) && empty($data[$f]))
                    error('Vui lòng nhập đầy đủ thông tin bắt buộc!!'); 
            }

            if (Users::can('handle_all_branches', 'voucher')){
                $data['branch_id'] = post('branch_id', LHP_BRANCH_ID);
            }else{
                $data['branch_id'] = $member['branch_id'];
            }
            $data['description'] = ucfirst($data['description']);
	        $data['date_time'] = $data['created_dtm'] = date('Y-m-d H:i:s');

	        $shift_id = post('shift_id', 0);
	        $now = date('H:i:s');
	        if ('00:00:00' <= $now && $now <= SHIFT_SEPARATOR_TIME.':00')
	        {
		        if ($shift_id == 2){
			        $data['date_time'] = $data['created_dtm'] = date('Y-m-d').' 17:31:00';
		        }
	        }
	        else
	        {
		        if ($shift_id == 1){
			        $data['date_time'] = $data['created_dtm'] = date('Y-m-d ').' 17:29:00';
		        }
	        }

            $branch = $models->branch->get_details($data['branch_id']);
            $data['user_id'] = $member['user_id'];
            beginTransaction();
            $id = $models->voucher->insert($data);
            if (!$id)
                error('Có lỗi xảy ra khi thêm. Vui lòng thử lại sau.');
            
            $assiged_user_id = post('assigned_member_id');
            $salary_advance_id = 0;
            if ($assiged_user_id && is_numeric($assiged_user_id)){
                $assigned_member = $models->user->get_details($assiged_user_id);
                if ($assigned_member)
                {
                    $salary_advance_id = $models->salary_advance->insert(array(
                        'date_time' => $data['date_time'], 
                        'user_id' => $assiged_user_id,
                        'amount' => $data['amount'],
                        'description' => 'Tạo trên trang bán hàng.',
                        'created_by' => $member['user_id'],
                        'created_dtm' => $data['date_time']
                    ));
                }
            }
            
            // Send email to user and admin
            if ($data['type'] == 'payment'){
                $subject = get_setting('site_name'). ' - Phiếu chi #'.$id. ' - '.$branch['branch_name'];
                $cost_data = array(
                    'name' => $data['description'],
                    'amount' => $data['amount']<=1000?$data['amount']*1000:$data['amount'],
                    'date_time' => $data['date_time'],
                    'payment_type' => 'cash',
                    'user_id' => $member['user_id'],
                    'created_by' => $member['user_id'],
                    'created_dtm' => $data['created_dtm']
                );
                switch(post('payment_type'))
                {
                    case 'p1':
                        /* Drink water */
                        $cost_data['type_id'] = SHIPPING_COST_TYPE_ID;
                        break;
                    case 'p2':
                        /* Parking fee */
                        $cost_data['type_id'] = SHIPPING_COST_TYPE_ID;
                        break;
                    case 'p5':
                        /* Salary advance */
                        break;
                    case 'p7':
                        /* Shipping fee */
                        $cost_data['type_id'] = SHIPPING_COST_TYPE_ID;
                        $order = $models->order->get_order(post('order_code'));
                        if ($order)
                            $cost_data['order_id'] = $order['id'];
                        break;
                    case 'p8':
                        /* Paid order */
                        break;
                    case 'p10':
                        $cost_data['type_id'] = OTHER_COST_TYPE_ID;
                        break;
                }
                if(!empty($cost_data['type_id'])){
                    if (!empty($cost_data['order_id'])){
                        $existed_cost = $models->cost->get_details_by_order_id($cost_data['order_id']);
                    }
                    if (empty($existed_cost)){
                        if ($models->cost->insert($cost_data))
                            subtract_balance($data['amount'], 'cash');
                    }else{
                        if ($models->cost->update($existed_cost['id'], $cost_data)){
                            add_balance($existed_cost['amount'], $existed_cost['payment_type']);
                            subtract_balance($data['amount'], 'cash');
                        }
                    }

                }
            }else
                $subject = get_setting('site_name'). ' - Phiếu thu #'.$id. ' - '.$branch['branch_name'];
            $params = array(
                'data' => $data,
                'member' => $member,
                'branch_name' => $branch['branch_name']
            );
            if (!empty($member['email']))
            {
                $body = include2string('email_templates/voucher_notification_member.php', $params);
                SendMail('sender@'. DOMAIN_NAME, $member['email'], $subject, $body, get_setting('site_name'). ' - Shop management system');
            }
            if ($salary_advance_id)
            {
                if (!empty($assigned_member['email']))
                {
                    $body = include2string('email_templates/salary_advances_notification_member.php', array('amount' => $data['amount'], 'member' => $assigned_member));
                    SendMail('sender@'. DOMAIN_NAME, $assigned_member['email'], get_setting('site_name'). ' - Thông tin tạm ứng', $body, get_setting('site_name'). ' - Shop management system');
                }
            }
            $body = include2string('email_templates/voucher_notification_admin.php', $params);
            SendMail('sender@'. DOMAIN_NAME, SYSTEM_EMAIL, $subject, $body, get_setting('site_name'). ' - Shop management system');
            if ($salary_advance_id && !empty($assigned_member))
            {
                $body = include2string('email_templates/salary_advances_notification_admin.php', array('amount' => $data['amount'], 'member' => $assigned_member));
                SendMail('sender@'. DOMAIN_NAME, 'hr@'. DOMAIN_NAME, get_setting('site_name'). ' - Thông tin tạm ứng', $body, get_setting('site_name'). ' - Shop management system');
            }
            ok('Phiếu thu chi đã được lưu.');
        break;
        case 'load_shift_data':
            $shift_id = post('shift_id', 0);
            if (Users::can('handle_all_branches', 'voucher')){
                $branch_id = post('branch_id', LHP_BRANCH_ID);
            }else{
                $logged_user = Users::get_logged_user();
	            if (!$logged_user)
		            error('Bạn chưa đăng nhập.');
                $branch_id = $logged_user['branch_id'];
            }

            $now = date('H:i:s');
            if (('00:00:00' <= $now && $now <= (SHIFT_SEPARATOR_TIME.':00') && !$shift_id) || $shift_id == 1)
            {
                $start_h = '00:00:00';
                $end_h = SHIFT_SEPARATOR_TIME.':00';
                $shift = 1;
            }
            else
            {
                $start_h = SHIFT_SEPARATOR_TIME.':01';
                $end_h = '23:59:59';
                $shift = 2;
            }
            $filter_arr = array();
            $filter_arr['select'] = 'SUM(orders.total) as total';
            $filter_arr['where'] = "DATE_FORMAT(orders.delivery_date,'%Y-%m-%d') = '".date('Y-m-d')."' AND (DATE_FORMAT(orders.delivery_date,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
            $filter_arr['orders.deleted'] = 0;
            $filter_arr['orders.branch_id'] = $branch_id;
            $rs = $models->order->select_one($filter_arr);
            $return['total'] = 0;
            if ($rs)
                $return['total'] = $rs['total'];
            $filter_arr = array();
            $filter_arr['where'] = "DATE_FORMAT(vouchers.date_time,'%Y-%m-%d') = '".date('Y-m-d')."' AND (DATE_FORMAT(vouchers.date_time,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
            $filter_arr['vouchers.branch_id'] = $branch_id;
            $return['vouchers'] = $models->voucher->get_list($filter_arr, 'vouchers.type');
            $return['shift'] = $shift;
            $return['today'] = date('d/m/Y');
            $branch = $models->branch->get_details($branch_id);
            $return['branch_name'] = $branch['branch_name'];
            ok();
        break;
        case 'agree_shift_data':
            $member = Users::get_logged_user();
            if (empty($member))
                error('Bạn chưa đăng nhập. Vui lòng tải lại trang và đăng nhập.');
            if (!Users::can('modify_shift_data', 'frontend'))
                error('Bạn không có quyền. Vui lòng đăng nhập lại.');

            $shift_id = post('shift_id', 0);
            if (Users::can('handle_all_branches', 'voucher')){
                $branch_id = post('branch_id', LHP_BRANCH_ID);
            }else{
                $branch_id = $member['branch_id'];
            }
            $now = date('H:i:s');
            if (('00:00:00' <= $now && $now <= (SHIFT_SEPARATOR_TIME.':00') && !$shift_id) || $shift_id == 1)
            {
                $start_h = '00:00:00';
                $end_h = SHIFT_SEPARATOR_TIME.':00';
                $shift = 1;
            }
            else
            {
                $start_h = SHIFT_SEPARATOR_TIME.':01';
                $end_h = '23:59:59';
                $shift = 2;
            }
            $filter_arr = array();
            $filter_arr['select'] = 'SUM(orders.total) as total';
            $filter_arr['where'] = "DATE_FORMAT(orders.delivery_date,'%Y-%m-%d') = '".date('Y-m-d')."' AND (DATE_FORMAT(orders.delivery_date,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
            $filter_arr['orders.deleted'] = 0;
            $filter_arr['orders.branch_id'] = $branch_id;
            $rs = $models->order->select_one($filter_arr);
            $params['total'] = 0;
            if ($rs)
                $params['total'] = $rs['total'];
            
            $filter_arr = array();
            $filter_arr['where'] = "DATE_FORMAT(vouchers.date_time,'%Y-%m-%d') = '".date('Y-m-d')."' AND (DATE_FORMAT(vouchers.date_time,'%H:%i:%s') BETWEEN '$start_h' AND '$end_h')";
            $filter_arr['vouchers.branch_id'] = $branch_id;
            $params['vouchers'] = $models->voucher->get_list($filter_arr, 'vouchers.type');
            $params['shift'] = $shift;
            $params['member'] = $member;

            $branch = $models->branch->get_details($branch_id);
            $params['branch_name'] = $branch['branch_name'];
            $subject = get_setting('site_name'). " - Kết ca $shift ngày ".date('d/m/Y'). ' - '.$branch['branch_name'];
            if (!empty($member['email']))
            {
                $body = include2string('email_templates/shift_notification_member.php', $params);
                SendMail('sender@'. DOMAIN_NAME, $member['email'], $subject, $body, get_setting('site_name'). ' - Shop management system');
            }
            $body = include2string('email_templates/shift_notification_admin.php', $params);
            $admin_email = env('ADMIN_EMAIL');
            SendMail('sender@'. DOMAIN_NAME, SYSTEM_EMAIL.',orders@'. DOMAIN_NAME. ($admin_email?','. $admin_email:''), $subject, $body, get_setting('site_name'). ' - Shop management system');
            ok('Thông tin kết ca đã được gửi.');
        break;
        case 'login':
            $logged_user = Users::get_logged_user();
            if ($logged_user)
                error('Bạn đã đăng nhập. Vui lòng đăng xuất nếu tài khoản hiện tại không phải của bạn.');
            $username = post('username');
            
            $passed_password = post('password');
            $decode_password = base64_decode($passed_password);
            /* decrypt */
        	if(openssl_private_decrypt($decode_password, $decrypted_password, openssl_pkey_get_private(KEY_PRIVATE, KEY_PASSPHRASE)))
            {
        		// expecting sha1password+timestamp
            	if(strlen($decrypted_password)<13) return false;
            	// extract password
                $pass_lenth = strlen($decrypted_password)-13;
            	$password = substr($decrypted_password,0,$pass_lenth);
            	// extract stamp, stamp has milliseconds and is bigger than int
            	$stamp = substr($decrypted_password,$pass_lenth);
            	// extract timestamp, timestamp is in seconds, and is an int
            	$timestamp = substr($stamp,0,strlen($stamp)-3);
            	if(!is_numeric($timestamp)) return false;
            	// check timestamp
            	if(abs(time() - (int)$timestamp) > 300) {
            		error('Thời gian chờ hơn 5 phút. Vui lòng đăng nhập lại.');
            	}
        	}
            else
                $password = $passed_password;
            
            $encrypted_pass = password_encrypt($password, strtolower($username));
            $user = $models->user->select_one(array('username' => $username, 'password' => $encrypted_pass));
            if(!$user)
            {
                //No user found
                error('Tài khoản hoặc mật khẩu không đúng!!');
            }
            if ($user['enabled'] == 0)
            {
                error('Tài khoản đã ngưng hoạt động!!');
            }
            if ($user['deleted'] == 1)
            {
                error('Tài khoản đã bị xóa!!');
            }
            Users::do_login($user);
            $return['user'] = array('fullname' => $user['fullname']);;
            $return['can_modify_shift_data'] = Users::can('modify_shift_data', 'frontend');
            ok('Đăng nhập thành công.');
        break;
        case 'logout':
            Users::do_logout();
            ok('Bạn đã đăng xuất.');
        break;
        case 'check_login_status':
            $logged_user = Users::get_logged_user();
            $return['can_modify_shift_data'] = $logged_user?Users::can('modify_shift_data', 'frontend'):0;
            $return['can_handle_vouchers_in_all_branches'] = $logged_user?Users::can('handle_all_branches', 'voucher'):0;
            if ($logged_user)
                $return['user'] = array('fullname' => $logged_user['fullname']);
            else
                $return['user'] = 0;
            ok();
        break;
        case 'is_free_ship':
            $return['free_ship'] = 0;
            $mobile = post('mobile');
            $mobile = str_replace('+', '', $mobile);
            if (strpos($mobile, '84') === 0)
                $mobile = substr($mobile, 2);
            if (strpos($mobile,'0') !== 0)
                $mobile = '0'. $mobile;
            if (intval($mobile) != 0)
            {
                $existed_customer = $models->customer->select_one(array("mobile" => $mobile, 'deleted' => 0));
                if ($existed_customer && $existed_customer['free_ship'])
                    $return['free_ship'] = 1;
            }
            ok();  
        break;
        default:
            error('Invalid action!!');
        break;
    }
    exit;
?>